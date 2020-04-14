<?php
include('controllers/Subscribe.php');
class Router {

    private $get;
    private $post;
    
    function __construct($get = null, $post = null) {
        //FOR TESTING
        $this->get = $_GET ?  $_GET :  $get;
        $this->post = $_POST ? $_POST : $post;
        var_dump($this->get);
    }
    

    public function runRouter() {
        $get = $this->get;
        $post = $this->post;
        try{
            if(isset($get["action"])) {
                switch($get["action"]) {
                    case "subscribe" :
                        $sub = new Subscribe();
                        $sub->displaySub();
                        break;  
                    case "subscribing" : 
                        $sub = new Subscribe();
                        $sub->checkForSubscribing($post);
                        break;
                    case "subscribed" : 
                        $sub = new Subscribe();
                        $sub->displaySubAccepted();
                        break;
                    case "errorsubscribed" : 
                        $sub = new Subscribe();
                        $sub->errorSub();
                    break;
                    default : 
                        throw new Exception("Page not found");
                }
            } else {
                throw new Exception("Page not found");
            }
        } catch(Exception $e) {
            die($e->getmessage());
        }
    }
}