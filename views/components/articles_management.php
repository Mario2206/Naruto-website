<?php 
use Template\Template;

ob_start();
?>
<section class="main_container">

    <div class="container">

        <h1 class="main_title">Mes aventures</h1>

        <div class="container_articles">

            <?php foreach($articles as $a): ?>

                <a href="/adventures/details/<?=$a->id; ?>" class="article_temp">

                    <span class="part1"><img src="<?=PATH.$a->miniature ?>" alt="miniature" class="miniature"></span>

                    <span class="part2">

                        <p class="title_article"><?=$a->title; ?></p>

                        <p class="synopsis"><?= $a->synopsis ?? "Ceci est le synopsis que je dois réaliser en backoffice" ?></p>

                    </span>

                    <span class="part3">

                        <div class="part3_child">

                            <div class="like_container">

                                <img src="<?=PATH;?>img/icons/icon_like.png" alt="like">

                                <p><?=$a->like_number; ?></p>

                            </div>                            

                        </div>
                        

                    </span>

                </a>

            <?php endforeach; ?>

        </div>
        <div class="container_links">
            <?php
                for($i = 0 ; $i< $nPages; $i++) : 
            ?>
            <a href="/adventures/<?=$i; ?>" <?=$current_page == $i ? "class='selected_link'" :"" ?>><?=$i + 1; ?></a>
            <?php
                endfor;
            ?>
        </div> 
    </div>             
</section>


<?php

$content = ob_get_clean();
$css = [
    "article_manager.css"
];
$temp = new Template($content, $css);
$temp->init();