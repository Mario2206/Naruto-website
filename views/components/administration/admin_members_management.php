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
                <form action="/administration/admin/management/members/modification/1" method="post">
                    <td><input type="text" value="<?=$item->id;?>" readonly name="id"/></td>
                    <td><input type="text" value="<?=$item->firstname; ?>"readonly /></td>
                    <td><input type="text" value="<?=$item->lastname; ?>"readonly /></td>
                    <td><input type="text" value="<?=$item->username; ?>" name="username" class="inputAllowed"/></td>
                    <td><input type="text" value="<?=$item->mail;?>" name="mail" class="inputAllowed" /></td>
                    <td><input type="text" value="<?=$item->village; ?>" name="village" class="inputAllowed"/></td>
                    <td><input type="text" value="<?=$item->birthdate; ?>" readonly/></td>
                    <td><input type="text" value="<?=$item->subDate;?>" readonly></td>
                    <td><img src='<?=$GLOBALS["PATH"]."img/icons/"?><?=$item->isVerif == 1 ? "icon_ok.png" : "cross_icon.png"; ?>' alt="icon"></td>
                    <td><a class="link red" href="/administration/admin/management/members/delete/<?=$item->id;?>">Supprimer</a></td>
                    <td><input type="submit" class="link green" href="/administration/admin/management/members/modification/<?=$item->id;?>" value='Modifier'/></td>
                </form>
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
    $GLOBALS["PATH"]."/style/admin/table_style_admin.css"
];
$temp = new Template($content, $css);
$temp->defineHtmlTemplate("../views/components/templates/tempAdmin.php");
$temp->init();
