<?php 
    use Template\Template;
    ob_start();
?>
<div>
    ARTICLES
</div>

<?php
    $content = ob_get_clean();
    $temp = new Template($content);
    $temp->defineHtmlTemplate("tempAdmin.php");
    $temp->init();
?>