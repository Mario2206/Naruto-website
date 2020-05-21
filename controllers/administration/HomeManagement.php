<?php

namespace Controller\Admin;

use Controller\Controller;

class HomeManagement extends Controller {


    public function display() {
        $this->render("administration/admin_home.php");
    }
}