<?php

namespace Controller;

use Helper\Session;

class AnnexPage extends Controller {

    public function display() 
    {
        $session = Session::getValue("user");
        $this->render("legal_notice.php", compact("session"));
    }
}