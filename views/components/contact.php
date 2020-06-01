<?php
use Template\Template;
ob_start();
?>
    <div id="main_container_child">
            <section>
                <h1>Contacte-moi mon ami(e) !!</h1>
                <form action="<?=INTER_DIR?>/contact/contacting" method="post">
                    <div id="form_container">
                        <div>
                            <label>
                                OBJET : 
                                <input type="text" id="objectInput" required placeholder="Objet" class="initInput input" name="subject">
                            </label>
                            <label>
                                E-MAIL :
                                <?php 
                                    if(!isset($session)){
                                ?>
                                <input type="email" required placeholder="example@mail.com" class="initInput input" name="mail"> 
                                    <?php }else{?>
                                <input type="email" required placeholder="example@mail.com" class="initInput input" name="mail" value="<?=$session->mail?>" readonly>    
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
        "contact.css",
        "common/form.css",
        "common/alert.css"
    ];
    $js = [
        "package/Form.js",
        "package/Input.js",
        "contactForm.js"
    ];
    $temp = new Template($content, $css, $js);
    $temp->title = "Contact";
    $temp->init(compact("session"));
?>