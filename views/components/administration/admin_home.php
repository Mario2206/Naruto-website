<?php

use Template\Template;

ob_start(); ?>


    <h1>Panneau d'administration</h1>

<?php 
$content = ob_get_clean();
$css = [
    "administration/home_admin.css"
];
$temp = new Template($content, $css);
$temp->defineHtmlTemplate("tempAdmin.php");
$temp->init();