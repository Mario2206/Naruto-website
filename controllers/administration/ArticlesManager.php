<?php
namespace Controller\Admin;

use Controller\Controller;
use Helper\Checker;
use Helper\FileReader;

class ArticlesManager extends Controller {

    const POST_ALLOWED = ["title", "content", "synopsis"];
    const FILE_ALLOWED = "miniature";
    const GOOD_DIR = "/administration/admin/management/articles/";
    const CREATOR_DIR = "/administration/admin/management/articles/creation";
    const MAX_COMMENTS = 10;


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

    public function displayForCreation() {

        $this->render("administration/admin_article_creator.php");
    }

    public function displayForModification(int $id, int $current_page = 0) { 

        if($data = $this->getData->getByFilters("articles", ["id"=>$id])[0]) {
            $nLikes = $this->getData->getNumberOfEntries("articles_like", ["article_id"=>$id]);
            $nComments = $this->getData->getNumberOfEntries("comments_article", ["article_id"=>$id]);
            $nPages = ceil($nComments / self::MAX_COMMENTS);

            if($current_page > $nPages) {

                $this->redirect("/");

            }
        
            $tables = ["comments_article", "accounts"];

            $entries = [
                "comments_article.content"=>"comment_content",
                "comments_article.date"=>"comment_date",
                "comments_article.reply"=>"comment_reply",
                "accounts.username"=>"username",
                "accounts.avatar"=>"avatar"
            ];
            $joints = [
                "comments_article.user_id"=>"accounts.id"
            ];
            $filter = [
                "article_id"=> $id
            ];

            $comments = $this->getData->getFromTables($tables,$entries,$joints, $filter, [$current_page*self::MAX_COMMENTS, self::MAX_COMMENTS]);
            
            $this->render("administration/admin_article_creator.php", compact("data", "comments", "nPages", "current_page", "nLikes"));

        } else {

            $this->redirect(self::CREATOR_DIR);
            
        }

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

        if($this->deleteData->deleteFromBdd("articles", ["id"=>$id]) && $this->deleteData->deleteFromBdd("comments_article", ["article_id"=>$id])) {
            
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