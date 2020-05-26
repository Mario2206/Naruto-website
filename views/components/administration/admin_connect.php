<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
    <link rel="stylesheet" href="<?=PATH?>style/admin/connection_admin.css">
    <link rel="stylesheet" href="<?=PATH?>style/admin/common_admin.css">

</head>
<body>
    <?php
        if(isset($error)) :
    ?>
        <div id="interface">
            <div id="container_alert">
                <div class="alert red borderRed">
                    <?=$error[0]; ?>
                </div>
            </div>
        </div>
        
        
    <?php endif; ?>
    <div id="container_connection">
        <div id="container_form">
            <h1>ADMINISTRATION</h1>
            <form method="post" action="/administration/admin/connecting">
                <table>
                    <tr>
                        <td><label for="admin_identifiant">Identifiant Admin</label></td>
                        <td><input type="text" name="admin_username" autocomplete="off"/></td>
                    </tr>
                    <tr>
                        <td><label for="admin_password">Mot de passe</label></td>
                        <td><input type="password" name="admin_password" autocomplete="off"/></td>
                    </tr>
                </table>
                <input type="submit" value="Connexion" id="sub_button">
            </form>
        </div>
    </div>
</body>
</html>