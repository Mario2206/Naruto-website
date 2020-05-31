<?php

namespace Controller\API\Admin;
use Controller\Controller;
use Helper\Session;

class OnlineManager extends Controller {


    const POST_ALLOWED = ["is_online", "id"];

    public function set(array $post, string $table) {

        $admin = Session::getValue("admin");

        if(!$admin) {

          $this->sendJsonResponse(ACCESS_FORBIDDEN);

        }

        $postChecked = $this->checkPostVar($post, self::POST_ALLOWED);

        if($postChecked) {

            $postForUpdate = array_filter($postChecked, function($k) {
                return $k != "id";
            },ARRAY_FILTER_USE_KEY);

            if($this->updateData->updateBdd($table,["is_online"=>$postChecked["is_online"]], ["id"=>$postChecked["id"]])) {

                $this->sendJsonResponse("good Update");

            } else {

                $this->sendJsonResponse(BDD_ERROR);

            }

        } else {
            
            $this->sendJsonResponse(ERROR_VAR_POST);

        }

    }

}