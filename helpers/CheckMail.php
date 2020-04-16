<?php 
namespace Helper;

use Model\ {
    Getdata 
};

class CheckMail {


    public static function mailVerif (string $dest, string $vKey) : bool 
    {
        $getData = new Getdata();
        $id = $getData->getId("accounts", ["mail"=>$dest]);
        $link = "http://projet-naruto.local/subscription/verification/".$id."-".$vKey;
        $to = $dest;
        $subject = "Verification du compte";
        $message = "Bonjour!\n\nVoici un code de vérification afin de m'assurer que tu n'es pas un menteur !\n\nCODE : {$link}\n\nGarde ce code précieusement car il te sera demandé lors de ta première connexion sur le site !\n\nBonne journée mon ami et à la prochaine !!";
        $headers = [
            "From"=>"mathieu220601@gmail.com"
        ];

        return mail($to, $subject, $message, $headers);
    }

    public static function sendMail ($data) {
        $headers = [
            "From"=>$data['mail'],
            "Name"=>$data["name"],
            "Firstname"=>$data["firstname"]
        ];
        $to = $GLOBALS["ADMIN_ADRESS"];
        $message = $data["message"];
        $subject = $data["subject"];    

        return mail($to, $subject, $message, $headers);

    }
}