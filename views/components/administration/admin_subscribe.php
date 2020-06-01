<?php 
    use Template\Template;
    ob_start();
?>
<div id="container_form" class="center">
    <?php if(!$sub):?>
        <?php
            if($errors) :
        ?>
        <div class="alert red borderRed">
            <ul>
                <?php foreach($errors as $error): ?>
                <li><?=$error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>
        <form action="<?=INTER_DIR?>/administration/admin/management/members/confirm/admin/checking/<?=$id."-".$vkey ?>" method="post">
            <div id="title" class="center">
                <h1>Inscription administration</h1>
            </div>
            <div id="container_input" >
                <div class="center">
                    <label>Nom</label>
                    <input type="text" name="lastname" >
                </div>
                <div class="center">
                    <label>Prénom</label>
                    <input type="text" name="firstname">
                </div>
                <div class="center">
                    <label>Pseudo d'administrateur</label>
                    <input type="text" name="admin_username">
                </div>
                <div class="center">
                    <label>Mot de passe</label>
                    <input type="text" name="admin_password">
                </div>
                <div class="center">
                    <label>Confirmer mot de passe</label>
                    <input type="text" name="confirmPassword">
                </div>
            </div>
            <div id="container_sub" class="center">
                <input type="submit" value="Confirmer">
            </div> 
        </form>
    <?php else : ?>
        <div class="alert green borderGreen">
            L'administrateur a reçu votre confirmation d'inscription. Il vous suffit à présent d'attendre sa validation pour accéder 
            à l'espace administrateur.
        </div>
    <?php endif;?>
</div>

<?php 
$content = ob_get_clean();
$css = ["admin/sub_admin.css"];
$temp = new Template($content, $css);
$temp->defineHtmlTemplate("tempAdmin.php");
$temp->init();