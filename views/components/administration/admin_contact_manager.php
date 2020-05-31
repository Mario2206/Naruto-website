<?php
    use Template\Template;
    ob_start();
?>
<h1>Contacts</h1>
<br/><br/>
<div id="container_table">
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>Expediteur</th>
                <th>Sujet</th>
                <th>Message</th>
                <th>Date d'envoi</th>
                <th></th>
                <th></th>
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
                <td><?=htmlspecialchars($item->sender); ?></td>
                <td><?=htmlspecialchars($item->subject); ?></td>
                <td><?=htmlspecialchars($item->message); ?></td>
                <td><?=htmlspecialchars($item->sending_date); ?></td>
                <td><a class="link green" href="/administration/admin/management/contacts/<?=$item->id;?>">Voir</a></td>
                <td>
                    <?=$item->already_seen == 1 ? "<img src='".PATH."img/icons/courriel.png' alt='Courriel'/>" : false ?>
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
        "admin/table_style_admin.css"
    ];
    $temp = new Template($content, $css);
    $temp->defineHtmlTemplate("tempAdmin.php");
    $temp->init();
