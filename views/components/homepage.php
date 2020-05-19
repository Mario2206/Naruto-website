<?php
    use Template\Template;

    ob_start();
?>
       <section id="main_pres">
            <div id="container_main_pres">
                <div id="parchment_pres">
                    <h1>Mon nom est Naruto Usumaki !</h1>
                    <p>
                        <span class="letter_maj">B</span>onjour à tous ! Je me présente, je me nomme Naruto Uzumaki et je suis un ninja de 
                        Konoha ! Depuis tout jeune, je m'entraîne pour devenir le meilleur et bien evidemment pour devenir Hokage !!
                        Je sais qu'un jour le monde aura besoin de moi, meme si pas mal de monde en doute, mais a ce moment
                        la je repondrai présent !
                        <br/><br/>
                        Je suis content de t'avoir ici, j'espère que tu te plairas et que nous pourrons progresser ensemble. Je suis bien conscient qu'etre
                        le Hokage d'un village de minables n'est pas interessant, je compte donc sur toi pour être le meilleur !!! Quelque soit le village
                        tout ninja se doit d'être le plus fort possible et de toujours se depasser pendant les entraînements !!
                        <br/><br/>
                        Tu ne seras jamais seul de toute façon car tout au long de ton aventure, tu pourras compter sur l'aide precieuse de tes 
                        compagnons, de ton maître et de moi-meme hehe !!
                    </p>
                    <p id="signature">NARUTO</p>
                </div>
                <div id="main_pres_childImg">
                    <img src="http://projet-naruto.local/img/symbole.png" alt="symbol" title="Konoha" class="img_symbol">
                </div>
            </div>
        </section>
        <section>
            <div class="secondary_desc">
                <h2>Une petite retrospective </h2>
                <div class="text_desc">
                    <p>
                        Tout commença alors que je n'étais qu'un enfant, un petit bébé pour être plus précis. Ma naissance fut 
                        une véritable catastrophe... A l'époque, mes parents s'étaient isolés loin de leurs responsabilités afin
                        que ma venue se fasse au mieux pour ma très chère mère ainsi que pour moi-même. 
                        <br/><br/>
                        Néanmoins, à l'heure de ma venue au monde, un individu malfaisant s'en prenna à mes parents, en se servant de leur nouveau né comme
                        moyen de pression. Avec une détermination à toute épreuve, mon père s'empressa de me sauver mais ma mère n'eut pas 
                        autant de chance... L'individu masqué ne souhaitait pas vraiment ma mort, ni la mort de mes parents d'ailleurs, il 
                        souhaitait juste réveiller le démon qui someillait dans le corps de ma mère : le terrible démon renard à 9 queues !!
                        <br/><br/>
                        Au plus grand malheur de tous, il réussit ce qu'il entreprit et la bête se réveilla... Dévastatrice, sans pitié, elle ravagea
                        tout sur son passage... Ce fut grâce au sacrifice de mes parents que le démon fut vaincu et emprisonné dans mon corps
                        de nourrisson. 
                    </p>
                    <p>
                        Aujourd'hui, je suis un ninja et je souhaite devenir le plus fort des "Hokage". Je crois en ma force et je 
                        suis convaincu que je pourrai y arriver. Cependant, ma vie n'est pas facile depuis qu'on a scellé le démon
                        en moi... La plupart des gens ont peur de moi et ils ne veulent pas me parler...
                        <br/><br/>
                        Mais bon je leur prouverai de quoi je suis capable et ils finiront par m'aimer !! Puis j'ai quand même quelques 
                        amis, tout n'est pas perdu. Je préfère voir le bon côté des choses : j'ai tout à prouver. Je sais qu'un jour 
                        tout ira mieux, j'en suis convaincu.   
                        <br/><br/>
                        Cependant, je suis un peu inquiet. Je le sens au fond de moi, la bête qui dort et qui attend pour sortir. Malheureusement,
                        parfois je peux tellement m'énerver que son chakra maléfique peut se mêler au mien. Quand cela arrive, cela devient très 
                        dangereux, aussi bien pour mes ennemis que mes compagnons ... et même pour moi. Mais je vais apprendre à le maîtriser et 
                        un jour, peut-être, il sera mon allié. Qui sait ... On pourrait très bien se demander là tout de suite la raison de cette idée bien étrange, et bien pour le comprendre,
                        il faudra suivre mon aventure...
                    </p>
                </div>
            </div>
        </section>
        <section>
            <div class="secondary_desc">
                <h3>Mes objectifs</h3>
                <div class="button_desc">
                   <button><img src="http://projet-naruto.local/img/parchment_naruto.png" alt=""></button>
                   <button><img src="http://projet-naruto.local/img/parchment_naruto2.png" alt=""></button>
                   <button><img src="http://projet-naruto.local/img/parchment_naruto3.png" alt=""></button>
                </div>
            </div>
            <br/><br/><br/><br/>
        </section>
<?php

$content = ob_get_clean();
$css = ["http://projet-naruto.local/style/homepage.css"];
$temp = new Template($content, $css);
$temp->title = "Home";
$temp->init();
?>