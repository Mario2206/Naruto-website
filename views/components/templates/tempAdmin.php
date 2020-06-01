<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="<?= PATH ?>img/icons/favicon.png" /><link/>
    <link rel="stylesheet" href="<?=PATH?>style/admin/common_admin.css" />
    <link rel="stylesheet" href="<?=PATH?>style/common/common.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
    <?= $links ?>
</head>
<body>
    <div id="main">
        <header>
           <nav>
               <div id="burger_button">
                   <button id="button_resp"><img src="<?=PATH?>/img/icons/burger_icon.png" alt=""></button>
               </div>
               <div id="container_links_nav" class="nav_toggle_init ul">
                   <a href="<?=INTER_DIR?>/administration/admin/management/articles/">Articles</a>
                   <a href="<?=INTER_DIR?>/administration/admin/management/characters/">Compagnons</a>
                   <a href="<?=INTER_DIR?>/administration/admin/management/members/">Membres</a>
                   <a href="<?=INTER_DIR?>/administration/admin/management/contacts/">Contacts</a>
               </div>
               <div>
                   <a href="<?=INTER_DIR?>/administration/admin/disconnect">Se déconnecter</a>
               </div>
                
            </nav> 
        </header>
        <div id="container">
            <?=$content; ?>
        </div>
    </div>
    <script src="<?=PATH?>js/menu.js"></script>
    <?= $jsLibs;?>
    <?=$scripts; ?>
</body>
</html>