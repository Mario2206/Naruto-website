<?php 
namespace Helper;

class Checker {



    /**
     * check if  password and confirm password are identical and if the password has a correct syntax
     * 
     * @param array passwords : ["password", "confirmPassword]
     * 
     * !return bool
     */
    public static function checkPassword(array $passwords) : bool {//array
        if($passwords[0] === $passwords[1]) {
            $numberMaj = array_filter(explode("//",$passwords[0]),function($item){
                return preg_match("#[A-Z]#", $item);
            });
            $numberCaract = array_filter(explode("//",$passwords[0]),function($item){
                return preg_match("#[\$!/;,?ù%£^+=}{'@\#]#", $item);
            });
            $numberNum = array_filter(explode("//",$passwords[0]),function($item){
                return preg_match("#[0-9]#", $item);
            });
            return $numberMaj > 0 && $numberCaract > 0 && $numberNum > 2 && iconv_strlen($passwords[0]) > 10;
        } else {
            return false;
        } 
    }

    /**
     * Check if the mail has a correct syntax and if it doesn't exist in bdd
     * 
     * @param string mail
     * @param string table
     * 
     * !return bool
     * */
    public static function checkMail(string $mail) : bool {
        return filter_var($mail, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Check length of string
     * 
     * @param string $text
     * @param int $minLength
     * @param int $maxLength
     * 
     * !return bool
     */
    public static function checkLength(string $t, int $minLen = 0, float $maxLen = INF) : bool {
        $len = iconv_strlen($t);
        return $len >= $minLen && $len <= $maxLen;
    }

    /**
     * Check length of all strings belonging to an array 
     * 
     * @param array $array
     * @param int $minLength
     * @param int $maxLength
     * 
     * !return bool
     */
    public static function checkLengthOfArray(array $arr,int $minLen = 0, float $maxLen = INF) {
        foreach($arr as $v) {
            if(!self::checkLength($v, $minLen, $maxLen)) {
                return false;
            }
        }
        return true;
    }
}