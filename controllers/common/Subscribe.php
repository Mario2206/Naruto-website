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
    FileReader,
    Checker
};
use Exception\ExceptionArr;
/**
 * class Subscribe Controller
 */
class Subscribe extends Controller {

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
    const VILLAGE_ALLOWED =["konoha", "iwa", "suna", "kiri", "kumo"];

    const GOOD_DIR = "subscription/subscribed";
    
   

    public function __construct()
    {
        parent::__construct();
        $this->prohibitionSession();
    }
    /**
     * SEND SUBSCRIPTION PAGE
     */
    public function displaySub() {
        $this->render('subpage.php');
    }

    /**
     * SEND SUBSCRIPTION THAT'S ACCEPTED
     */
    public function displaySubAccepted() {
        $message = "L'inscription s'est bien passee, il est temps de la confirmer via le lien 
                    que vous venez de recevoir par mail !!!!";
        $this->render("info.php", compact("message"));
    }

    /**
     * CHECK CONFIRMATION LINK
     */
    public function checkSubscribe($id, $vKey) {
        $data = $this->getData->getByFilters("accounts", ["id"=>$id]);
        if(!$data) {
            throw new \Exception("Page not found");
        }
        $account = $data[0];
        if($account->isVerif == 0 && $account->vKey === $vKey) {
            if($this->updateData->updateBdd("accounts", ["isVerif"=>1], ["id"=>$id])){
                $message = "La confirmation est effectuee.<br/>BIEN JOUE TU PEUX TE CONNECTER !!";
                $this->render('info.php', compact("message"));
            } else {
                throw new \Exception("Error about confirmation !!");
            }
        } else {
            throw new \Exception("Page not found");
        } 
    }

    /**
     * CHECK FOR SUBSCRIBING
    */
    public function checkForSubscribing(array $post) {

        //Check if all post values are correct and allowed
        if(!$postChecked = $this->checkPostVar($post, self::POST_ALLOWED)) {
            throw new \Exception("Error about post request");
        }

        //Clear string values from HTML elements
        $postChecked = $this->clearValueFromArray($postChecked);

        //check if the username is already existing
        if($this->getData->getByFilters("accounts", ["username"=>$postChecked["username"]])){
            $this->setError("Le nom d'utilisateur est déjà pris");
        }

        //check password (syntax and equality)
        if(!Checker::checkPassword(array($postChecked["password"], $postChecked["confirmPassword"]))){
            $this->setError("Les mots de passe ne sont pas identiques");
        }

        //check mail
        if(!Checker::checkMail($postChecked['mail']) || $this->getData->getByFilters("accounts", ["mail"=>$postChecked["mail"]])) {
            $this->setError("Le mail n'est pas conforme ou il est déjà enregistré dans la base de donnée");
        }

        //check village
        if(!in_array($postChecked['village'], self::VILLAGE_ALLOWED)) {
            $this->setError("Le village n'est pas conforme");
        }

        //check date
        if(is_numeric($postChecked["day"]) && is_numeric($postChecked["month"]) && is_numeric($postChecked["year"])) {
            $date = new \DateTime("{$postChecked['day']}-{$postChecked['month']}-{$postChecked['year']}");
            $birthdate = $date->format('Y-m-d H:i:s.u');
        } else {
            $this->setError("La date n'est pas conforme");
        }

        //Check if errors or not
        if(!empty($this->getError())) {
            throw new ExceptionArr($this->getError()); 
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
            $this->redirect(self::GOOD_DIR);
        } else {
            throw new \Exception("Servor error: data couldn't be sended to servor");
        } 
              
    }

}