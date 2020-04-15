<?php
namespace Controller;

class Router {

    private $get;
    private $post;
    
    function __construct($get = null,$post = null) {
        //FOR TESTING
        $this->post = $_POST ?? $post;
        $this->get = $_GET ?? $get;
    }
    

    public function runRouter() {
        $sub = new Subscribe();
        $post = $this->post;
        $get = $this->get;
        $router = new \AltoRouter();

        try{
            //CREATE ROUTES

            //<-- HOME ROUTES -->
            $router->map("GET", "/", function() {
                echo "Homepage";
           });

           //<-- CONTACT ROUTES -->
           $router->map("GET", "/contact/", function() {
                echo "Contact";
            });

            // <-- SUB ROUTES -->
           $router->map("GET", '/subscription/', function() {
               $control = new Subscribe();
                $control->displaySub();
           });
           $router->map("POST", '/subscription/subscribing', function(){
                $control = new Subscribe();
                $control->checkForSubscribing($this->post); 
           });
           $router->map("GET", '/subscription/subscribed', function() {
            $control = new Subscribe();
            $control->displaySubAccepted();
           });
           $router->map("GET", "/subscription/error", function() {
               $control = new Subscribe();
               $control->displayErrors();
           });
           $router->map("GET", "/subscription/verification/[i:id]-[i:vKey]", function($params) {
               $control = new Subscribe();
               $control->checkSubscribe($params["id"], $params["vKey"]);
           });

           //<-- CONNECT ROUTES -->
           $router->map("GET", "/connection/", function() {
               $control = new Connection();
               $control->displayConnect();
           });
           $router->map("POST", "/connection/connecting", function() {
            $control = new Connection();
            $control->checkForConnecting($this->post);
            });
            $router->map("GET", "/connection/error-connection", function() {
            $control = new Connection();
            $control->displayError();
            });


           //MATCH ROUTE
           $match = $router->match();

           if($match !== false ) {
               $match["target"]($match["params"]);
           } else {
               echo "HomePage";
               
           }
        } catch(\Exception $e) {
            die($e->getmessage());
        }
    }
}