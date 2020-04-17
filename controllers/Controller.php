<?php
namespace Controller;

use Model\{
    Getdata,
    Postdata,
    Updatedata,
    Deletedata
};
/**
 * 
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

    protected function checkPostVar($post, $postAllowed) {//check if all var are sended
        $this->postAllowed = $postAllowed;

        $postChecked = array_filter($post, function($key) {
            return in_array($key, $this->postAllowed);
        },ARRAY_FILTER_USE_KEY);
        return count($postChecked) === count($postAllowed) ? $postChecked : false;
    }
    
    protected function debug($debug) {
        echo "<pre>".var_dump($debug)."</pre>";
    }
}