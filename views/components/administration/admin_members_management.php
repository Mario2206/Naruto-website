<?php
    use Template\Template;
    ob_start();
?>
<div id="container_table">
    <h1>Membres</h1>
    <br/><br/>
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Pseudo</th>
                <th>Mail</th>
                <th>village</th>
                <th>Date d'anniversaire</th>
                <th>Date Inscription</th>
                <th>Confirmé</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($data as $item):      
            ?>
            <tr>
                <td><?=$item->id; ?></td>
                <td><?=$item->firstname; ?></td>
                <td><?=$item->lastname; ?></td>
                <td><?=$item->username; ?></td>
                <td><?=$item->mail; ?></td>
                <td><?=$item->village; ?></td>
                <td><?=$item->birthdate; ?></td>
                <td><?=$item->subDate; ?></td>
                <td><?=$item->isVerif; ?></td>
                <td><a class="link green" href="/administration/admin/management/contacts/<?=$item->id;?>">Supprimer</a></td>
                <td><a class="link red" href="/administration/admin/management/contacts/<?=$item->id;?>">Promouvoir</a></td>
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
    $GLOBALS["PATH"]."/style/admin/contact_admin.css"
];
$temp = new Template($content, $css);
$temp->defineHtmlTemplate("../views/components/templates/tempAdmin.php");
$temp->init();
