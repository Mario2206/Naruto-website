<?php
namespace Controller;

use Exception\{
    ExceptionArr
};
/**
 * 
 */
class Router {

    private $get;
    private $post;
    
    function __construct(array $get = null, array $post = null) {
        //FOR TESTING
        $this->post = $_POST ?? $post;
        $this->get = $_GET ?? $get;
    }
    

    public function runRouter() {

        $router = new \AltoRouter();

        try{
            //CREATE ROUTES

            //<-- HOME ROUTES -->
            $router->map("GET", "/", function() {
                $control = new HomePage();
                $control->display();
           });

           //<--  ANNEX ROUTES --> 
           $router->map("GET", "/my-friends/", function() {
            $control = new AnnexPage();
            $control->display();
           });

           //<-- CONTACT ROUTES -->
           $router->map("GET", "/contact/", function() {
                $control = new Contact();
                $control->displayContact();
            });
            $router->map("POST", "/contact/contacting", function() {
                $control = new Contact();
                $control->checkContactReq($this->post);
            });
            $router->map("GET", "/contact/contacted", function() {
                $control = new Contact();
                $control->displayEndReq();
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
           $router->map("GET", "/subscription/verification/[i:id]-[i:vKey]", function(array $params) {
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
            $router->map("GET", "/connection/verification", function() {
                $control = new Connection();
                $control->sendEmailForSub();
            });


           //MATCH ROUTE
           $match = $router->match();

           if($match !== false ) {
               $match["target"]($match["params"]);
           } else {
                $control = new HomePage();
                $control->display();
               
           }
        } 
        catch(ExceptionArr $e) {
            die($e);
        }
        catch(\Exception $e) {
            die($e->getMessage());
        }
    }
}