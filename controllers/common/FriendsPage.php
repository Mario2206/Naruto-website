<?php

namespace Controller;

use Helper\Session;

class FriendsPage extends Controller {

    public function display() {
        
        $session = Session::getValue("user");
        $this->render("friends_page.php", compact("session"));
    }
}