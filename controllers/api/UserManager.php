<?php

namespace Controller\API;

use Controller\Controller;
use Helper\Session;

class UserManager extends Controller {

    const DATA_ALLOWED = ["username", "mail"];

    public function checkData($post) {

        if(!in_array(key($post),self::DATA_ALLOWED) || count($post) != 1) {
           
            echo json_encode(["response" => $post]);
            die();
    
        }

        if($this->getData->getId("accounts", $post)) {

            echo json_encode(["response"=>true]);
            die();

        } else {

            echo json_encode(["response"=>false]);
            die();

        }



    }

}