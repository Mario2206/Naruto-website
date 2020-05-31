<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= PATH ?>style/common/nav.css">
    <link rel="stylesheet" href="<?= PATH ?>style/common/footer.css">
    <link rel="stylesheet" href="<?= PATH ?>style/common/common.css">
    <?= $links?>
    <title><?= $title ?></title>
    <meta name="author" content="RAIMBAULT Mathieu">
</head>
<body>
    <div id="main_container">
        <?php require("../views/components/inc/header.php"); ?>
        <?=$content?>
        <?php require("../views/components/inc/footer.php") ?>
    </div>
    <script src="<?= PATH ?>js/menu.js"></script>
    <?=$scripts ?>
</body>
</html>