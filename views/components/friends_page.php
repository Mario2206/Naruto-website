<?php
    use Template\Template;

    ob_start();
?>
<div id="sections_container">
            <section>
                <h1>Mes Compagnons !</h1>
                <div id="screen">
                    <div id="container_slides">
                        <div class="slide">
                            <span class="page_slide">1/3</span>
                            <strong>Sasuke</strong>
                            <div class="img_container">
                                <img src="<?=PATH ?>img/img_sasuke.png" alt="image Sasuke" title="Sasuke">
                            </div>
                            <p>
                                <span class="letter_maj">S</span>asuke Uchiwa est un ninja de renom. Très jeune, il développe des capacité exceptionnelles 
                                et il est doté d'une détermination sans faille. Une explication existe : Sasuke a perdu toute sa famille qui a été 
                                sauvagement assassiné par son frère : Itashi Uchiwa. Cet évènement le changera à jamais et le traumatisme ne faiblira 
                                jamais.
                                <br/><br/>
                                C'est à l'académie qu'il me rencontre. Au début, on ne s'aime pas vraiment, je dois bien avoué que j'étais un tout petit
                                peu jaloux de lui, mais vraiment un tout petit peu. Par contre, je ne supportais pas la façon dont Sakura le regardait,
                                pourquoi elle ne me regardait pas comme ça ???
                                <br/><br/>
                                Bon, heureusement, on a finis par s'entendre et on est devenu de très bons amis. Il le valait mieux
                                car on fait parti de la même équipe aujourd'hui ! On doit se protéger et s'entraider constamment donc forcemment ça renforce les liens !
                                J'espère que notre amitié ne cessera jamais de briller !!
                            </p>
                        </div>
                        <div class="slide">
                            <span class="page_slide">2/3</span>
                            <strong>Sasuke</strong>
                            <div class="img_container">
                                <img src="<?=PATH ?>img/img_sasuke.png" alt="image Sasuke" title="Sasuke">
                            </div>
                            <p>
                                <span class="letter_maj">P</span>haec Gallus Hierapolim profecturus ut expeditioni specie tenus adesset, Antiochensi plebi supplicit
                                er obsecranti ut inediae dispelleret metum, quae per multas difficilisque causas adfore iam sperabatur, 
                                 ut mos est principibus, quorum diffusa potestas localibus subinde medetur aerumnis, disponi quicquam statuit vel ex provinciis alimenta transferri conterminis, sed consularem Syriae Theophilum prope adstantem ultima metuenti multitudini dedit id adsidue replicando quod invito rectore nullus egere poterit victu.
                                <br/><br/>
                                Isdem diebus Apollinaris Domitiani gener, paulo ante agens palatii Caesaris curam, ad Mesopotamiam missu
                                 socero per militares numeros immodice scrutabatur, an quaedam altiora meditantis iam Galli secreta suscep
                                 erint scripta, qui conpertis Antiochiae gestis per minorem Armeniam lapsus Constantinopolim petit exindeque per protectores retractus artissime tenebatur.
                                <br/><br/>
                                Et Epigonus quidem amictu tenus philosophus, ut apparuit, prece frustra temptata, sulcatis lateribus mort
                                isque metu admoto turpi confessione cogitatorum socium, quae nulla erant, fuisse firmavit cum nec vidisset 
                                quicquam nec audisset penitus expers forensium rerum; Eusebius vero obiecta fidentius negans, suspensus in e
                                radu constantiae stetit latrocinium illud esse, non iudicium clamans.
                            </p>
                        </div>
                        <div class="slide">
                            <span class="page_slide">3/3</span>
                            <strong>Sasuke</strong>
                            <div class="img_container">
                                <img src="<?=PATH ?>img/img_sasuke.png" alt="image Sasuke" title="Sasuke">
                            </div>
                            <p>
                                <span class="letter_maj">P</span>haec Gallus Hierapolim profecturus ut expeditioni specie tenus adesset, Antiochensi plebi supplicit
                                er obsecranti ut inediae dispelleret metum, quae per multas difficilisque causas adfore iam sperabatur, 
                                 ut mos est principibus, quorum diffusa potestas localibus subinde medetur aerumnis, disponi quicquam statuit vel ex provinciis alimenta transferri conterminis, sed consularem Syriae Theophilum prope adstantem ultima metuenti multitudini dedit id adsidue replicando quod invito rectore nullus egere poterit victu.
                                <br/><br/>
                                Isdem diebus Apollinaris Domitiani gener, paulo ante agens palatii Caesaris curam, ad Mesopotamiam missu
                                 socero per militares numeros immodice scrutabatur, an quaedam altiora meditantis iam Galli secreta suscep
                                 erint scripta, qui conpertis Antiochiae gestis per minorem Armeniam lapsus Constantinopolim petit exindeque per protectores retractus artissime tenebatur.
                                <br/><br/>
                                Et Epigonus quidem amictu tenus philosophus, ut apparuit, prece frustra temptata, sulcatis lateribus mort
                                isque metu admoto turpi confessione cogitatorum socium, quae nulla erant, fuisse firmavit cum nec vidisset 
                                quicquam nec audisset penitus expers forensium rerum; Eusebius vero obiecta fidentius negans, suspensus in e
                                radu constantiae stetit latrocinium illud esse, non iudicium clamans.
                                
                                
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div id="container_UI">
        <div id="container_helper">
            <div id="txt_helper"><p>Maintiens le clique sur le slider et glisses la souris vers la droite ou vers la gauche pour faire défiler les informations</p></div>
            <div id="helper"></div>
            <img src="<?= PATH?>img/icon_helper.png" alt="helper" id="img_Helper">
        </div>
    </div>

<?php
    $content = ob_get_clean();
    $css = ["friends.css"];
    $js=[
        "package/HandlerTouches.js", 
        "slideShow.js", 
        "helperButton.js", 
        "menu.js"
    ];
    $temp = new Template($content, $css, $js);
    $temp->title = "Mes compagnons de route";
    $temp->init();
?>