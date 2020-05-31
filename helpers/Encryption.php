<?php
namespace Helper;
/**
 * static class for encrypting data
 */
class Encryption {

     const ENCRYPT_KEY = "This is an encryption key. Forbidden to decrypt this.";

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
        $MAX = 922337203685477580;
        return mt_rand($MIN,$MAX);
    }

    /**
     * Method for creating a secure key, init with an id and a basic key
     * 
     * @param int $id
     * @param string $basic key
     * 
     * !return string
     */
    public static function createSecureKey(int $id, string $key) {
        return $id."//".sha1($id."-".self::ENCRYPT_KEY).$key;
    }
}