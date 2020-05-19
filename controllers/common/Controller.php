<?php
namespace Controller;

use Exception;
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

    private $postAllowed;


    public function __construct() {
        $this->getData= new Getdata();
        $this->postData= new Postdata();
        $this->updateData= new Updatedata();
        $this->deleteData= new Deletedata();
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
    protected function prohibitionSession() {
        if(isset($_SESSION["current_account"])) {
            throw new Exception("Page 404 : not found");
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

    
}