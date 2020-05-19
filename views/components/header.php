        <header>
        <?php 
            if(!isset($_SESSION["current_account"])) {
        ?>
            <a href="/connection/" id="icon_connection">
                 <img src="http://projet-naruto.local/img/icon_connection.png" alt="Connection icon" title="Se connecter" >
            </a>
        <?php 
            }else{
        ?>
            <a href="/disconnection/" id="icon_connection">
                 <img src="http://projet-naruto.local/<?=$_SESSION["current_account"]->avatar ?>" alt="Connection icon" title="Se déconnecter" >
            </a>
        <?php 
            }
        ?>
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
                    <a href="/my-stories/">
                        <div>
                            <img src="http://projet-naruto.local/img/symbole.png" alt="symbol" title="Konoha" class="icon_nav">
                            <p>Mes aventures</p>
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