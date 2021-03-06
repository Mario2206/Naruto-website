<?php 
namespace Controller\Admin;

use Controller\Controller;
use Helper\CheckMail;
use Helper\Session;

class ContactManagement extends Controller {

    const KEY_ALLOWED = ["message"];

    public function __construct()
    {
        parent::__construct();
        $this->protectPageFor('admin');
    }

    public function display() {
        $data = $this->getData->getAll("contacts");
        $this->render("administration/admin_contact_manager.php", compact("data"));
        Session::cleanError();
    }

    public function displayContact(int $id) {
        $data = $this->getData->getByFilters("contacts", ["id"=>$id]);
        $errors = Session::getError() ?? null; 

        if($data[0]->already_seen == 0) {
            $this->updateData->updateBdd("contacts",["already_seen" => true], ["id"=>$id]);
        }
        if($reply = $this->getData->getByFilters("contact_reply", ["id_contact"=>$id])) {
            $data[0]->contact_reply = $reply[0];
        }
        
        $this->render("administration/admin_contact_details.php", compact("data", "errors"));
        Session::cleanError();
    }

    public function sendResponse(array $post, int $idContact) {
        if(!$postChecked = $this->checkPostVar($post, self::KEY_ALLOWED)) {
            throw new \Exception("Error about post Request : input names aren't correct");
        }
        $currentContact = $this->getData->getByFilters("contacts", ["id"=>$idContact]);

        if(iconv_strlen($postChecked["message"]) < 15 ) {
            Session::setError(["Le message doit faire au minimum 15 caractères"]);
            $this->redirect("/administration/admin/management/contacts/".$idContact);
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
            $this->redirect("/administration/admin/management/contacts/".$idContact);
        } else{
            // throw new \Exception("Error for sending mail, maybe the mail doesn't exist");
            Session::setError(["Le mail ne s'est pas correctement envoyé"]);
            $this->redirect("/administration/admin/management/contacts/".$idContact);
        }
    }
}