<?php 
    use Template\Template;
    ob_start();
?>
<div>

    <div id="container_title">  
            <h1>Articles</h1>  
            <a href="/administration/admin/management/articles/creation" class="blue link">Ajouter un article</a>
    </div>   
    <br/><br/>
    <div id="container_table">
        
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>Titre</th>
                    <th>Miniature</th>
                    <th>Créé le </th>
                    <th title="Date de mise en ligne">En ligne</th>
                    <th>Etat</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($articles as $item):      
                ?>
                <tr>
                    <form action="/administration/admin/management/members/modification/1" method="post">
                        <td><?=$item->id;?></td>
                        <td>"<?=htmlspecialchars($item->title)?></td>
                        <td><img src="<?= PATH.$item->miniature ?>" alt="miniature"></td>
                        <td><?=$item->creation_date; ?></td>
                        <td><?=$item->online_date;?></td>
                        <td><input type="checkbox" <?=$item->is_online ? "checked" : false; ?>></td>
                        <td><a class="link green" href="/administration/admin/management/articles/modif/<?=$item->id."-0"; ?>">Modifier</a></td>
                        <td><a href="/administration/admin/management/articles/delete/<?=$item->id?>" class="link red">Supprimer</a></td>
                    </form>
                </tr>
                <?php
                    endforeach;
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
    $content = ob_get_clean();
    $css = [
        "admin/table_style_admin.css",
        "admin/articles_management.css"
    ];
    $temp = new Template($content, $css);
    $temp->defineHtmlTemplate("tempAdmin.php");
    $temp->init();
?>