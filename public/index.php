<?php 
require('../vendor/autoload.php');
require("../config/config.php");
require("../config/error.php");

use Controller\{
    Router
};  


session_start();
$router = new Router();
$router->runRouter();
