<?php

namespace Controller;

class Disconnection extends Controller {

    public function disconnect() {
        session_destroy();
        $this->redirect("");
    }
}