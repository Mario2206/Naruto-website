<?php 
namespace Controller\Admin;

use Controller\Controller;
use Helper\CheckMail;

class ContactManagement extends Controller {

    const KEY_ALLOWED = ["message"];

    public function __construct()
    {
        parent::__construct();
    }

    public function display() {
        $data = $this->getData->getAll("contacts");
        require('../views/components/administration/admin_contact_manager.php');
        $_SESSION["errors"] = null;
    }

    public function displayContact(int $id) {
        $data = $this->getData->getByFilters("contacts", ["id"=>$id]);
        $errors = $_SESSION["errors"] ?? null; 

        if($data[0]->already_seen == 0) {
            $this->updateData->updateBdd("contacts",["already_seen" => true], ["id"=>$id]);
        }
        if($reply = $this->getData->getByFilters("contact_reply", ["id_contact"=>$id])) {
            $data[0]->contact_reply = $reply[0];
        }
        
    
        require('../views/components/administration/admin_contact_details.php');
        $_SESSION["errors"] = null;
    }

    public function sendResponse(array $post, int $idContact) {

        if(!$postChecked = $this->checkPostVar($post, self::KEY_ALLOWED)) {
            throw new \Exception("Error about post Request : input names aren't correct");
        }
        $currentContact = $this->getData->getByFilters("contacts", ["id"=>$idContact]);

        if(iconv_strlen($postChecked["message"]) < 15 ) {
            $_SESSION["errors"] = "Le message doit faire au minimum 15 caractères";
            header("Location:".$GLOBALS["PATH"]."administration/admin/management/contacts/".$idContact);
            exit();
        }
        $dataForMail = [
            "dest"=>$currentContact[0]->sender,
            "subject"=>"RE: ".$currentContact[0]->subject,
            "message"=>$postChecked["message"],
            "sender"=> $_SESSION["admin_mail"] ?? $GLOBALS["ADMIN_ADRESS"]
        ];
        if(CheckMail::mail($dataForMail)) {
            $postData = [
                "id_contact"=> $idContact,
                "sender"=> $dataForMail["sender"],
                "recipient"=> $dataForMail["dest"], 
                "subject"=>$dataForMail["subject"],
                "message"=>$postChecked["message"],
                "sending_date"=> date("Y-m-d H:i:s")
            ];
            
            if(!$this->postData->setData("contact_reply", $postData) ) {
                throw new \Exception("Error for storing in bdd");
            }
            header("Location:".$GLOBALS["PATH"]."administration/admin/management/contacts/".$idContact);
            exit();
        }
    }
}