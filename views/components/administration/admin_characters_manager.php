<?php

use Template\{
    Template,
};

ob_start();
?>

<div id="container_title">

    <h1>Personnages</h1>

    <a href="/administration/admin/management/characters/create" class="create_button link blue">Créer un personnage</a>

</div>

<br /><br />

<div id="container_table">

        <table>

            <thead>

                <tr>

                    <th>id</th>

                    <th>Nom</th>

                    <th>image</th>

                    <th>Date de création</th>

                    <th>Date de mise en ligne</th>

                    <th>Etat</th>

                    <th></th>

                    <th></th>

                </tr>

            </thead>

            <tbody>

                <?php
                    foreach($data as $item):      
                ?>

                <tr>

                        <td><?=$item->id;?></td>

                        <td><?=htmlspecialchars($item->name)?></td>

                        <td><img src="<?= PATH.$item->image ?>" alt="miniature"></td>

                        <td><?=$item->creation_date; ?></td>

                        <td><?=$item->online_date;?></td>

                        <td><input type="checkbox" <?=$item->is_online ? "checked" : false; ?> id='<?=$item->id ?>'></td>

                        <td><a class="link green" href="/administration/admin/management/characters/modif/<?=$item->id; ?>" >Modifier</a></td>

                        <td><a href="/administration/admin/management/characters/delete/<?=$item->id; ?>" class="link red">Supprimer</a></td>

                </tr>

                <?php
                    endforeach;
                ?>

            </tbody>
            
        </table>

</div>

<?php 
$content = ob_get_clean();
$css = [
    "admin/table_style_admin.css",
    "admin/articles_management.css"
];
$js = [
    "package/Ajax.js",
    "package/CheckboxSender.js",
    "admin_characters_ajax_conf.js"
];
$temp = new Template($content, $css, $js);
$temp->defineHtmlTemplate("tempAdmin.php");
$temp->init();
