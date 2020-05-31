<?php

namespace Exception;
/**
 * Exception class for treating array data
 * 
 * @param array $messages
 */
class ExceptionArr extends \Exception {

    public function __construct(array $mess_arr, $code = 0) {
        parent::__construct(null, $code);
        $this->errors = $mess_arr;
    }

    /**
     * public method for returning errors
     * 
     * !return string errors
     */
    public function __toString() :string {
        $message = "";

        foreach($this->errors as $error) {
            $message.= "<li>{$error}</li>";
        }

        return "<ul>{$message}</ul>";
    }
}