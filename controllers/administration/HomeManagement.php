<?php

namespace Controller\Admin;

use Controller\Controller;
use Helper\Session;

class HomeManagement extends Controller {

    public function __construct()
    {
        parent::__construct();
        $this->protectPageFor('admin');
    }

    public function display() {
        $this->render("administration/admin_home.php");
    }

    public function logout() {
        Session::closeAdminSession();
        $this->redirect("/");
    }
}