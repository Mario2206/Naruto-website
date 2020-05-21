<?php

namespace Controller;
/**
 * Send the HomePage
 */
class HomePage extends Controller {

    public function display() {
        $this->render("homepage.php");
    }
    
}