<?php
namespace Helper;

class Encryption {

    public static function crypt($password) {
        return password_hash($password,PASSWORD_ARGON2I);
    }

    public static function check($passwordToTest,$hash_password) {
        return password_verify($passwordToTest, $hash_password);
    } 

    public static function createKey() {
        $MIN = 100000;
        $MAX = 10000000000;
        return mt_rand($MIN,$MAX);
    }
}