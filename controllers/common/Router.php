<?php
namespace Controller;

use Exception\{
    ExceptionArr
};

use Helper\FileReader;

/**
 * Routing class : manages all possible routes
 * 
 * @param array $get : for testing and simulating GET request
 * @param array $post : for testing and simulating POST request
 */
class Router extends Controller {

    private $get;
    private $post;
    
    function __construct(array $get = null, array $post = null) {
        //FOR TESTING
        $this->post = $post ?? $_POST;
        $this->get = $get ?? $_GET;
    }
    /**
     * inits and checks all routes and actives the correct controller
     */

    public function runRouter() {

        $router = new \AltoRouter();

        try{
            //CREATE ROUTES

            //<-- HOME ROUTES -->
            $router->map("GET", "/", function() {
                $control = new HomePage();
                $control->display();
           });

           //<-- ANNEX ROUTES -->
           $router->map("GET", "/legal_notices/", function() {
            $control = new AnnexPage();
            $control->display();
           });
           //<--  FRIENDS PAGE ROUTES --> 
           $router->map("GET", "/my-friends/", function() {
            $control = new FriendsPage();
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
               $control = new \Controller\Connection();
               $control->displayConnect();
           });
           $router->map("POST", "/connection/connecting", function() {
                $control = new \Controller\Connection();
                $control->checkForConnecting($this->post);
            });
            $router->map("GET", "/connection/waiting-confirmation", function() {
                $control = new \Controller\Connection();
                $control->displayConfirmMail();
            });
            $router->map("GET", "/connection/send-confirmation-mail", function() {
                $control = new \Controller\Connection();
                $control->sendEmailForSub();
            });
            
            //<-- DISCONNECT ROUTE -->
            $router->map("GET", "/disconnection/", function() {
                $control = new Disconnection();
                $control->disconnect();
            });

            //<-- ROUTES FOR ADMINISTRATION -->

                //Connection
            $router->map("GET", "/administration/admin/connect", function() {
                $control = new \Controller\Admin\Connection();
                $control->display();
            });
            $router->map("POST", "/administration/admin/connecting", function() {
                $control = new \Controller\Admin\Connection();
                $control->checkPermission($this->post);
            });
                //Home
            $router->map("GET", "/administration/admin/management/", function() {
                $control = new \Controller\Admin\HomeManagement();
                $control->display();
            });
                //articles
            $router->map("GET", "/administration/admin/management/articles/", function() {
                $control = new \Controller\Admin\ArticlesManager();
                $control->display();
            });
                //members
            $router->map("GET", "/administration/admin/management/members/", function() {
                $control = new \Controller\Admin\MembersManagement();
                $control->display();
            });
                //contact
            $router->map("GET", "/administration/admin/management/contacts/", function() {
                $control = new \Controller\Admin\ContactManagement();
                $control->display();
            });
            $router->map("GET|POST", "/administration/admin/management/contacts/[i:id]", function($params) {
                $control = new \Controller\Admin\ContactManagement();
                $control->displayContact($params["id"]);
            });
            $router->map("POST", "/administration/admin/management/contacts/reply/[i:id]", function($params) {
                $control = new \Controller\Admin\ContactManagement();
                $control->sendResponse($this->post, $params["id"]);
            });

             //<-- ROUTES FOR TESTING -->
             $router->map("GET", "/test/", function() {
                 var_dump($this->clearValueFromArray(array()));
               // require("../views/test.php");
            });
            $router->map("POST", "/test/ok", function() {
                $fileReader = new FileReader();
                echo $this->debug($fileReader->getImage($_FILES["test"]));
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