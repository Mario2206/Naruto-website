<?php
namespace Controller;

use Model\ {
    Postdata
};
use Exception\{
    Exception_arr
};

class Contact {

    const SYNTAX_MAIL = '#^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$#';
    const MIN_LENGTH_MESS = 30;
    const MAX_LENGTH_MESS = 500;
    const GOOD_DIR = "http://projet-naruto.local/contact/contacted";

    private $postData;

    public function __construct() {
        $this->postData = new Postdata();
    }

    public function displayContact() {
        //view contact
        require("views/temp_contact.php");
    }

    public function checkContactReq(array $post) {
        //verifications
        $mail = $post["mail"];
        $subject = $post["subject"];
        $mess = $post["message"];
        $errors = [];

        if(preg_match(self::SYNTAX_MAIL, $mail) == 0) {
            array_push($errors, "Le mail ne correspond pas aux normes");
        }
        if(empty($subject)) {
            array_push($errors, "Le sujet ne peut pas être vide");
        }
        if(strlen($mess) < self::MIN_LENGTH_MESS || strlen($mess) > self::MAX_LENGTH_MESS) {
            array_push($errors, "Le message ne correspond pas à une quantité de caractères raisonnable.");
        }

        if(empty($errors)) {
            $date = new \DateTime();
            $data = [
                "sender"=>$mail,
                "subject"=>$subject,
                "message"=>$mess,
                "sending_date"=>$date->format('Y-m-d H:i:s.u')
            ];
            if($this->postData->setData("contacts", $data)){
                echo "good sending";
            } else {
                throw new \Exception("Bad sending !");
            }
        } else {
            throw new Exception_arr($errors);//show errors
        }
    }

    public function displayEndReq() {
        //view  good reqs
        echo "good sending";
    }
}