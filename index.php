<?php 
require('vendor/autoload.php');
use Controller\{
    Router
};  
session_start();
$router = new Router();
$router->runRouter();


