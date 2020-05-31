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
    "info.css"
];
$temp = new Template($content, $css);
$temp->title = "Information";
$temp->init();
?>