<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
               <div>
                   <a href="/administration/admin/management/articles/">Articles</a>
                   <a href="/administration/admin/management/characters/">Compagnons</a>
                   <a href="/administration/admin/management/members/">Membres</a>
                   <a href="/administration/admin/management/contacts/">Contacts</a>
               </div>
               <div>
                   <a href="/administration/admin/disconnect">Se déconnecter</a>
               </div>
                
            </nav> 
        </header>
        <div id="container">
            <?=$content; ?>
        </div>
    </div>
    <?= $jsLibs;?>
    <?=$scripts; ?>
</body>
</html>