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
    $temp->defineHtmlTemplate("../views/components/templates/tempAdmin.php");
    $temp->init();
?>