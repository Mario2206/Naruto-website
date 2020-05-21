<?php
namespace Controller\Admin;

use Controller\Controller;

class Connection extends Controller {

    const GOOD_DIR = "administration/admin/management/"; 

    public function display() 
    {
        $this->render("administration/admin_connect.php");
    }

    public function checkPermission($data)
     {
        $this->redirect(self::GOOD_DIR);
    }
}