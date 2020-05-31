<?php 
use Template\Template;

ob_start();

?>

<div class="container_titles">

    <h1>Création du personnage</h1>

</div>

<br /><br />

<div class="container_form">

    <form action="<?= isset($data) ? "/administration/admin/management/characters/changing/".$data->id :  "/administration/admin/management/characters/creating" ?>" method="post" enctype="multipart/form-data">

        <div class="container_input_header">

            <input type="text" name="name" id="name" placeholder="Nom du personnage" value="<?=$data->name ?? "" ?>">

            <label for="image" class="link brown">Choisir le portait</label>

            <input type="file" name="image" id="image" hidden >

        </div>

        <div class="container_childs">

            <div class="container_profil">
                
                <label for="image">

                    <img src="<?=PATH?><?=$data->image ?? "img/img_unknown.jpeg" ?>" alt="Avatar" id="img_profil">

                </label>
                

            </div>

            <div class="container_area">

                <textarea name="description" id="desc" cols="30" rows="10" placeholder="Description du personnage"><?=$data->description ?? "" ?></textarea>

            </div>

            <div>

                <label for="is_online">Mettre en ligne</label>

                <input type="checkbox" name="is_online" id="is_online" <?=isset($data) && $data->is_online ? "checked" : "" ?>>

            </div>

            <div>

                <input type="submit" value="Valider" class="link brown">

            </div>

        </div>

    </form>

</div>

<?php

$content = ob_get_clean();
$css = [
    "admin/character_creator.css",
    "common/form.css",
    "common/alert.css"
];
$js = [
    "package/Form.js",
    "package/Input.js",
    "character_form.js"
];
$temp = new Template($content, $css, $js);
$temp->defineHtmlTemplate("tempAdmin.php");
$temp->init();