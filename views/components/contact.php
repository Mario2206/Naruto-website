<?php
use Template\Template;
ob_start();
?>
    <div id="main_container_child">
            <section>
                <h1>Contacte-moi mon ami(e) !!</h1>
                <form action="/contact/contacting" method="post">
                    <div id="form_container">
                        <div>
                            <label>
                                OBJET : 
                                <input type="text" id="objectInput" required placeholder="Objet" class="initInput input" name="subject">
                            </label>
                            <label>
                                E-MAIL :
                                <?php 
                                    if(!isset($_SESSION["current_account"])){
                                ?>
                                <input type="email" required placeholder="example@mail.com" class="initInput input" name="mail"> 
                                    <?php }else{?>
                                <input type="email" required placeholder="example@mail.com" class="initInput input" name="mail" value="<?=$_SESSION["current_account"]->mail?>" disabled>    
                                    <?php }?>
                            </label>
                        </div>
                        <textarea rows="10" name="message"></textarea>
                        <div>
                            <input type="submit" value="Envoyer"/>
                        </div>
                    </div>
                </form>
            </section>
    </div>

<?php
    $content = ob_get_clean();
    $css = [
        "http://projet-naruto.local/style/contact.css",
        "http://projet-naruto.local/style/form.css",
        "http://projet-naruto.local/style/alert.css"
    ];
    $js = [
        "http://projet-naruto.local/js/package/Form.js",
        "http://projet-naruto.local/js/package/Input.js",
        "http://projet-naruto.local/js/contactForm.js"
    ];
    $temp = new Template($content, $css, $js);
    $temp->title = "Contact";
    $temp->init();
?>