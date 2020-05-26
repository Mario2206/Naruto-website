<?php 
namespace Controller;

use Model\ {
    Getdata,
};
use Helper\ {
    CheckMail,
    Cookie,
    Encryption,
    Session
};
/**
 * Class Connection Controller 
 */
class Connection extends Controller {

    const GOOD_DIR = "/";
    const BAD_DIR = "/connection/";
    const VERIF_DIR = "/connection/waiting-confirmation";
    const MAIL_DIR = "/connection/send-confirmation-mail";


    /**
     * method for sending connect view
     */
    public function displayConnect() {
        //View for connection 
        $this->prohibitionSession("user");
        $error = Session::getError();
        $this->render("connect.php", compact("error"));
        Session::cleanError();
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
                Session::setError(["Les identifiants sont incorrects"]);
                $this->redirect(self::BAD_DIR);
            }

            //CHECK PASSWORD
            if(Encryption::check($password,$account->password)) {

                if($account->isVerif == 1) {
                    Session::startUserSession($account);
                    if(isset($post["keepConnection"])) {
                       //SET COOKIE
                       $remember_token = Encryption::createKey();
                       $this->updateData->updateBdd("accounts", ["remember_key"=>$remember_token], ['id'=>$account->id]);
                       Cookie::storeSessionKey($account->id, $remember_token);
                    }
                    $this->redirect(self::GOOD_DIR);

                } else {
                    $this->redirect(self::VERIF_DIR);
                }

            } else {
                Session::setError(["Les identifiants sont incorrects"]);
                $this->redirect(self::BAD_DIR);
            }

        } else {
            throw new \Exception("ERROR ABOUT POST REQUEST : POST ID AREN'T CORRECT");
        }


    } 
    /**
     * method for sending confirmation view
     */
    public function displayConfirmMail() {
        $dir = self::MAIL_DIR;
        $message = "Veuillez confirmer votre adresse mail silvousplait.<br/>Si le mail ne vous est pas parvenu, <a href='{$dir}'>cliquez-ici</a>";
        $this->render("info.php", compact("dir", "message"));
    }
    /**
     * method for resending confirm mail
     */
    public function sendEmailForSub() {
        $dest = $_SESSION['current_account']->mail;
        $vKey = $_SESSION["current_account"]->vKey;
        $id = $_SESSION["current_account"]->id;
        CheckMail::mailVerif($id,$dest, $vKey);
        $this->redirect(self::VERIF_DIR);
    }

}