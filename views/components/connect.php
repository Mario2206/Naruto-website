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
            <label id="checkbox_lab">
                <input type="checkbox" name="keepConnection" value="1" id="checkbox"/> <p>Conserver la connexion</p>
            </label>
            <a href="/subscription/" id="subLink">Pas de compte ? Inscrivez-vous ici !</a> 
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
    "connect.css",
    "alert.css"
];
$js= [
   "package/Input.js",
    "package/Form.js",
    "connectForm.js"
];
$temp = new Template($content, $css, $js);
$temp->title = "Connection au compte utilisateur";
$temp->init();
