<?php

include_once('models/Postdata.php');
include_once('models/Getdata.php');
include_once('models/FileReader.php');
include('models/Encryption.php');

class Subscribe {

    private $goodDir = "http://localhost/projet_naruto/index.php?action=subscribed";
    private $badDir = "http://localhost/projet_naruto/index.php?action=errorsubscribed";
    private $postAllowed = array(
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
    private $fileAllowed = "avatar";
    private $getData;
    private $syntaxPass = '#[A-Za-z]{1,}[$!/;,?ù%£^+=}{\'@\#]{1,}[1-9]{2,}#';
    private $syntaxMail = '#^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$#';
    private $villagesAllowed = array("konoha", "iwa", "suna", "kiri", "kumo");
    
    private $errors = array();

    public function __construct() {
        $this->getData = new Getdata();
    }
    //SEND SUBSCRIPTION PAGE
    public function displaySub() {
        require('views/temp1.php');
    }
    //SEND SUBSCRIPTION ACCEPTED
    public function displaySubAccepted() {
        require('views/temp2.php');
    }

    //SEND ERROR SUBSCRIPTION
    public function errorSub() {
        require('views/temperror.php');
    }

    //CHECK FOR SUBSCRIBING
    public function checkForSubscribing($post) {
        //Check if all post values are correct and allowed
        $postChecked =  $this->checkPostVar($post);
        if(count($postChecked) === count($this->postAllowed)) {
            //check if the username is already existing
            if($this->checkUsername(array("username"=>$post["username"]))){
                array_push($this->errors, "Le nom d'utilisateur est déjà pris");
            }
            //check password (syntax and equality)
            if(!$this->checkPassword(array($post["password"], $post["confirmPassword"]))){
                array_push($this->errors, "Les mots de passe ne sont pas identiques");
            }
            //check mail
            if(!$this->checkMail($post['mail'])) {
                array_push($this->errors, "Le mail n'est pas conforme");
            }
            //check village
            if(!$this->checkVillage($post['village'])) {
                array_push($this->errors, "Le village n'est pas conforme");
            }
            //check date
            if($this->checkDate($postChecked["day"], $postChecked["month"], $postChecked["year"])) {
                $date = new DateTime($post["day"]."-".$post["month"]."-".$post["year"]);
                $birthdate = $date->format('Y-m-d H:i:s.u');
            } else {
                array_push($this->errors, "La date n'est pas conforme");
            }
            //check img file
            $postChecked+= ["avatar"=>""];
            if(!empty($_FILES["avatar"]["name"]) && empty($this->errors)) {
                $img_reader = new FileReader();
                if($img_reader->getImage($_FILES["avatar"])) {
                    $postChecked["avatar"] = $img_reader->getUrl();
                }
            }

            //ENCODING for sending
            $encryption = new Encryption();
            $date = new DateTime();
            $postToSend = array(
                "firstname"=>$postChecked["firstname"],
                "lastname"=>$postChecked["lastname"],
                "username"=>$postChecked["username"],
                "mail"=>$postChecked["mail"],
                "password"=>$encryption->crypt($postChecked["password"]),
                "village"=>$postChecked["village"],
                "birthdate"=>$birthdate,
                "subDate"=>$date->format('Y-m-d H:i:s.u'),
                "avatar"=>$postChecked["avatar"]
            );
            // SEND INFOS TO BDD(encode password)
            $postData = new Postdata();
            if($postData->setData("accounts", $postToSend) && empty($this->errors)) {
                header('Location:'.$this->goodDir);
            } else {
                header('Location:'.$this->badDir);
            }    

        } else {
            header('Location:'.$this->badDir);
        }
       
        
    }

    private function checkPostVar($post) {//check if all var are sended
        $postChecked = array_filter($post, function($key) {
            return in_array($key, $this->postAllowed);
        },ARRAY_FILTER_USE_KEY);
        return $postChecked;
    }

    private function checkUsername($postChecked) {
        $data = $this->getData->getByFilters('accounts', $postChecked);
        return $data ? true : false;
    }

    private function checkPassword($passwords) {//array
        if($passwords[0] === $passwords[1]) {
            return preg_match($this->syntaxPass, $passwords[0]) == 1 ? true : false;
        } else {
            return false;
        }
    }

    private function checkMail($mail) {
        return preg_match($this->syntaxMail, $mail) == 1 ? true : false;
    }

    private function checkVillage($village) {
        return in_array($village, $this->villagesAllowed);
    }
    private function checkDate($day, $month, $year) {
        $d = intval($day);
        $m = intval($month);
        $y = intval($year);
        if(gettype($d) == 'integer' && gettype($m) == 'integer' && gettype($y) == 'integer') {
            return $d > 0 && $d < 31 && $m > 0 && $m < 13 && $y > 1900 && $y < intval(date("Y"));
        } else {
            return false;
        }
    }
}