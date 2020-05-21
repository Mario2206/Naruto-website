<?php 
namespace Helper;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class CheckMail {

    /**
     * public method to send mail
     * 
     * @param array $data ->  keys = ["dest","subject", "message", "sender"]
     *      
     * !return bool value 
     */
    
    public static function mail(array $data, bool $html = false) : bool {
        $to = $data["dest"];
        $subject = $data["subject"];
        $message = $data["message"];
        $headers = [
            "From"=>$data["sender"],
            'X-Mailer' => 'PHP/' . phpversion(),
        ];
        $html ? $headers["Content-type"] = "text/html" : false;
        return mail($to, $subject, $message, $headers);
    } 

    /**
     * public method to prepare a correct confirmation mail
     * 
     * @param string $id, @param string $dest, @param string $vKey : required
     * 
     * !return bool value
     */

    public static function mailVerif (string $id,string $dest, string $vKey) : bool 
    {
        $link = "http://projet-naruto.local/subscription/verification/".$id."-".$vKey;
        $subject = "Verification du compte";
        $message = "
        <h1>Bonjour!</h1>
        <br/><br/>
        Voici un code de vérification afin de m'assurer que tu n'es pas un menteur !
        <br/><br/>
        CODE : {$link}
        <br/><br/>
        Garde ce code précieusement car il te sera demandé lors de ta première connexion sur le site !
        <br/><br/>
        Bonne journée mon ami et à la prochaine !!";
        
        $dataForMail = [
            "sender"=>$GLOBALS['ADMIN_ADRESS'],
            "dest"=>$dest,
            "subject"=>$subject,
            "message"=>$message
        ];

        return self::mail($dataForMail, true);
    }
    public static function inviteAdmin(string $id,string $dest, string $vKey) {

        $link = "http://projet-naruto.local/administration/admin/management/members/confirm/admin/".$id."-".$vKey;
        $subject = "Invitation";
        $message = "
        <h1>Bonjour!</h1>
        <br/><br/>
        Voici un code d'invitation pour que tu deviennes administrateur sur mon serveur !
        <br/><br/>
        CODE : {$link}
        <br/><br/>
        Garde ce code précieusement car il te sera demandé lors de ta première connexion sur le site !
        <br/><br/>
        Bonne journée mon ami et à la prochaine !!";
        
        $dataForMail = [
            "sender"=>$GLOBALS['ADMIN_ADRESS'],
            "dest"=>$dest,
            "subject"=>$subject,
            "message"=>$message
        ];

        return self::mail($dataForMail, true);
    }
}