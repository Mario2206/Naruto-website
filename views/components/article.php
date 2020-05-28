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

                <form action="<?=isset($session) ? "/adventures/details/post-comment" : "" ?>" method="post">

                    <div class="container_input">
                        
                        <div class="container_data_user">
            
                            <img src="<?=PATH ?><?=$session->avatar ?? "img/img_sasuke.png" ?>" alt="profil">

                            <span><?=$session->username ?? "Nom d'utilisateur" ?></span>

                        </div>

                        <textarea name="content" cols="30" rows="5" placeholder="Tapez votre commentaire ..." <?=!isset($session) ? "readonly" : "" ?> class="input_area"></textarea>

                        <input type="submit" value="Commenter" title="Valider" <?=!isset($session) ? "disabled" : "" ?>>

                    </div>

                </form>

            </section>

            <br /><br />

            <?php include (ROOT."/views/components/inc/article_comments.php"); ?>

            <div class="container_links">

                <?php
                    for($i = 0 ; $i< $nPages; $i++) : 
                ?>

                    <a href="/adventures/details/<?=$data->id."-".$i; ?>" <?=$current_page == $i ? "class='selected_link'" :"" ?>><?=$i + 1; ?></a>

                <?php
                    endfor;
                ?>

            </div> 

        </div>
        
</div>




<?php
$content = ob_get_clean();
$css = [
    "article.css",
    "comments.css",
    "form.css"
];
$js = [
    "package/Input.js",
    "package/Form.js",
    "comment_form.js"
];
$temp = new Template($content, $css, $js);
$temp->title = $data->title;
$temp->init(compact("session"));