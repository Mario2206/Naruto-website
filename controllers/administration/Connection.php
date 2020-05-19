<?php
namespace Controller\Admin;

use Controller\Controller;

class Connection extends Controller {

    private $GOOD_DIR; 

    function __construct()
    {
        parent::__construct();
        $this->GOOD_DIR = $GLOBALS["PATH"]."administration/admin/management/";
    }

    public function display() 
    {
        require("../views/components/administration/admin_connect.php");
    }

    public function checkPermission($data) {
        header("Location:".$this->GOOD_DIR);
    }
}