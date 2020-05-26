<?php
namespace Controller\Admin;

use Controller\Controller;
use Helper\Encryption;
use Helper\Session;

class Connection extends Controller {

    const GOOD_DIR = "/administration/admin/management/"; 
    const BAD_DIR = "/administration/admin/connect";
    const POST_ALLOWED = ["admin_username", "admin_password"];

    public function __construct()
    {
        parent::__construct();
        $this->prohibitionSession('admin');
    }

    public function display() 
    {
        $error = Session::getError();
        $this->render("administration/admin_connect.php", compact("error"));
        $error = Session::cleanError();
    }

    public function login(array $data)
     {
         $postChecked = $this->checkPostVar($data, self::POST_ALLOWED);

         if(!$postChecked) {
             throw new \Exception(ERROR_VAR_POST);
         }

         if($currentUser = $this->getData->getByFilters("_admins", ["admin_username"=>$postChecked["admin_username"]])) {

            if(Encryption::check($postChecked["admin_password"], $currentUser[0]->admin_password)) {
                $dataToStore = array_filter($currentUser, function($k){return $k !== "admin_password";}, ARRAY_FILTER_USE_KEY);
                Session::startAdminSession($dataToStore);
                $this->redirect(self::GOOD_DIR);
            }
            
         } 
         Session::setError(["Identifiant ou mot de passe incorrect"]);
         $this->redirect(self::BAD_DIR);

        
    }
}