<?php

class Encryption {

    public function crypt($password) {
        return password_hash($password,PASSWORD_ARGON2I);
    }

    public function check($passwordToTest,$hash_password) {
        return password_verify($passwordToTest, $hash_password);
    } 
}