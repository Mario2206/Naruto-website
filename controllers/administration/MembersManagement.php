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
    const GOOD_DIR = "/administration/admin/management/members/"; 

    public function __construct()
    {
        parent::__construct();
        $this->protectPageFor('admin');
    }

    //COMMON PART
    public function display() {
        $dataUsers = $this->getData->getAll("accounts");
        $dataAdmins =$this->getData->getAll("_admins");
        $villages_allowed = Subscribe::VILLAGE_ALLOWED;
        $errors = Session::getError();
        $levelAdmin = Session::getValue("admin")->level;
        $this->render("administration/admin_members_management.php", compact("dataUsers", "dataAdmins", "villages_allowed", "errors","levelAdmin"));
        Session::cleanError();
    }

    public function deleteMember(int $id) {

        if($this->deleteData->deleteFromBdd("accounts", ["id"=>$id])) {
            $this->redirect(self::GOOD_DIR);
            
        } else {
            throw new \Exception(BDD_ERROR);
        }
    }
    //USER PART
    public function dataChanging(array $post) {
        $errors = [];
        $postChecked = $this->checkPostVar($post, self::POST_ALLOWED);

        //test
        if(!$postChecked || !isset($post["id"]) || !isset($post['sub_date'])) {
            throw new \Exception(ERROR_VAR_POST);
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


    
}