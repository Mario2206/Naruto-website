<?php 

require('vendor/autoload.php');
require("config.php");

use Controller\{
    Router
};  

session_start();
$router = new Router();
$router->runRouter();
