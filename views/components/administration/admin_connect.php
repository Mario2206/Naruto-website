<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
    <link rel="stylesheet" href="<?=$GLOBALS["PATH"]?>style/admin/connection_admin.css">
</head>
<body>
    <div id="container">
        <h1>ADMINISTRATION</h1>
        <form method="post" action="/administration/admin/connecting">
            <table>
                <tr>
                    <td><label for="admin_identifiant">Identifiant Admin</label></td>
                    <td><input type="text" name="admin_identifiant" /></td>
                </tr>
                <tr>
                    <td><label for="admin_password">Mot de passe</label></td>
                    <td><input type="password" name="admin_password"/></td>
                </tr>
            </table>
            <input type="submit" value="Connexion">
        </form>
    </div>
</body>
</html>