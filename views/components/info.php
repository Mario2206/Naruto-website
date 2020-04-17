<?php 
    use Template\Template;

    ob_start();
?>
<section>
    <div id="info_container">
        <p>
            <?=$message?>
        </p>
    </div>
</section>

<?php 

$content = ob_get_clean();
$css = [
    $GLOBALS["PATH"]."style/info.css"
];
$temp = new Template($content, $css);
$temp->init();
?>