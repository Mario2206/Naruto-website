<?php
    use Template\Template;
    ob_start();
?>
<div class="container_contact">

    <h1>Contact avec <span class="underline"><?=htmlspecialchars($data[0]->sender); ?></span></h1>

    <h3>Sujet : <?=htmlspecialchars($data[0]->subject); ?></h3>

    <div class="container_message">

        <p class="message"><?=nl2br(htmlspecialchars($data[0]->message)); ?></p>

    </div>

    <p class="date">Envoyé à <strong><?=$data[0]->sending_date; ?></strong></p>

</div>

<div>

<?php if(!isset($data[0]->contact_reply)) :?>

    <?=$errors ? "<div class=\"alert red borderRed\"><strong>".$errors."</div>" : false ?>

    <form action="/administration/admin/management/contacts/reply/<?=$data[0]->id;?>" method="post">

        <div id="area_mess">

            <p id="title_response">RE : <?=$data[0]->subject; ?></p>

        </div>

        <textarea name="message"></textarea>

        <input type="submit" value="Répondre">

    </form>

    <?php  
        else :
    ?>

    <div class="alert green borderGreen">La demande de contact a déjà été traité !</div>

    <div class="container_contact reply">

        <h1>Contact avec <span class="underline"><?=$data[0]->contact_reply->recipient; ?></span></h1>

        <h2>Envoyé par <span class="underline"><?=$data[0]->contact_reply->sender; ?></span></h2>

        <h3><?=$data[0]->contact_reply->subject; ?></h3>

        <div class="container_message">

            <p class="message"><?=nl2br(htmlspecialchars($data[0]->contact_reply->message)); ?></p>

        </div>

        <p class="date">Envoyé à <strong><?=$data[0]->contact_reply->sending_date; ?></strong></p>

    </div>

    <?php endif; ?>

</div>

<?php

$content = ob_get_clean();
$css =  [
    "admin/contact_details_admin.css"
];
$temp = new Template($content, $css);
$temp->defineHtmlTemplate("tempAdmin.php");
$temp->init();