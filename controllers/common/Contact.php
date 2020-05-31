<?php
namespace Controller;

use DateTime;
use Exception\ExceptionArr;
use Helper\CheckMail;
use Helper\Session;

/**
 * Contact class
 */
class Contact extends Controller {

    const MIN_LENGTH_MESS = 30;
    const MAX_LENGTH_MESS = 500;
    const POST_ALLOWED = ["mail","subject","message"];

    const GOOD_DIR = "/contact/contacted";

  
    /**
     * CONTACT VIEW
     */
    public function displayContact() 
    {
        $session = Session::getValue("user");
        $this->render("contact.php", compact("session"));
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
        $mail = $postChecked["mail"];
        $subject = $postChecked["subject"];
        $mess = $postChecked["message"];
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
                $this->redirect(self::GOOD_DIR);
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
        $this->render("info.php", compact("message"));
    }
}