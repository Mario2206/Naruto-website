<?php
    use Template\Template;
    ob_start();
?>
<div>
    <h1>Créer un article</h1>
    <form action="/administration/admin/management/articles/<?=isset($data) ? "modif/{$data[0]->id}": "creation/creating" ?>" method="post" enctype="multipart/form-data">
        <div id="container_titles">
            <input type="text" value="<?=$data[0]->id ?? "" ?>" name="<?=$data[0]->id ? "id" : "" ?>" readonly hidden>
            <div class="title" id="title">
                <input type="text" name="title" placeholder="Titre de l'article" required autocomplete="off" value="<?= isset($data) ? htmlspecialchars($data[0]->title) :  ""; ?>">
            </div>
            <div class="title">
                <div>
                    <img src="<?=PATH?><?=$data[0]->miniature ?? "img/back_connect.jpg" ?>" alt="" id="miniature_ex">
                    <label class="link blue" title=".jpg ou .png">
                        Ajouter une miniature
                        <input type="file" name="miniature" accept="image/png, image/jpeg" hidden>
                    </label>
                </div>
                
            </div>
        </div>
        <div>
            <textarea id="text_editor" ></textarea>
            <input type="text" hidden name="content" value="<?=isset($data) ? htmlspecialchars($data[0]->content) : "" ?>">
            <input type="text" hidden name="synopsis" id="synopsis">
        </div>
        <div>
            <label for="is_online">
                Mettre en ligne
                <input type="checkbox" name="is_online" <?=isset($data) && $data[0]->is_online == 1 ? "checked" : "" ?>>
            </label>
            
        </div>
        <div id="container_sub">
            <input type="submit" value="<?=isset($data) ? "Modifier" : "Créer" ?>" class="link orange borderOrange">
        </div>
        
    </form>
</div>
<noscript>Le programme a besoin de javascript pour fonctionner</noscript>
<?php 
$content = ob_get_clean();
$css = [
    "admin/common_admin.css",
    "admin/trumbowyg.min.css",
    "admin/article_creator.css"
];
$js = [
    "package/Input.js",
    "text_editor_init.js",
    "ext_lib/node_modules/trumbowyg/dist/trumbowyg.min.js",
    "text_editor.js",
];
$jsLibs = [
    "//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"
];
$temp = new Template($content, $css, $js);
$temp->defineHtmlTemplate("tempAdmin.php");
$temp->addExternalScript($jsLibs);
$temp->init();