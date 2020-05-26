<?php 
use Template\Template;

ob_start();
?>

<div class="container_background">
        
        <div class="container_color">
            <section class="container_article">

                <div class="title_container">

                    <h1><?=$data->title ?></h1>

                </div>

                <div class="container_miniature">

                    <img src="<?= PATH.$data->miniature ?>" alt="">

                </div>

                <div class="content">

                    <?=$data->content ?>

                </div>

                <div class="container_annex">

                    <div class="container_date">

                        <p><?=$data->online_date ?></span>

                    </div>

                    <div class="container_like">

                        <a href="#">

                            <img src="https://img.icons8.com/pastel-glyph/64/000000/facebook-like.png"/>

                            <p><?=$data->like_number; ?></p>

                        </a>

                    </div>

                </div>

            </section>

            <section class="container_commentaire_editor">

                <form action="#" method="post">

                    <div class="container_input">
                        
                        <div class="container_data_user">

                            <img src="<?=PATH;?>/img/img_sasuke.png" alt="profil">

                            <span>Username</span>

                        </div>

                        <textarea name="comment" cols="30" rows="5" placeholder="Tapez votre commentaire ..."></textarea>

                        <input type="submit" value="Commenter">

                    </div>

                </form>

            </section>

            <br /><br />

            <section class="container_comments">

                <?php foreach($comments as $c): ?>

                    <div>
                        <p><?=$c->content; ?></p>
                    </div>

                <?php endforeach; ?>

            </section>

        </div>
        
</div>




<?php
$content = ob_get_clean();
$css = [
    "article.css",
    "comments.css"
];
$temp = new Template($content, $css);
$temp->init();