<?php
namespace Controller\Admin;

use Controller\Controller;

class MembersManagement extends Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function display() {
        $data = $this->getData->getAll("accounts");
        require("../views/components/administration/admin_members_management.php");
    }
}