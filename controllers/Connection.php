<?php 
namespace Controller;

use Model\ {
    Getdata,
    Encryption
};

class Connection {

    const GOOD_DIR = "http://projet-naruto.local/";
    const BAD_DIR = "http://projet-naruto.local/connection/error-connection";

    private $getData;

    public function __construct() {
        $this->getData = new Getdata();
    }

    public function displayConnect() {
        //View for connection 
        require('views/temp_connect.php');
    }

    public function checkForConnecting($post) {
        //Check informations from connection form
        if(isset($post["id_connection"]) && isset($post["password"])) {
            
            $id_connection = $post["id_connection"];
            $password = $post["password"];
            $isMail = preg_match(Subscribe::SYNTAX_MAIL, $id_connection);
            $filter = $isMail ? ["mail"=>$id_connection] : ["username"=>$id_connection]; 
            
            $account = $this->getData->getByFilters("accounts", $filter)[0];
            //CHECK PASSWORD
            if(Encryption::check($password,$account->password)) {
                if($account->isVerif == 1) {
                    $_SESSION["current_account"] = $account;
                    header("Location:".Connection::GOOD_DIR);
                } else {
                    header("Location:".Connection::BAD_DIR);
                }
            } else {
                header("Location:".Connection::BAD_DIR);
            }
        }


    }

    public function displayError() {
        //show error if there is
        echo "Les données soumises sont incorrectes ou vous n'avez pas procédé à la vérification de votre compte";
    }   

}