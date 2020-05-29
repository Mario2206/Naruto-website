<?php

namespace Controller\Admin;
use Controller\Controller;
use Helper\FileReader;
use Helper\Session;

class CharactersManagement extends Controller {

    const POST_ALLOWED = ["name", "description"];
    const FILE_ALLOWED = "image";

    const MANAGER_DIR = "/administration/admin/management/characters/";
    const CREATION_DIR = "/administration/admin/management/characters/create";

    public function __construct()
    {
        parent::__construct();
        $this->protectPageFor('admin');
    }

    public function display() {

        $data = $this->getData->getAll("characters");
        $this->render("administration/admin_characters_manager.php", compact("data"));
    }

    public function displayForCreation() {

        $this->render("administration/admin_characters_creator.php");
    }

    public function displayForModification(int $id) {

        $data = $this->getData->getByFilters("characters", ["id"=>$id])[0];

        if($data) {

            Session::setValue("id_character", $id);
            $this->render("administration/admin_characters_creator.php", compact("data"));

        } else {

            $this->redirect(self::CREATION_DIR);
        }

    }

    public function setCharacter(array $post, int $id_charact = 0) {
       
        $postChecked = $this->checkPostVar($post, self::POST_ALLOWED);

        //Check if character data has to be change or create
        $current_char_id = Session::cleanValue("id_character");

        $is_update = $current_char_id === $id_charact;
        
        if(!$postChecked || !isset($_FILES[self::FILE_ALLOWED])) {

            throw new \Exception(ERROR_VAR_POST);

        }

        if($_FILES[self::FILE_ALLOWED]["size"] != 0 ) {

            $fileReader = new FileReader();
            $fileReader->defineDir("img_uploaded/characters/");

            if(!$fileReader->getImage($_FILES[self::FILE_ALLOWED])) {

                throw new \Exception(UPLOAD_ERROR);
    
            }
            $url_file = $fileReader->getUrl();
            $postChecked["image"]= $url_file;
        }

        $postChecked["is_online"] = isset($post["is_online"]) ? 1 : 0;
      
        !$is_update ? $postChecked["creation_date"] = date(DATE_FORMAT) : false;

        $fileReader ? $postChecked["image"] = $url_file : false;
            

        if(isset($post["is_online"])) {

            $postChecked["online_date"] = date(DATE_FORMAT);

        }
        
        if($is_update) {

            $state = $this->updateData->updateBdd("characters", $postChecked, ["id"=>$current_char_id]);

        } else {

            $state=$this->postData->setData("characters", $postChecked);

        }

        if($state) {

            $this->redirect(self::MANAGER_DIR);

        } else {

            throw new \Exception(BDD_ERROR);

        }
        
    }

    public function deleteCharacter(int $id_charact) {

        if($this->deleteData->deleteFromBdd("characters", ["id"=>$id_charact])) {

            $this->redirect(self::MANAGER_DIR);

        } else {

            throw new \Exception(BDD_ERROR);

        }

    }


}