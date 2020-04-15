<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Erreur sur les informations données !!</h1>
    <ul>
        <?php 
            foreach($errors as $error) {
                echo "<li>".$error."</li>";
            }
        ?>
    </ul>
</body>
</html>