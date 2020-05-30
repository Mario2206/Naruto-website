<?php
    use Template\Template;

    $nCharact = count($data);

    ob_start();
?>
<div id="sections_container">

            <section>

                <h1>Mes Compagnons !</h1>

                <div id="screen">

                    <div id="container_slides">

                        <?php foreach($data as $k=>$item) :  ?>

                            <div class="slide">

                                <span class="page_slide"><?=($k+1)."/".$nCharact ?></span>

                                <strong><?=$item->name; ?></strong>

                                <div class="img_container">

                                    <img src="<?=PATH ?><?=$item->image; ?>" alt="image <?=$item->name; ?>" title="<?=$item->name; ?>">

                                </div>

                                <p>

                                    <span class="letter_maj"><?=$item->description[0]; ?></span><?=nl2br(htmlspecialchars(substr($item->description, 1))); ?>

                                </p>

                            </div>

                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

    </div>

    <div id="container_UI">

        <div id="container_helper">
            
            <div id="txt_helper">
                
                <p>Maintiens le clique sur le slider et glisses la souris vers la droite ou vers la gauche pour faire défiler les informations</p>
            
            </div>
            
            <div id="helper"></div>

            <img src="<?= PATH?>img/icon_helper.png" alt="helper" id="img_Helper">

        </div>

    </div>

<?php
    $content = ob_get_clean();
    $css = ["friends.css"];
    $js=[
        "package/HandlerTouches.js", 
        "package/Slider.js",
        "slideShow.js", 
        "helperButton.js", 
    ];
    $temp = new Template($content, $css, $js);
    $temp->title = "Mes compagnons de route";
    $temp->init(compact("session"));
?>