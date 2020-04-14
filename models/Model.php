<?php

abstract class Model {

    protected $bdd;

     function __construct() {
        try{

            $this->bdd = new PDO("mysql:host=localhost;dbname=projet_naruto;charset=utf8", "root", "");
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);

        } catch (Exception $e) {

            echo "Caught excpetion", $e->getMessage();
        }
        
    }
}