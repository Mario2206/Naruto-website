<?php
    use Template\Template;
    ob_start();
?>
<div id="container_table">
    <h1>Contacts</h1>
    <br/><br/>
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>Expediteur</th>
                <th>Sujet</th>
                <th>Message</th>
                <th>Date d'envoi</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($data as $item) {
                    foreach($item as $k => $value) {
                        if(iconv_strlen($value) > 20) {
                            $item->$k = substr($item->$k, 0 , 10)."...";
                        }
                    }
                    
            ?>
            <tr>
                <td><?=$item->id; ?></td>
                <td><?=$item->sender; ?></td>
                <td><?=$item->subject; ?></td>
                <td><?=$item->message; ?></td>
                <td><?=$item->sending_date; ?></td>
                <td><a class="link green" href="/administration/admin/management/contacts/<?=$item->id;?>">Voir</a></td>
                <td>
                    <?=$item->already_seen == 1 ? "<img src='".$GLOBALS["PATH"]."img/icons/courriel.png' alt='Courriel'/>" : false ?>
                </td>
            </tr>
            <?php
                }
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
