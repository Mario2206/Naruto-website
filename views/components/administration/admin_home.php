<?php

use Template\Template;

ob_start(); ?>

<div id="container">
    <h1>Panneau d'administration</h1>
</div>
<?php 
$content = ob_get_clean();
$css = [
    $GLOBALS["PATH"]."/style/administration/home_admin.css"
];
$temp = new Template($content, $css);
$temp->defineHtmlTemplate("../views/components/templates/tempAdmin.php");
$temp->init();