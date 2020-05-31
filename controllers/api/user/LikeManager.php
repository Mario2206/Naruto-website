<?php
namespace Controller\API\User;

use Controller\Controller;
use Helper\Session;

class LikeManager extends Controller {


    public function set(array $post) {

        if(!isset($post["article_id"])) {

            $this->sendJsonResponse(ERROR_VAR_POST);
        
        }

        $user = Session::getValue("user");

        if($user) {

            if(!$this->getData->getId("articles_like", ["account_id"=>$user->id, "article_id"=>$post["article_id"]])) {

                //ADD LIKE

                $dataToPost = [
                    "account_id"=>$user->id,
                    "article_id"=>$post["article_id"],
                    "date"=>date(DATE_FORMAT)
                ];

                if($this->postData->setData("articles_like", $dataToPost )) {

                    $this->sendJsonResponse("add");

                } else {

                    $this->sendJsonResponse(BDD_ERROR);

                }

            } else {

                //DELETE LIKE

               if($this->deleteData->deleteFromBdd("articles_like", ["account_id"=>$user->id, "article_id"=>$post["article_id"]])) {

                    $this->sendJsonResponse("delete");

               } else {

                $this->sendJsonResponse(BDD_ERROR);

               }

            }

        } else {

            $this->sendJsonResponse("no identification");;

        }
    }
}
