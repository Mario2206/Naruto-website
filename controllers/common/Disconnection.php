<?php

namespace Controller;

class Disconnection extends Controller {

    private $DIR;

    public function __construct()
    {
        parent::__construct();
        $this->DIR = $GLOBALS["PATH"];   
    }

    public function disconnect() {
        session_destroy();
        header("Location:".$this->DIR);
    }
}