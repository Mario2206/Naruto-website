<?php   
namespace Controller;

use Model\{
    Getdata,
    Postdata,
    Updatedata
};
use Helper\{
    Encryption,
    CheckMail
};
use Exception\{
    Exception_arr
};

class Subscribe {

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
    const SYNTAX_MAIL = '#^[a-z0-9._-]{1,}@[a-z0-9._-]{1,}\.[a-z]{2,6}$#';
    const VILLAGE_ALLOWED =["konoha", "iwa", "suna", "kiri", "kumo"];
    
    private $getData;
    private $postData;
    private $updateData;
    private $errors = [];

    public function __construct() {
        $this->getData = new Getdata();
        $this->postData = new Postdata();
        $this->updateData = new Updatedata();
    }
    //SEND SUBSCRIPTION PAGE
    public function displaySub() {
        require('views/temp1.php');
    }
    //SEND SUBSCRIPTION ACCEPTED
    public function displaySubAccepted() {
        require('views/temp2.php');
    }
    //VERIF LINK
    public function checkSubscribe($id, $vKey) {
        $account = $this->getData->getByFilters("accounts", ["id"=>$id])[0];
        if($account->isVerif == 0 && $account->vKey === $vKey) {
            if($this->updateData->updateBdd("accounts", ["isVerif"=>1], ["id"=>$id])){
                echo "Verif is ok";
            } else {
                echo "error";
            }
        } else {
            echo "page not found";
        } 
    }

    //CHECK FOR SUBSCRIBING
    public function checkForSubscribing($post) {
        //Check if all post values are correct and allowed
        $postChecked =  $this->checkPostVar($post);
        if(count($postChecked) === count(Subscribe::POST_ALLOWED)) {
            //check if the username is already existing
            if($this->checkUsername(array("username"=>$post["username"]))){
                array_push($this->errors,"Le nom d'utilisateur est déjà pris");
            }
            //check password (syntax and equality)
            if(!$this->checkPassword(array($post["password"], $post["confirmPassword"]))){
                array_push($this->errors,"Les mots de passe ne sont pas identiques");
            }
            //check mail
            if(!$this->checkMail($post['mail'])) {
                array_push($this->errors,"Le mail n'est pas conforme ou il est déjà enregistré dans la base de donnée");
            }
            //check village
            if(!$this->checkVillage($post['village'])) {
                array_push($this->errors,"Le village n'est pas conforme");
            }
            //check date
            if(is_numeric($postChecked["day"]) && is_numeric($postChecked["month"]) && is_numeric($postChecked["year"])) {
                $date = new \DateTime("{$post['day']}-{$post['month']}-{$post['year']}");
                $birthdate = $date->format('Y-m-d H:i:s.u');
            } else {
                array_push($this->errors,"La date n'est pas conforme");
            }
            //Check if errors or not
            if(empty($this->errors)) {

                //check and send img file
                $postChecked+= [self::FILE_ALLOWED=>""];
                if(!empty($_FILES[self::FILE_ALLOWED]["name"])) {
                    $img_reader = new FileReader();
                    if($img_reader->getImage($_FILES[self::FILE_ALLOWED])) {
                        $postChecked[self::FILE_ALLOWED] = $img_reader->getUrl();
                    }
                }
                //ENCODING for sending
                $date = new \DateTime();
                $postToSend = array(
                    "firstname"=>$postChecked["firstname"],
                    "lastname"=>$postChecked["lastname"],
                    "username"=>$postChecked["username"],
                    "mail"=>$postChecked["mail"],
                    "password"=>Encryption::crypt($postChecked["password"]),
                    "village"=>$postChecked["village"],
                    "birthdate"=>$birthdate,
                    "subDate"=>$date->format('Y-m-d H:i:s.u'),
                    "avatar"=>$postChecked["avatar"],
                    "vKey" =>Encryption::createKey(),//Create vKey
                    "isVerif"=>"0"
                );  
                // SEND INFOS TO BDD(encode password)
                if($this->postData->setData("accounts", $postToSend)) {
                    //SEND EMAIL VERIFICATION
                    CheckMail::mailVerif($postToSend["mail"],$postToSend["vKey"]);
                    header('Location:'.self::GOOD_DIR);
                    exit();
                } else {
                    throw new \Exception("Servor error: data couldn't be sended to servor");
                } 

            } else {
                throw new Exception_arr($this->errors); 
            }   

        } else {
            throw new \Exception("Error about post request");
        }
              
    }

    private function checkPostVar($post) {//check if all var are sended
        $postChecked = array_filter($post, function($key) {
            return in_array($key, self::POST_ALLOWED);
        },ARRAY_FILTER_USE_KEY);
        return $postChecked;
    }

    private function checkUsername($postChecked) {
        $data = $this->getData->getByFilters('accounts', $postChecked);
        return $data ? true : false;
    }

    private function checkPassword($passwords) {//array
        if($passwords[0] === $passwords[1]) {
            return preg_match(self::SYNTAX_PASS, $passwords[0]) == 1 ? true : false;
        } else {
            return false;
        }
    }

    private function checkMail($mail) {
        return preg_match(self::SYNTAX_MAIL, $mail) == 1 && !$this->getData->getByFilters("accounts", ["mail"=>$mail]) ? true : false;
    }

    private function checkVillage($village) {
        return in_array($village, self::VILLAGE_ALLOWED);
    }
}