<?php
namespace Controller\API;

use Controller\Controller;
use Helper\Session;

class LikeManager extends Controller {


    public function set(array $post) {

        if(!isset($post["article_id"])) {

            echo json_encode(["response"=>ERROR_VAR_POST]);
            die();
        
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

                    echo json_encode(["response"=> "add"]);

                } else {

                   echo json_encode(["response"=> BDD_ERROR]);

                }

            } else {

                //DELETE LIKE

               if($this->deleteData->deleteFromBdd("articles_like", ["account_id"=>$user->id, "article_id"=>$post["article_id"]])) {

                    echo json_encode(["response"=> "delete"]);

               } else {

                    echo json_encode(["response"=> BDD_ERROR]);

               }

            }

        } else {

            echo json_encode(["response"=> "no identification"]);;

        }
    }
}
