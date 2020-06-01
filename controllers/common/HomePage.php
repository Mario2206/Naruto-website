<?php

namespace Controller;

use Helper\Session;

/**
 * Send the HomePage
 */
class HomePage extends Controller {


    public function display() {
        $session = Session::getValue("user");
        $this->render("homepage.php", compact("session"));
    }
    
}