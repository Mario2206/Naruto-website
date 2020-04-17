<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://projet-naruto.local/style/nav.css">
    <link rel="stylesheet" href="http://projet-naruto.local/style/footer.css">
    <link rel="stylesheet" href="http://projet-naruto.local/style/common.css">
    <?= $links?>
    <title>Home</title>
    <meta name="author" content="RAIMBAULT Mathieu">
</head>
<body>
    <div id="main_container">
        <header>
            <a href="/connection/" id="icon_connection">
                 <img src="http://projet-naruto.local/img/icon_connection.png" alt="Connection icon" title="Se connecter" >
            </a>
            <img src="http://projet-naruto.local/img/naruto_banner.png" alt="Naruto" id="img_header">
            <nav>
                <button id="button_resp">Menu</button>
                <div id="nav_child" class="ul nav_toggle_init">
                    
                    <a href="/">
                        <div>
                            <img src="http://projet-naruto.local/img/symbole.png" alt="symbol" title="Konoha" class="icon_nav">
                            <p>Qui suis-je ?</p>
                        </div>
                    </a>
                    <a href="/my-friends/">
                        <div>
                            <img src="http://projet-naruto.local/img/symbole.png" alt="symbol" title="Konoha" class="icon_nav">
                            <p>Qui sont mes compagnons ?</p>
                        </div>
                    </a>
                    <a href="/subscription/">
                        <div>
                            <img src="http://projet-naruto.local/img/symbole.png" alt="symbol" title="Konoha" class="icon_nav">
                            <p>Rejoignez-moi !</p>
                        </div>
                    </a>
                    <a href="/contact/">
                        <div>
                            <img src="http://projet-naruto.local/img/symbole.png" alt="symbol" title="Konoha" class="icon_nav">
                            <p>Contactez-moi !</p>
                        </div>
                    </a>
                </div>
            </nav>
        </header>
        <?=$content?>
        <footer>
            <div class="footer_child"> 
                <strong>JE CROIS EN TOI !</strong>
                <div class="a_footer">
                    <a href="">Apprends de nouvelles techniques</a>
                    <a href="">Révolutionne le monde !</a>
                    <a href="">Partage !</a>
                </div>
            </div>
            <div class="footer_child">
                <strong>DEVENONS HOKAGE !</strong>
                <div class="a_footer">
                    <a href="">Rejoignez-moi !</a>
                    <a href="">Mes réseaux</a>
                    <a href="">Mentions légales</a>
                </div>
            </div>
        </footer>
    </div>
    <script src="http://projet-naruto.local/js/menu.js"></script>
    <?=$scripts ?>
</body>
</html>