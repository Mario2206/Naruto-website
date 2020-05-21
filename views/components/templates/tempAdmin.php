<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?=PATH?>style/admin/common_admin.css" />
    <link rel="stylesheet" href="<?=PATH?>style/common.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
    <?= $links ?>
</head>
<body>
    <div id="main">
        <header>
           <nav>
                <a href="/administration/admin/management/articles/">Articles</a>
                <a href="/administration/admin/management/members/">Membres</a>
                <a href="/administration/admin/management/contacts/">Contacts</a>
            </nav> 
        </header>
        <div id="container">
            <?=$content; ?>
        </div>
    </div>
    <?=$scripts ?>
</body>
</html>