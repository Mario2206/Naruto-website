<?php
use Template\Template;

ob_start();
?>
<section id="container_connect_form">
    <div id="container_color">
        <form action="/connection/connecting" method="post" id="connect_form">
            <div id="title_container">
                <h1 class="letter_maj">Se connecter</h1>  
            </div>
            <input type="text" placeholder="Nom d'utilisateur" name="id_connection" class="txt_input" require  />   
            <input type="password" placeholder="Mot de passe" name="password" class="txt_input" require />   
            <hr />
            <strong id="errorMessage"></strong>
            <hr />
            <input type="submit" value="Se connecter" />
        </form>
    </div>
    
</section>

<?php
$content = ob_get_clean();
$css = [
    $GLOBALS["PATH"]."style/connect.css",
    $GLOBALS["PATH"]."style/alert.css"
];
$js= [
    $GLOBALS["PATH"]."js/package/Input.js",
    $GLOBALS["PATH"]."js/package/Form.js",
    $GLOBALS["PATH"]."js/connectForm.js"
];
$temp = new Template($content, $css, $js);
$temp->title = "Connection au compte utilisateur";
$temp->init();
