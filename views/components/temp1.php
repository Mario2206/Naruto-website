<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://projet-naruto.local/style/nav.css">
    <link rel="stylesheet" href="http://projet-naruto.local/style/footer.css">
    <link rel="stylesheet" href="http://projet-naruto.local/style/common.css">
    <?= $links?>
    <title><?= $title ?></title>
    <meta name="author" content="RAIMBAULT Mathieu">
</head>
<body>
    <div id="main_container">
        <?php require("../views/components/header.php"); ?>
        <?=$content?>
        <?php require("../views/components/footer.php") ?>
    </div>
    <script src="http://projet-naruto.local/js/menu.js"></script>
    <?=$scripts ?>
</body>
</html>