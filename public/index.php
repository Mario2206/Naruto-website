<?php 
require('../vendor/autoload.php');
require("../config/config.php");
require("../config/error.php");

use Controller\{
    Router
};  

define("ROOT", dirname(__DIR__));
define("PATH", "http://projet-naruto.local/");

session_start();
$router = new Router();
$router->runRouter();
