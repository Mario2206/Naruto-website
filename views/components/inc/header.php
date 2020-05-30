        <header>
        <?php 
            if(!isset($session)) {
        ?>
            <a href="/connection/" id="icon_connection">
                 <img src="<?=PATH ?>img/icon_connection.png" alt="Connection icon" title="Se connecter" >
            </a>
        <?php 
            }else{
        ?>
            <a href="/disconnection/" id="icon_connection" class="connected_icon">
                 <img src="<?=PATH.$session->avatar ?>" alt="Connection icon" title="Se déconnecter" >
            </a>
        <?php 
            }
        ?>
            <img src="<?=PATH ?>img/naruto_banner.png" alt="Naruto" id="img_header">
            <nav>
                <button id="button_resp">Menu</button>
                <div id="nav_child" class="ul nav_toggle_init">
                    
                    <a href="/">
                        <div>
                            <img src="<?=PATH ?>img/konoha.png" alt="symbol" title="Konoha" class="icon_nav">
                            <p>Qui suis-je ?</p>
                        </div>
                    </a>
                    <a href="/my-friends/">
                        <div>
                            <img src="<?=PATH ?>img/konoha.png" alt="symbol" title="Konoha" class="icon_nav">
                            <p>Qui sont mes compagnons ?</p>
                        </div>
                    </a>
                    <a href="/adventures/0">
                        <div>
                            <img src="<?=PATH ?>img/konoha.png" alt="symbol" title="Konoha" class="icon_nav">
                            <p>Mes aventures</p>
                        </div>
                    </a>
                    <a href="/contact/">
                        <div>
                            <img src="<?=PATH ?>img/konoha.png" alt="symbol" title="Konoha" class="icon_nav">
                            <p>Contactez-moi !</p>
                        </div>
                    </a>
                </div>
            </nav>
        </header>