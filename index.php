<?php 
include('controllers/Router.php');
// $get = array(
//     "action"=>"subscribing"
// );
// $post = array(
//     "firstname"=> "Math",
//      "lastname"=>"Raimb",
//      "username"=>"Derf250",
//     "mail"=>"example@mail.fr",
//     "password"=> "Matcamant@2206",
//     "confirmPassword"=>"Matcamant@2206", 
//     "village"=>"konoha",
//     "avatar"=>"img",
// );
$router = new Router();
$router->runRouter();


