<?php 
namespace Controller;

use Model\ {
    Getdata,
};
use Helper\ {
    CheckMail,
    Encryption
};

class Connection {

    const GOOD_DIR = "http://projet-naruto.local/";

    private $getData;

    public function __construct() {
        $this->getData = new Getdata();
    }

    public function displayConnect() {
        //View for connection 
        require('views/temp_connect.php');
    }

    public function checkForConnecting(array $post) {
        //Check informations from connection form
        if(isset($post["id_connection"]) && isset($post["password"])) {
            
            $id_connection = $post["id_connection"];
            $password = $post["password"];
            $isMail = preg_match(Subscribe::SYNTAX_MAIL, $id_connection);
            $filter = $isMail ? ["mail"=>$id_connection] : ["username"=>$id_connection]; 
            
            $account = $this->getData->getByFilters("accounts", $filter)[0];
            //CHECK PASSWORD
            if(Encryption::check($password,$account->password)) {
                $_SESSION["current_account"] = $account;
                if($account->isVerif == 1) {
                    header("Location:".Connection::GOOD_DIR);
                    exit();
                } else {
                    echo "votre compte  n'est pas vérifié";//Proposer de renvoyer un mail
                }
            } else {
                header("Location:".Connection::BAD_DIR);
                exit();
            }
        }


    } 

    public function sendEmailForSub() {
        $dest = $_SESSION['current_account']["mail"];
        $vKey = $_SESSION["current_account"]["vKey"];
        CheckMail::mailVerif($dest, $vKey);
        echo "l'email a été envoyé !";
    }

}