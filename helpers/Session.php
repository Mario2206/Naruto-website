<?php

namespace Helper;

class Session {

    static function startUserSession() {

    }
    public static function setValue(string $key, $val) {
        $_SESSION[PATH][$key] = $val;
    }
    public static function getValue(string $key) {
        return $_SESSION[PATH][$key];
    }
    
    static function setError(array $errors) {
        $_SESSION[PATH]["errors"] = $errors;
    }

    static function getError() {
        return $_SESSION[PATH]["errors"] ?? null;
    }

    static function cleanError() {
        $_SESSION[PATH]["errors"] = null;
    }
}