<?php
namespace Helper;
/**
 * static class for encrypting data
 */
class Encryption {

    /**
     * method for encrypting
     * 
     * @param string $data
     * 
     * !return string $encryptedData
     */
    public static function crypt(string $password) :string {
        return password_hash($password,PASSWORD_ARGON2I);
    }
    /**
     * method for checking encrypted data
     * 
     * @param string data for checking
     * @param string encrypted data
     * 
     * !return bool 
     */
    public static function check(string $passwordToTest, string $hash_password) : bool {
        return password_verify($passwordToTest, $hash_password);
    } 
    /**
     * method for creating key
     * 
     * !return integer key
     */
    public static function createKey() {
        $MIN = 100000;
        $MAX = 9223372036854775800;
        return mt_rand($MIN,$MAX);
    }
}