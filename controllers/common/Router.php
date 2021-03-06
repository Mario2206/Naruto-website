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
        parent::__construct();
        $this->post = $post ?? $_POST;
        $this->get = $get ?? $_GET;
    }
    /**
     * inits and checks all routes and actives the correct controller
     */

    public function runRouter() {

        $router = new \AltoRouter();
        $router->setBasePath(INTER_DIR);

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
            $control = new CharactPage();
            $control->display();
           });
           //<--  ARTICLES  ROUTES --> 
           $router->map("GET", "/adventures/[i:page]", function($params) {
            $control = new ArticlesManager();
            $control->display($params["page"]);
           });
           $router->map("GET", "/adventures/details/[i:id]-[i:page]", function($params) {
            $control = new ArticlesManager();
            $control->displayArticle($params["id"], $params["page"]);
           });
           $router->map("POST", "/adventures/details/post-comment", function() {
            $control = new ArticlesManager();
            $control->postComment($this->post);
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
                //LOGOUT
            $router->map("GET", "/administration/admin/disconnect", function() {
                $control = new \Controller\Admin\HomeManagement();
                $control->logout();
            });
            $router->map("POST", "/administration/admin/connecting", function() {
                $control = new \Controller\Admin\Connection();
                $control->login($this->post);
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
            $router->map("GET", "/administration/admin/management/articles/creation", function() {
                $control = new \Controller\Admin\ArticlesManager();
                $control->displayForCreation();
            });
            $router->map("POST", "/administration/admin/management/articles/creation/creating", function() {
                $control = new \Controller\Admin\ArticlesManager();
                $control->createArticle($this->post);
            });
            $router->map("GET", "/administration/admin/management/articles/modif/[i:id]-[i:page]", function($params) {
                $control = new \Controller\Admin\ArticlesManager();
                $control->displayForModification($params["id"], $params["page"]);
            });
            $router->map("POST", "/administration/admin/management/articles/modif/[i:id]", function($params) {
                $control = new \Controller\Admin\ArticlesManager();
                $control->changeData($this->post, $params["id"]);
            });
            $router->map("GET", "/administration/admin/management/articles/delete/[i:id]", function($params) {
                $control = new \Controller\Admin\ArticlesManager();
                $control->deleteArticle($params["id"]);
            });
                //members(user)
            $router->map("GET", "/administration/admin/management/members/", function() {
                $control = new \Controller\Admin\MembersManagement();
                $control->display();
            });
            $router->map("GET", "/administration/admin/management/members/delete/[i:id]", function($params) {
                $control = new \Controller\Admin\MembersManagement();
                $control->deleteMember($params["id"]);
            });
            $router->map("POST", "/administration/admin/management/members/modification/", function($params) {
                $control = new \Controller\Admin\MembersManagement();
                $control->dataChanging($this->post);
            });
                //members(admin)
            $router->map("POST", "/administration/admin/management/members/creation/admin/", function() {
                $control = new \Controller\Admin\AdminManagement();
                $control->inviteAdmin($this->post);
            });
            $router->map("GET", "/administration/admin/management/members/delete/admin/[i:id]", function($params) {
                $control = new \Controller\Admin\AdminManagement();
                $control->deleteAdmin($params["id"]);
            });
            $router->map("POST", "/administration/admin/management/members/modification/admin/", function($params) {
                $control = new \Controller\Admin\AdminManagement();
                $control->dataChanging($this->post);
            });
            $router->map("GET", "/administration/admin/management/members/confirm/admin/[i:id]-[i:vKey]", function($params) {
                $control = new \Controller\Admin\AdminManagement();
                $control->displaySubscribeAdmin($params["id"], $params['vKey']);
            });
            $router->map("POST", "/administration/admin/management/members/confirm/admin/checking/[i:id]-[i:vKey]", function($params) {
                $control = new \Controller\Admin\AdminManagement();
                $control->SubscribeAdminChecking($this->post, $params);
            });
            $router->map("GET", "/administration/admin/management/members/confirm/admin/finally/[i:id]-[i:vKey]", function($params) {
                $control = new \Controller\Admin\AdminManagement();
                $control->confirmSubsribeByAdmin($params["id"], $params["vKey"]);
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
                //characters
            $router->map("GET", "/administration/admin/management/characters/", function() {
                $control = new \Controller\Admin\CharactersManagement();
                $control->display();
            });
            $router->map("GET", "/administration/admin/management/characters/create", function() {
                $control = new \Controller\Admin\CharactersManagement();
                $control->displayForCreation();
            });
            $router->map("GET", "/administration/admin/management/characters/modif/[i:id]", function($params) {
                $control = new \Controller\Admin\CharactersManagement();
                $control->displayForModification($params["id"]);
            });
            $router->map("POST", "/administration/admin/management/characters/creating", function() {
                $control = new \Controller\Admin\CharactersManagement();
                $control->setCharacter($this->post);
            });
            $router->map("POST", "/administration/admin/management/characters/changing/[i:id]", function($params) {
                $control = new \Controller\Admin\CharactersManagement();
                $control->setCharacter($this->post, $params["id"]);
            });
            $router->map("GET", "/administration/admin/management/characters/delete/[i:id]", function($params) {
                $control = new \Controller\Admin\CharactersManagement();
                $control->deleteCharacter($params["id"]);
            });
            
            //<-- API ROUTES -->
            $router->map("POST", "/api/like/", function() {
                $control = new \Controller\API\User\LikeManager();
                $control->set($this->post);
            });
            $router->map("POST", "/api/check/data/user", function() {
                $control = new \Controller\API\UserManager();
                $control->checkData($this->post);
            });
            $router->map("POST", "/api/admin/set-online-state/characters", function() {
                $control = new \Controller\API\Admin\OnlineManager();
                $control->set($this->post, "characters");
            });
            $router->map("POST|GET", "/api/admin/set-online-state/articles", function() {
                $control = new \Controller\API\Admin\OnlineManager();
                $control->set($this->post, "articles");
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