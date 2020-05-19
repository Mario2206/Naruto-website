<?php 
namespace Controller;

use Model\ {
    Getdata,
};
use Helper\ {
    CheckMail,
    Encryption
};
/**
 * Class Connection Controller 
 */
class Connection extends Controller {

    private $GOOD_DIR;
    private $BAD_DIR;
    private $VERIF_DIR;
    private $MAIL_DIR;

    public function __construct()
    {
        parent::__construct();
        $this->GOOD_DIR = $GLOBALS["PATH"];
        $this->BAD_DIR = $GLOBALS["PATH"]."connection/";
        $this->VERIF_DIR = $GLOBALS["PATH"]."connection/waiting-confirmation";
        $this->MAIL_DIR = $GLOBALS["PATH"]."connection/send-confirmation-mail";
    }
    /**
     * method for sending connect view
     */
    public function displayConnect() {
        //View for connection 
        $this->prohibitionSession();
        require('../views/components/connect.php');
    }

    /**
     * method for checking entering connection
     * 
     * @param array $postData
     */
    public function checkForConnecting(array $post) {
        //Check informations from connection form
        if(isset($post["id_connection"]) && isset($post["password"])) {
            
            $id_connection = $post["id_connection"];
            $password = $post["password"];
            $isMail = filter_var($id_connection,FILTER_VALIDATE_EMAIL);
            $filter = $isMail ? ["mail"=>$id_connection] : ["username"=>$id_connection]; 
            
            
            if(!$account = $this->getData->getByFilters("accounts", $filter)[0]) {
                header("Location:".$this->BAD_DIR);
                exit();
            }
            //CHECK PASSWORD
            if(Encryption::check($password,$account->password)) {
                if($account->isVerif == 1) {
                    $_SESSION["current_account"] = $account;
                    header("Location:".$this->GOOD_DIR);
                    exit();
                } else {
                    header("Location:".$this->VERIF_DIR);
                    exit();
                }
            } else {
                header("Location:".$this->BAD_DIR);
                exit();
            }
        } else {
            throw new \Exception("ERROR ABOUT POST REQUEST : POST ID AREN'T CORRECT");
        }


    } 
    /**
     * method for sending confirmation view
     */
    public function displayConfirmMail() {
        $dir = $this->MAIL_DIR;
        $message = "Veuillez confirmer votre adresse mail silvousplait.<br/>Si le mail ne vous est pas parvenu, <a href='{$dir}'>cliquez-ici</a>";
        require("../views/components/info.php");
    }
    /**
     * method for resending confirm mail
     */
    public function sendEmailForSub() {
        $dest = $_SESSION['current_account']->mail;
        $vKey = $_SESSION["current_account"]->vKey;
        $id = $_SESSION["current_account"]->id;
        CheckMail::mailVerif($id,$dest, $vKey);
        header("Location:".$this->VERIF_DIR);
        exit();
    }

}