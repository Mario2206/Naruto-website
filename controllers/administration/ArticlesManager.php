<?php
namespace Controller\Admin;

use Controller\Controller;

class ArticlesManager extends Controller {



    public function __construct()
    {
        parent::__construct();
    }
    public function display() {
        require("../views/components/administration/admin_articles_management.php");
    }
}