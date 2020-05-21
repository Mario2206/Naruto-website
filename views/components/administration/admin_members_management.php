<?php

use Controller\Subscribe;
use Template\Template;
    ob_start();
?>
<div id="container_table">
    <h1>Membres</h1>  
    <br/><br/>
    <div id="table_users">
        <div class="title">
            <h2>Utilisateurs</h2>
        </div>
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
                    foreach($dataUsers as $item):      
                ?>
                <tr>
                    <form action="/administration/admin/management/members/modification/1" method="post">
                        <td><input type="text" value="<?=$item->id;?>" readonly name="id"/></td>
                        <td><input type="text" value="<?=$item->firstname; ?>"  readonly /></td>
                        <td><input type="text" value="<?=$item->lastname; ?>"readonly /></td>
                        <td><input type="text" value="<?=$item->username; ?>" name="username" class="inputAllowed"/></td>
                        <td><input type="text" value="<?=$item->mail;?>" name="mail" class="inputAllowed" /></td>
                        <td>
                            <select name="village">
                                <option value="<?=$item->village; ?>"><?=$item->village; ?></option>
                                <?php
                                    foreach($villages_allowed as $village):
                                        if($village !== $item->village ):
                                            echo "<option value='".$village."'>".$village."</option>";
                                        endif;
                                    endforeach;
                                ?>
                            </select>
                        </td>
                        <td><input type="text" value="<?=$item->birthdate; ?>" readonly/></td>
                        <td><input type="text" value="<?=$item->subDate;?>" name="sub_date" readonly></td>
                        <td><img src='<?=PATH."img/icons/"?><?=$item->isVerif == 1 ? "icon_ok.png" : "cross_icon.png"; ?>' alt="icon"></td>
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
    <div id="table_admin">
        <div class="title">
            <h2>Administrateurs</h2>
            <button class="blue link initPop">Ajouter un administrateur</button>
        </div>
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Pseudo</th>
                    <th>Mail</th>
                    <th>En fonction</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($dataAdmins as $item):      
                ?>
                <tr>
                    <form action="/administration/admin/management/members/modification/1" method="post">
                        <td><input type="text" value="<?=$item->id;?>" readonly name="id"/></td>
                        <td><input type="text" value="<?=$item->firstname; ?>"  readonly /></td>
                        <td><input type="text" value="<?=$item->lastname; ?>"readonly /></td>
                        <td><input type="text" value="<?=$item->admin_username; ?>" name="username" class="inputAllowed"/></td>
                        <td><input type="text" value="<?=$item->mail;?>" name="mail" class="inputAllowed" /></td>
                        <?php if($item->admin_password === ""):?>
                            <td><img src='<?=PATH."img/icons/cross_icon.png"; ?>' alt="icon"></td>
                        <?php elseif($item->is_activated == 0) :?>
                            <td><a href="/administration/admin/management/members/confirm/admin/finally/<?=$item->id."-".$item->vkey; ?>" class="link green">A valider</a></td>
                        <?php else:?>
                            <td><img src='<?=PATH."img/icons/icon_ok.png"; ?>' alt="icon"></td>
                        <?php endif;?>
                        <td><a class="link red" href="/administration/admin/management/members/delete/admin/<?=$item->id;?>">Supprimer</a></td>
                        <td><input type="submit" class="link green" href="/administration/admin/management/members/modification/<?=$item->id;?>" value='Modifier'/></td>
                    </form>
                </tr>
                <?php
                    endforeach;
                ?>
            </tbody>
        </table>
    </div>
    <div class="container_create_admin_hidden">
        <div class="back_popup">
            <form action="/administration/admin/management/members/creation/admin/" method="post" id="create_admin">
                <h2>Précisez le mail de votre nouvel administrateur</h2>
                <label id="infos">
                    Il recevra un mail afin de compléter certaines informations.
                    <br/>
                    <strong> Pour activer son compte, l'administrateur principal devra finaliser son inscription.</strong>
                </label>
                <div id="input_admin_mail">
                    <input type="mail" value="mail" name="mail" />
                </div>
                <input type="submit" value="Envoyer la demande">
            </form>
        </div>
    </div>
    
</div>

<?php

$content = ob_get_clean();
$css = [
    "admin/table_style_admin.css",
    "admin/members_management.css"
];
$js = [
    "package/PopUpLinker.js",
    "admin_members_management.js"
];
$temp = new Template($content, $css, $js);
$temp->defineHtmlTemplate("tempAdmin.php");
$temp->init();
