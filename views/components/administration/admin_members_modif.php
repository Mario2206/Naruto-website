<?php
    use Template\Template;
    ob_start();
?>
<div>
    <form action="" method="post">
        <div>
           <label>Nom de famille</label> 
           <input type="text" readonly value="<?=$data[0]->firstname; ?>" name="none">
        </div>
        <div>
           <label>Prénom</label> 
           <input type="text" readonly value="<?=$data[0]->lastname; ?>" name="none">
        </div><div>
           <label>Pseudo</label> 
           <input type="text" readonly value="<?=$data[0]->username; ?>" name="none">
        </div><div>
           <label>Mail</label> 
           <input type="text" readonly value="<?=$data[0]->mail; ?>" name="none">
        </div><div>
           <label>Village</label> 
           <input type="text" readonly value="<?=$data[0]->village; ?>" name="none">
        </div><div>
           <label>Date d'anniversaire</label> 
           <input type="text" readonly value="<?=$data[0]->birthdate; ?>" name="none">
        </div><div>
           <label>Date d'inscription</label> 
           <input type="text" readonly value="<?=$data[0]->subDate; ?>" name="none">
        </div>
        <div>
           <label>Confirmation</label> 
           <input type="text" readonly value="<?=$data[0]->isVerif; ?>" name="none">
        </div>
    </form>
</div>

<?php
$content = ob_get_clean();
$temp = new Template($content);
$temp->defineHtmlTemplate("../views/components/templates/tempAdmin.php");
$temp->init();
?>