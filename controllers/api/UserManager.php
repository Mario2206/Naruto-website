<?php

namespace Controller\API;

use Controller\Controller;
use Helper\Session;

class UserManager extends Controller {

    const DATA_ALLOWED = ["username", "mail"];

    public function checkData($post) {

        if(!in_array(key($post),self::DATA_ALLOWED) || count($post) != 1) {
           
            $this->sendJsonResponse(ERROR_VAR_POST);
    
        }

        if($this->getData->getId("accounts", $post)) {

            $this->sendJsonResponse(true);

        } else {

            $this->sendJsonResponse(false);

        }

    }

}