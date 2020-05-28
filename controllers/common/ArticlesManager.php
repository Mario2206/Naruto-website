<?php

namespace Controller;

use Helper\Session;

class ArticlesManager extends Controller {

    const LIMIT_ARTICLES_BY_PAGE = 8;
    const LIMIT_COMMENTS_BY_ARTICLE = 15;

    const ARTICLE_DIR = "/adventures/details/";

    const POST_ALLOWED = ["content"];



    public function display(int $current_page = 0) {

        $session = Session::getValue("user");

        $nArticles = $this->getData->getNumberOfEntries("articles");
        $nPages = ceil($nArticles / self::LIMIT_ARTICLES_BY_PAGE);

        if($current_page > $nPages) {
            $this->redirect("/");
        }

        $startSearch = $current_page * self::LIMIT_ARTICLES_BY_PAGE;
        
        $articles = $this->getData->getByFilters("articles", ["is_online"=> 1], [$startSearch, self::LIMIT_ARTICLES_BY_PAGE ]);

        $this->render("articles_management.php", compact("articles", "nPages", "current_page", "session"));
    }




    public function displayArticle(int $id_article, int $current_page = 0) {


        if($data = $this->getData->getByFilters("articles", ["id"=>$id_article, "is_online"=> 1])[0]) {

            $nComment = $this->getData->getNumberOfEntries("comments_article", ["article_id"=>$id_article]);
            $nPages = ceil($nComment/self::LIMIT_COMMENTS_BY_ARTICLE);
            $session = Session::getValue("user");

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
                "article_id"=> $id_article
            ];

            $comments = $this->getData->getFromTables($tables,$entries,$joints, $filter, [$current_page*self::LIMIT_COMMENTS_BY_ARTICLE, self::LIMIT_COMMENTS_BY_ARTICLE]);
            Session::setValue("current_page", $id_article);
            $this->render("article.php", compact("data", "comments", "nPages", "current_page", "session"));

        } else {

            $this->redirect("/");

        }

    }

    public function postComment(array $post) {

        $this->protectPageFor("user");
        $postChecked = $this->checkPostVar($post, self::POST_ALLOWED);
        $article_id = Session::cleanValue("current_page");

        if($postChecked && $article_id) {

            $current_user = Session::getValue("user");

            $content_len = iconv_strlen($postChecked["content"]);

            if( $content_len > 500 || $content_len === 0  ) {
                
                Session::setError(["Le nombre de caractères n'est pas respecté !"]);
                $this->redirect(self::ARTICLE_DIR.$article_id."-0");

            }

            $dataToPost = [
                "article_id"=>$article_id,
                "user_id"=>$current_user->id,
                "content"=>$postChecked["content"],
                "date"=>date(DATE_FORMAT)
            ];

            if($this->postData->setData("comments_article", $dataToPost)) {

                $this->redirect(self::ARTICLE_DIR.$article_id."-0");

            }else {

                throw new \Exception(BDD_ERROR);

            }


        }else {

            throw new \Exception(ERROR_VAR_POST);

        }

    }
}