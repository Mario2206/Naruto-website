<?php

namespace Controller;

use Helper\Session;

class CharactPage extends Controller {

    public function display() {
        
        $session = Session::getValue("user");
        $data = $this->getData->getByFilters("characters", ["is_online"=>1]);
    
        $this->render("characters_page.php", compact("session", "data"));

    }
}