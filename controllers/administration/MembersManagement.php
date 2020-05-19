<?php
namespace Controller\Admin;

use Controller\Subscribe;
use Exception\ExceptionArr;

class MembersManagement extends Subscribe {

    const POST_ALLOWED = ["mail", "username", "village"];
    private $GOOD_DIR; 

    public function __construct()
    {
        parent::__construct();
        $this->GOOD_DIR = $GLOBALS["PATH"]."administration/admin/management/members/";
    }

    public function display() {
        $data = $this->getData->getAll("accounts");
        require("../views/components/administration/admin_members_management.php");
    }

    public function deleteMember(int $id) {
        if($this->deleteData->deleteFromBdd("accounts", ["id"=>$id])) {
            header("Location:".$this->GOOD_DIR);
            exit();
        } else {
            throw new \Exception("Error for deleting the member");
        }
    }

    public function displayModif(array $post) {//A terminer
        $errors = [];
        $postChecked = $this->checkPostVar($post, self::POST_ALLOWED);
        
        if(!$postChecked) {
            throw new \Exception("Error for modification : entries aren't correct");
        }
        if(!$this->checkMail($postChecked["mail"])) {
            $postChecked = array_filter($postChecked, function($k) {
                    return $k !== "mail";
            },ARRAY_FILTER_USE_KEY);
        }
        if($this->checkUsername(["username"=>$postChecked["username"]])) {
            $postChecked = array_filter($postChecked, function($k) {
                return $k !== "username";
        },ARRAY_FILTER_USE_KEY);
        }
        if(count($errors) > 0) {
            throw new ExceptionArr($errors);
        }
        if($this->updateData->updateBdd("accounts",$postChecked, ["id"=>$post["id"]])) {
            header("Location:".$this->GOOD_DIR);
            exit();
        } else {
            throw new \Exception("Error for modification");
        }

    }
}