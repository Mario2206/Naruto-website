<?php

namespace Controller;

class ArticlesManager extends Controller {

    const LIMIT_ARTICLES_BY_PAGE = 8;

    public function display(int $current_page = 0) {

        $nArticles = $this->getData->getNumberOfEntries("articles");
        $nPages = ceil($nArticles / self::LIMIT_ARTICLES_BY_PAGE);

        if($current_page > $nPages) {
            $this->redirect("/");
        }

        $startSearch = $current_page * self::LIMIT_ARTICLES_BY_PAGE;
        
        $articles = $this->getData->getByFilters("articles", ["is_online"=> 1], [$startSearch, self::LIMIT_ARTICLES_BY_PAGE ]);

        $this->render("articles_management.php", compact("articles", "nPages", "current_page"));
    }

    public function displayArticle(int $id_article) {

        if($data = $this->getData->getByFilters("articles", ["id"=>$id_article, "is_online"=> 1])[0]) {
            $comments = $this->getData->getByFilters("comments_article", ["article_id"=>$data->id]);
            $this->render("article.php", compact("data", "comments"));

        } else {

            $this->redirect("/");

        }

    }
}