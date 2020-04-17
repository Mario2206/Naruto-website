<?php   
namespace Controller;

use Model\{
    Getdata,
    Postdata,
    Updatedata
};

use Helper\{
    Encryption,
    CheckMail,
    FileReader
};
use Exception\ExceptionArr;
/**
 * 
 */
class Subscribe extends Controller {

    const GOOD_DIR = "http://projet-naruto.local/subscription/subscribed";
    const POST_ALLOWED = array(
        "firstname",
         "lastname",
         "username",
         "mail",
         "password",
         "confirmPassword",
         "village",
         "day",
         "month",
         "year"
    );
    const FILE_ALLOWED = "avatar";
    const SYNTAX_PASS = '#[A-Za-z]+[$!/;,?ù%£^+=}{\'@\#]+[1-9]{2,}#';
    const VILLAGE_ALLOWED =["konoha", "iwa", "suna", "kiri", "kumo"];
    
   
    private $errors = [];

    //SEND SUBSCRIPTION PAGE
    public function displaySub() {
        require('../views/components/subpage.php');
    }
    //SEND SUBSCRIPTION ACCEPTED
    public function displaySubAccepted() {
        $message = "L'inscription s'est bien passee, il est temps de la confirmer via le lien 
                    que vous venez de recevoir par mail !!!!";
        require('../views/components/info.php');
    }
    //VERIF LINK
    public function checkSubscribe($id, $vKey) {
        $data = $this->getData->getByFilters("accounts", ["id"=>$id]);
        if(!$data) {
            throw new \Exception("Page not found");
        }
        $account = $data[0];
        if($account->isVerif == 0 && $account->vKey === $vKey) {
            if($this->updateData->updateBdd("accounts", ["isVerif"=>1], ["id"=>$id])){
                echo "Verif is ok";
            } else {
                throw new \Exception("Error about confirmation !!");
            }
        } else {
            throw new \Exception("Page not found");
        } 
    }

    //CHECK FOR SUBSCRIBING
    public function checkForSubscribing(array $post) {

        //Check if all post values are correct and allowed
        if(!$postChecked = $this->checkPostVar($post, self::POST_ALLOWED)) {
            throw new \Exception("Error about post request");
        }

        //check if the username is already existing
        if($this->checkUsername(array("username"=>$postChecked["username"]))){
            array_push($this->errors,"Le nom d'utilisateur est déjà pris");
        }

        //check password (syntax and equality)
        if(!$this->checkPassword(array($postChecked["password"], $postChecked["confirmPassword"]))){
            array_push($this->errors,"Les mots de passe ne sont pas identiques");
        }

        //check mail
        if(!$this->checkMail($postChecked['mail'])) {
            array_push($this->errors,"Le mail n'est pas conforme ou il est déjà enregistré dans la base de donnée");
        }

        //check village
        if(!in_array($postChecked['village'], self::VILLAGE_ALLOWED)) {
            array_push($this->errors,"Le village n'est pas conforme");
        }

        //check date
        if(is_numeric($postChecked["day"]) && is_numeric($postChecked["month"]) && is_numeric($postChecked["year"])) {
            $date = new \DateTime("{$postChecked['day']}-{$postChecked['month']}-{$postChecked['year']}");
            $birthdate = $date->format('Y-m-d H:i:s.u');
        } else {
            array_push($this->errors,"La date n'est pas conforme");
        }

        //Check if errors or not
        if(!empty($this->errors)) {
            throw new ExceptionArr($this->errors); 
        }

        //check and send img file
        $postChecked+= [self::FILE_ALLOWED=>""];
        if(!empty($_FILES[self::FILE_ALLOWED]["name"])) {
            $img_reader = new FileReader();
            if($img_reader->getImage($_FILES[self::FILE_ALLOWED])) {
                $postChecked[self::FILE_ALLOWED] = $img_reader->getUrl();
            }
        }

        //ENCODING for sending
        $postToSend = array(
            "firstname"=>$postChecked["firstname"],
            "lastname"=>$postChecked["lastname"],
            "username"=>$postChecked["username"],
            "mail"=>$postChecked["mail"],
            "password"=>Encryption::crypt($postChecked["password"]),
            "village"=>$postChecked["village"],
            "birthdate"=>$birthdate,
            "subDate"=>date('Y-m-d H:i:s.u'),
            "avatar"=>$postChecked["avatar"],
            "vKey" =>Encryption::createKey(),//Create vKey
            "isVerif"=>"0"
        );  

        // SEND INFOS TO BDD(encode password)
        if($this->postData->setData("accounts", $postToSend)) {
            //SEND EMAIL VERIFICATION
            $id = $this->getData->getId("accounts", ["mail"=>$postToSend['mail']]);
            CheckMail::mailVerif($id,$postToSend["mail"],$postToSend["vKey"]);
            header('Location:'.self::GOOD_DIR);
            exit();
        } else {
            throw new \Exception("Servor error: data couldn't be sended to servor");
        } 
              
    }

    private function checkUsername(array $postChecked) : bool {
        $data = $this->getData->getByFilters('accounts', $postChecked);
        return $data ? true : false;
    }

    private function checkPassword(array $passwords) : bool {//array
        if($passwords[0] === $passwords[1]) {
            return preg_match(self::SYNTAX_PASS, $passwords[0]) == 1 ? true : false;
        } else {
            return false;
        }
    }
    //Check if the mail has a correct syntax and if it doesn't exist in bdd
    private function checkMail(string $mail) {
        return filter_var($mail, FILTER_VALIDATE_EMAIL) && !$this->getData->getByFilters("accounts", ["mail"=>$mail]) ? true : false;
    }
}