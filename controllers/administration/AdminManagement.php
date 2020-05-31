<?php
namespace Controller\Admin;

use Controller\Controller;
use Helper\{
    Session,
    Checker,
    Encryption,
    CheckMail
};


class AdminManagement extends Controller {

    const POST_ALLOWED_FOR_SUB = ["firstname", "lastname", "admin_username", "admin_password", "confirmPassword"];
    const POST_ALLOWED = ["admin_username", "mail", "level"];
    const GOOD_DIR = "/administration/admin/management/members/"; 

    private $adminLevel;

    public function __construct()
    {
        parent::__construct();
        $this->protectPageFor('admin');

        $this->adminLevel = Session::getValue("admin")->level;

    }

    public function inviteAdmin(array $post) {

        

        if($this->adminLevel < 1) {

            throw new \Exception(ACCESS_FORBIDDEN);

        }

        if(array_key_exists("mail", $post)) {

            if(!Checker::checkMail($post["mail"]) || $this->getData->getId("_admins", ["mail"=>$post["mail"]])) {
                Session::setError(["Le mail n'est pas conforme ou est déjà pris"]);
                $this->redirect(self::GOOD_DIR);
            }

            $vkey = Encryption::createKey();
            if(!$this->postData->setData("_admins", ["mail"=>$post["mail"], "vkey"=>$vkey])) {
                throw new \Exception(BDD_ERROR);
            }
            $id = $this->getData->getId("_admins", ["mail"=>$post["mail"]]);

            if(CheckMail::inviteAdmin($id, $post["mail"], $vkey)) {
                $this->redirect(self::GOOD_DIR);
            } else {
                Session::setError(["Le mail n'a pas pu s'envoyer"]);
                $this->redirect(self::GOOD_DIR);
            }  

        } else {
            throw new \Exception(ERROR_VAR_POST);
        }
    }

    public function deleteAdmin(int $id) {

        if($this->adminLevel < 1) {

            throw new \Exception(ACCESS_FORBIDDEN);

        }

        if($this->deleteData->deleteFromBdd("_admins", ["id"=>$id])) {
            $this->redirect(self::GOOD_DIR);
            
        } else {
            throw new \Exception(BDD_ERROR);
        }
    }

    public function dataChanging(array $post) {

        if($this->adminLevel < 1) {

            throw new \Exception(ACCESS_FORBIDDEN);

        }

        $postChecked = $this->checkPostVar($post, self::POST_ALLOWED);
        if(!$postChecked || !isset($post["id"]) || !isset($post["date"])) {
            throw new \Exception(ERROR_VAR_POST);
        }
        if(!Checker::checkMail($postChecked["mail"]) || $this->getData->getId("_admins", ["mail"=>$post["mail"]])) {
            $postChecked = $this->cut($postChecked, "mail");
        }
        //Connection to bdd
        if($this->updateData->updateBdd("_admins",$postChecked, ["id"=>$post["id"], "date"=>$post["date"]])) {
            $this->redirect(self::GOOD_DIR);

        } else {
            throw new \Exception(BDD_ERROR);
        }

    }

    public function displaySubscribeAdmin(int $id, int $vkey) {
        $errors = Session::getError();

        if($data = $this->getData->getByFilters("_admins", ["id"=>$id, "vkey"=>$vkey])) {
            $sub = $data[0]->admin_username !== "";
            $this->render("administration/admin_subscribe.php", compact("id", "vkey", "errors", "sub"));

        } else {
            header("HTTP/1.0 404 Not Found");
            exit();
        }
        
    }

    public function SubscribeAdminChecking(array $post, array $get) { // A finir
        $postChecked = $this->checkPostVar($post, self::POST_ALLOWED_FOR_SUB);

        if($postChecked) {

            if(!Checker::checkLengthOfArray($postChecked, 3)) {
                $this->setError("Il manque des informations");
            }

            if($this->getData->getByFilters("_admins",["admin_username"=>$postChecked["admin_username"]])) {
                $this->setError("Le nom d'utilisateur est déjà pris");
            }

            if(!Checker::checkPassword([$postChecked["admin_password"], $postChecked["confirmPassword"]])) {
                $this->setError("Les mots de passes ne sont pas conformes");
            }

            if(count($this->getError()) === 0 ) {

                $changes = array_filter($postChecked, function($k){
                    return $k !== "confirmPassword";
                }, ARRAY_FILTER_USE_KEY);
                
                $changes["date"]= date(DATE_FORMAT);
                $changes["admin_password"] = Encryption::crypt($changes["admin_password"]);

                if($this->updateData->updateBdd("_admins", $changes, ["id"=>$get["id"], "vkey"=>$get["vKey"]])) {
                    $this->redirect("/administration/admin/management/members/confirm/admin/{$get['id']}-{$get['vKey']}");

                }else {
                    throw new \Exception(BDD_ERROR);
                }
                
            } else {
                Session::setError($this->getError());
                $this->redirect("/administration/admin/management/members/confirm/admin/{$get['id']}-{$get['vKey']}");
            }

        } else {
            throw new \Exception(ERROR_VAR_POST);
        }
    }

    public function confirmSubsribeByAdmin(int $id, int $vkey) {

        if($data = $this->getData->getByFilters("_admins", ["id"=>$id, "vkey"=>$vkey])) {

            if($data[0]->is_activated == 0) {
                $this->updateData->updateBdd("_admins", ["is_activated"=>1], ["id"=>$id, "vkey"=>$vkey]);
            }

            $this->redirect("/administration/admin/management/members/");

        } else {
            header("HTTP/1.0 404 Not Found");
            exit();
        }
    }
}
