<?php
namespace Controller;

use Exception;
use Helper\Cookie;
use Helper\Encryption;
use Helper\Session;
use Model\{
    Getdata,
    Postdata,
    Updatedata,
    Deletedata
};
/**
 * Basic controller class 
 * 
 * Get all models and children inherit of them
 */
abstract class Controller {

    protected $getData;
    protected $postData;
    protected $updateData;
    protected $deleteData;

    protected $errors = [];

    private $postAllowed;


    public function __construct() {
        $this->getData= new Getdata();
        $this->postData= new Postdata();
        $this->updateData= new Updatedata();
        $this->deleteData= new Deletedata();

        $this->connectByCookie();
    }

    protected function render(string $path, array $vars = []) {
        extract($vars);
        require ROOT."/views/components/".$path;
    }

    protected function redirect(string $url) {
        header("Location:".$url);
        exit();
    }

    protected function setError(string $error) {
        array_push($this->errors, $error);
    }
    protected function getError() {
        return $this->errors;
    }
    /**
     * protected method that enables to test the post request and check if  data is correct 
     * 
     * @param array $post
     * @param array $postAllowed
     * 
     * !return bool or array
     */
    protected function checkPostVar(array $post,array $postAllowed) {//check if all var are sended
        $this->postAllowed = $postAllowed;

        $postChecked = array_filter($post, function($key) {
            return in_array($key, $this->postAllowed);
        },ARRAY_FILTER_USE_KEY);
        return count($postChecked) === count($postAllowed) ? $postChecked : false;
    }

    /***
     * For hidding pages for connected persons
     */
    protected function prohibitionSession(string $session_type) {
        if(Session::getValue($session_type)) {
            $this->redirect("/");
        }
    }

    /**
     * For protected pages
     * @param string session_type
     */
    protected function protectPageFor(string $session_type) {
        if(!Session::getValue($session_type)) {
            $this->redirect("/");
        }
    }

    /**
     * For connecting by cookies
     */

    private function connectByCookie() {

        if($cook = Cookie::get("user_remember")) {
            
            $current_id = explode("//",$cook)[0];

            if($data = $this->getData->getByFilters("accounts", ["id"=>$current_id])) {

                if(Encryption::createSecureKey($data[0]->id,$data[0]->remember_key) === $cook) {

                    Session::startUserSession($data[0]);
                    
                }
            }
            
        }
    }
    
    /**
     * protected method for formating debug data
     * @param $debug Data
     * 
     * !return string
     */
    protected function debug($debug) :string {
        return "<pre>".var_dump($debug)."</pre>";
    }

    /**
     * protected method for delteing HTML elements from string value  
     * @param array $values
     * 
     * !return array clearedValues
     */
    protected function clearValueFromArray(array $values) : array    {
        $newValues = [];
        foreach($values as $key=>$val) {
            $newValues[$key] = strip_tags($val);
        }
        return $newValues;
    }

    protected function cut(array $initArray, string $keyToDelete) {
        $this->key = $keyToDelete;
        return array_filter($initArray, function($k) {
                return $k !== $this->key;
            },ARRAY_FILTER_USE_KEY);
    }
    
}