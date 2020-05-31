<?php

namespace Helper;

class Session {

    public static function startAdminSession(Object $dataAboutAdmin) {
        self::setValue("admin", $dataAboutAdmin);
    }

    public static function closeAdminSession() {
        self::setValue("admin", null);
    }

    public static function startUserSession(object $dataAboutUser) {
        self::setValue("user", $dataAboutUser);
    }

    public static function closeUserSession() {
        self::setValue("user", null);
    }

    public static function setValue(string $key, $val) {
        $_SESSION[PATH][$key] = $val;
    }
    public static function getValue(string $key) {
        return $_SESSION[PATH][$key] ?? null;
    }
    
    public static function cleanValue(string $key) {
        $val = self::getValue($key);
        self::setValue($key, null);
        return $val;
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