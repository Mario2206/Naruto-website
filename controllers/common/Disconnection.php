<?php

namespace Controller;

use Helper\Cookie;
use Helper\Session;

class Disconnection extends Controller {

    public function disconnect() {

        Session::closeUserSession();

        if(Cookie::get("user_remember")) {
            Cookie::clean("user_remember");
        }
        
        $this->redirect("/");
    }
}