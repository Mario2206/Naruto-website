<?php
namespace Controller\Admin;

use Controller\Controller;
use Helper\Checker;
use Helper\FileReader;

class ArticlesManager extends Controller {

    const POST_ALLOWED = ["title", "content", "synopsis"];
    const FILE_ALLOWED = "miniature";
    const GOOD_DIR = "/administration/admin/management/articles/";


    public function __construct()
    {
        parent::__construct();
        $this->protectPageFor('admin');
    }
    
    public function display() 
    {
        $articles = $this->getData->getAll("articles");
        $this->render("administration/admin_articles_management.php", compact("articles"));
    }

    public function displayForCreation(int $id = null) {
        if($id) {
           $data = $this->getData->getByFilters("articles", ['id'=>$id]); 
        }
        $this->render("administration/admin_article_creator.php", compact(isset($data) ? "data" : null));
    }

    public function createArticle(array $post) {

        $postChecked = $this->checkPostVar($post,self::POST_ALLOWED);
       
        if(!$postChecked  || !isset($_FILES[self::FILE_ALLOWED]))  {
            throw new \Exception(ERROR_VAR_POST);
        }

        if($_FILES[self::FILE_ALLOWED]['size'] > 0) {

            $fileReader = new FileReader();
            $fileReader->defineDir("img_uploaded/post/");

            if(!$fileReader->getImage($_FILES[self::FILE_ALLOWED])) {
                throw new \Exception(UPLOAD_ERROR);
            }
            $fileUrl = $fileReader->getUrl();
        }
        

        $postChecked["is_online"] = isset($post["is_online"]) ? 1 : 0;

        $addons = [
            "miniature"=>$fileUrl ?? "",
            "creation_date"=>date(DATE_FORMAT)
        ];

        if($postChecked["is_online"] == 1) {
            $addons["online_date"] = date(DATE_FORMAT);
        }

        $postToSend = array_merge($postChecked, $addons);

        if($this->postData->setData("articles", $postToSend)) {
            $this->redirect(self::GOOD_DIR);

        } else {
            throw new \Exception(BDD_ERROR);
        }

    }

    public function deleteArticle(int $id) {

        if($this->deleteData->deleteFromBdd("articles", ["id"=>$id])) {
            $this->redirect(self::GOOD_DIR);

        } else {
            throw new \Exception(BDD_ERROR);
        }
    }

    public function changeData(array $post) {

        $postChecked = $this->checkPostVar($post, self::POST_ALLOWED);

        if(!$postChecked || !isset($_FILES[self::FILE_ALLOWED]) || !isset($post["id"])) {
            throw new \Exception(ERROR_VAR_POST);
        }

        if($_FILES[self::FILE_ALLOWED]["size"] > 0) {

            $fileReader = new FileReader();
            $fileReader->defineDir("img_uploaded/post/");

            if(!$fileReader->getImage($_FILES[self::FILE_ALLOWED])) {
                throw new \Exception(UPLOAD_ERROR);
            }
            $fileUrl = $fileReader->getUrl();
        }

        $changes = [
            "title"=>$postChecked["title"],
            "content"=>$postChecked["content"],
            "is_online"=> isset($post["is_online"]) ? 1 : 0
        ];

        if(isset($fileUrl)) {
            $changes["miniature"] = $fileUrl;
        }

        if($this->updateData->updateBdd("articles", $changes, ["id"=>$post["id"]])) {

            $this->redirect(self::GOOD_DIR);

        } else {

            throw new \Exception(BDD_ERROR);
        }
    } 
}