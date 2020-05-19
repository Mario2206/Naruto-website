<?php
    use Template\Template;
    ob_start();
?>
<div id="container_contact">
    <h1>Contact avec <?=$data[0]->sender; ?></h1>
    <h3>Sujet : <?=$data[0]->subject; ?></h2>
    <div id="container_message">
        <p id="message"><?=$data[0]->message; ?></p>
    </div>
    <p id="date">Envoyé à <strong><?=$data[0]->sending_date; ?></strong></p>
</div>
<br/>
<hr/>
<br/>
<div>
    <form action="">
        <label id="area_mess">
            <p>RE : <?=$data[0]->subject; ?></p>
        </label>
        <textarea></textarea>
        <input type="submit" value="Répondre">
    </form>
</div>

<?php
$content = ob_get_clean();
$css =  [
    $GLOBALS["PATH"]."style/admin/contact_details_admin.css"
];
$temp = new Template($content, $css);
$temp->defineHtmlTemplate("../views/components/templates/tempAdmin.php");
$temp->init();