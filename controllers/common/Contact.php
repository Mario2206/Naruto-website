<?php
namespace Controller;

use DateTime;
use Exception\ExceptionArr;
use Helper\CheckMail;
/**
 * Contact class
 */
class Contact extends Controller {

    const MIN_LENGTH_MESS = 30;
    const MAX_LENGTH_MESS = 500;
    const POST_ALLOWED = ["mail","subject","message"];

    private $GOOD_DIR;

    function __construct()
    {
        parent::__construct();
        $this->GOOD_DIR = $GLOBALS["PATH"]."contact/contacted";
    }
    /**
     * CONTACT VIEW
     */
    public function displayContact() 
    {
        require("../views/components/contact.php");
    }

    /**
     * CONTROLLER METHOD FOR CHECKING POST DATA 
     * 
     * @param array $post 
     */
    public function checkContactReq(array $post) {
        //verifications
        if(!$postChecked= $this->checkPostVar($post, self::POST_ALLOWED)) {
            throw new \Exception("Error about post request");
        }
        $mail = strip_tags($postChecked["mail"]);
        $subject = strip_tags($postChecked["subject"]);
        $mess = strip_tags($postChecked["message"]);
        $errors = [];

        if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Le mail ne correspond pas aux normes");
        }
        if(empty($subject)) {
            array_push($errors, "Le sujet ne peut pas être vide");
        }
        if(iconv_strlen($mess) < self::MIN_LENGTH_MESS || strlen($mess) > self::MAX_LENGTH_MESS) {
            array_push($errors, "Le message ne correspond pas à une quantité de caractères raisonnable.");
        }

        if(empty($errors)) {
            $data = [
                "sender"=>$mail,
                "dest"=>$GLOBALS["ADMIN_ADRESS"],
                "subject"=>$subject,
                "message"=>$mess,
            ];
            if(CheckMail::mail($data, false)){
                $this->postData->setData("contacts", [
                    "sender"=>$mail,
                    "subject"=>$subject,
                    "message"=>$mess,
                    "sending_date"=>date("Y-m-d H:i:s.u")
                ]);
                header("Location:".$this->GOOD_DIR);
                exit();
            } else {
                throw new \Exception("Bad sending !");
            }
        } else {
            throw new ExceptionArr($errors);//show errors
        }
    }
    /**
     * GOOD SENDING VIEW
     */
    public function displayEndReq() {
        //view  good reqs
        $message = "L'envoi s'est effectue avec succes !";
        require('../views/components/info.php');
    }
}