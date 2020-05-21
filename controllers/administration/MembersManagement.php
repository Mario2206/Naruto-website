<?php
namespace Controller\Admin;

use Controller\Controller;
use Controller\Subscribe;
use Exception\ExceptionArr;
use Helper\{
    CheckMail,
    Encryption,
    Session,
    Checker
};

class MembersManagement extends Controller {

    const POST_ALLOWED = ["mail", "username", "village"];
    const POST_ALLOWED_FOR_SUB = ["firstname", "lastname", "admin_username", "admin_password", "confirmPassword"];
    const GOOD_DIR = "administration/admin/management/members/"; 

    //COMMON PART
    public function display() {
        $dataUsers = $this->getData->getAll("accounts");
        $dataAdmins =$this->getData->getAll("_admins");
        $villages_allowed = Subscribe::VILLAGE_ALLOWED;
        $this->render("administration/admin_members_management.php", compact("dataUsers", "dataAdmins", "villages_allowed"));
        
    }

    public function deleteMember(int $id, string $table) {
        if($this->deleteData->deleteFromBdd($table, ["id"=>$id])) {
            $this->redirect(self::GOOD_DIR);
        } else {
            throw new \Exception(BDD_ERROR);
        }
    }
    //USER PART
    public function dataChanging(array $post) {//A terminer
        $errors = [];
        $postChecked = $this->checkPostVar($post, self::POST_ALLOWED);
        //test
        if(!$postChecked) {
            array_push($errors, "Error for modification : entries aren't correct");
        }
        if(!Checker::checkMail($postChecked["mail"], "accounts") && $this->getData->getByFilters("accounts", ["mail"=>$postChecked["mail"]])) {
            $postChecked = $this->cut($postChecked, "mail");
        }
        if($this->getData->getByFilters("accounts",["username"=>$postChecked["username"]])) {
            $postChecked = $this->cut($postChecked, "username");
        }
        if(!in_array($postChecked["village"],Subscribe::VILLAGE_ALLOWED)) {
            array_push($errors, "Error for modification : village name is not correct");
        }
        //Error handler
        if(count($errors) > 0) {
            throw new ExceptionArr($errors);
        }
        //Connection to bdd
        if($this->updateData->updateBdd("accounts",$postChecked, ["id"=>$post["id"], "subDate"=>$post["sub_date"]])) {
            $this->redirect(self::GOOD_DIR);
        } else {
            throw new \Exception(BDD_ERROR);
        }

    }

    //ADMIN PART

    public function inviteAdmin(array $post) {
        if(array_key_exists("mail", $post) && Checker::checkMail($post["mail"]) && !$this->getData->getId("_admins", ["mail"=>$post["mail"]])) {

            $vkey = Encryption::createKey();
            $this->postData->setData("_admins", ["mail"=>$post["mail"], "vkey"=>$vkey]);
            $id = $this->getData->getId("_admins", ["mail"=>$post["mail"]]);

            if(CheckMail::inviteAdmin($id, $post["mail"], $vkey)) {
                $this->redirect(self::GOOD_DIR);
            } else {
                throw new \Exception(MAIL_ERROR);
            }  

        } else {
            throw new \Exception(ERROR_VAR_POST);
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
                if($this->updateData->updateBdd("_admins", $changes, ["id"=>$get["id"], "vkey"=>$get["vKey"]])) {
                    $this->redirect("administration/admin/management/members/confirm/admin/{$get['id']}-{$get['vKey']}");
                }else {
                    throw new \Exception(BDD_ERROR);
                }
            } else {
                Session::setError($this->getError());
                $this->redirect("administration/admin/management/members/confirm/admin/{$get['id']}-{$get['vKey']}");
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
            $this->redirect("administration/admin/management/members/");
        } else {
            header("HTTP/1.0 404 Not Found");
            exit();
        }
    }
}