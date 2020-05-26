<?php

namespace Helper;

class Cookie {

    const ENCRYPT_KEY = "This is an encryption key";

    public static function set(string $name, string $val) {
        setcookie($name, $val, time() + 7 * 24 * 60 * 60, "/");
    }

    public static function get(string $name) {
        return $_COOKIE[$name] ?? null;
    }

    public static function clean(string $name) {
        setcookie($name, null, -1, "/");
    }   

    // FOR REMEMBER KEY
    public static function storeSessionKey(int $id, string $key) {
        $val = Encryption::createSecureKey($id, $key);
        self::set("user_remember", $val);
    }   
}