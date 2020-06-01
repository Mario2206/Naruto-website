<?php $months = ["Janvier", "Février","Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"]; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="<?=PATH ?>style/subscription.css">
    <link rel="stylesheet" href="<?=PATH ?>style/common/common.css">
    <link rel="stylesheet" href="<?=PATH ?>style/common/form.css">
    <link rel="stylesheet" href="<?=PATH ?>style/common/alert.css">
    
</head>
<body>
    <section>
        <form method="post" action="<?=INTER_DIR?>/subscription/subscribing" enctype="multipart/form-data">
            <div id="container_h1">
                <h1>Inscription</h1>
            </div>
            <div id="container_form">
                <div class="formDiv" id="part1">
                    <div class="container_part">
                        <label>
                            Nom :
                            <input type="text" maxlength="20" required name="lastname" class="initInput" autocomplete="off" />
                        </label>
                        <label>
                            Prenom :
                            <input type="text" maxlength="20" required name="firstname" class="initInput" autocomplete="off"/>
                        </label>
                        <div class="label">
                            <p>Date de naissance :</p>
                            <div id="container_selects">

                                <select name="day" required class="date initInput">

                                    <option label="jour" ></option>

                                    <?php for($i = 1; $i <= 31 ; $i++) : ?>

                                        <option value="<?=$i ?>"><?=$i ?></option>
                                        
                                    <?php endfor; ?>
                                    
                                </select>

                                <select name="month" required class="date initInput">
                                    <option label="mois"></option>

                                    <?php for($i = 0, $c = count($months); $i < $c; $i++) :  ?>

                                        <option value="<?=$i + 1;?>"><?=$months[$i]; ?></option>

                                    <?php endfor; ?>

                                </select>

                                <select name="year" required class="date initInput">
                                    <option label="année"></option>

                                    <?php for($i = 1900; $i < date("Y"); $i++): ?>

                                        <option value="<?=$i ?>"><?=$i ?></option>

                                    <?php endfor ?>
                                </select>

                            </div> 
                        </div>
                        <label>
                            Nom d'utilisateur :
                            <input 
                            type="text"
                            placeholder="Nom de ninja" 
                            required 
                            name="username" 
                            maxlength="15" 
                            id="username" 
                            class="initInput" 
                            autocomplete="off"/>
                        </label>
                        <label>
                            E-Mail :
                            <input type="email"  required name="mail" class="initInput" autocomplete="off"/>
                        </label>
                        <label>
                            Mot de passe : 
                            <input type="password" 
                            required name="password" 
                            class="initInput" 
                            title="Inclure un caracètre spécial, une majuscule et deux chiffres au minimum"/>
                        </label>
                        <label>
                            Confirmer le mot de passe :
                            <input type="password" required name="confirmPassword" class="initInput"/>
                        </label>
                    </div>
                </div>
                <div class="formDiv" id="part2">
                    <div class="container_part">
                        <div id="container_avatar">
                            <div>
                                <p id="titleInputFile" class="title">Choisis ton image de profil :</p> 
                                <div id="avatar_label">
                                    <label>
                                        <span id="inputFile">Cliquer-ici</span>
                                        <input type="file" accept="image/png, image/jpeg" name="avatar" id="avatar"/>
                                    </label>
                                    <label for="avatar">
                                        <img id="avatarImg" src="<?=PATH ?>img/icon_connection.png" alt="AVATAR">
                                    </label>
                                </div>   
                            </div>
                        </div>
                        <div>
                            <p class="title">Choisis ton village caché : </p>
                            <div id="container_labelsForRadio">
                                <label>
                                    <img src="<?=PATH ?>img/konoha.png" class="imgCharact" alt="konoha"/>
                                    <input type="radio" name="village" value="konoha" checked />
                                </label>
                                <label>
                                    <img src="<?=PATH ?>img/iwa.png" class="imgCharact" alt="iwa"/>
                                    <input type="radio" name="village" value="iwa"  />
                                </label>
                                <label>
                                    <img src="<?=PATH ?>img/suna.png" class="imgCharact" alt="suna"/>
                                    <input type="radio" name="village" value="suna"  />
                                </label>
                                <label>
                                    <img src="<?=PATH ?>img/kiri.png" class="imgCharact" alt="kiri"/>
                                    <input type="radio" name="village" value="kiri"  />
                                </label>
                                <label>
                                    <img src="<?=PATH ?>img/kumo.png" class="imgCharact" alt="kumo"/>
                                    <input type="radio" name="village" value="kumo"  />
                                </label>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
            <div id="container_buttonForm">
                <div>
                     <a href="<?=INTER_DIR?>/" class="submit" id="return">Retour</a>
                     <input type="submit" value="Valider" class="submit" id="submitDef"/>
                </div>
            </div>
        </form>
    </section>
    <script src="<?=PATH ?>js/package/Ajax.js"></script>
    <script src="<?=PATH ?>js/package/HandlerRadio.js"></script>
    <script src="<?=PATH ?>js/package/AsyncInput.js"></script>
    <script src="<?=PATH ?>js/package/Input.js"></script>
    <script src="<?=PATH ?>js/package/Form.js"></script>
    <script src="<?=PATH ?>js/navigationSubscription.js"></script>
    
</body>
</html>
