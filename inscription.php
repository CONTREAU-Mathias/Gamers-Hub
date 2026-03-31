<?php include("includes/header.php"); ?>

    <main id="body_section">
        <!--Formulaire-->
        <div>
            <h3>Formulaire d'inscription</h3>
            <form action="actions/register.php" method="post" onsubmit="return verif_champ(form_inscription)" id="form_inscription" name="form_inscription">
                <div id="form_pseudo_email">
                    <div id="form_in_pseudo">
                        <!--Pseudo-->
                        <label for="pseudo">Pseudo* :</label>
                        <input type="text" id="pseudo" name="pseudo">
                        <br>
                    </div>
                    <div id="form_in_email">
                        <!--Email-->
                        <label for="email">Email* :</label>
                        <input type="text" id="email" name="email">
                        <br>
                    </div>
                </div>
                <div id="form_mdp">
                    <div id="form_in_mdp">
                        <!--Mot de passe-->
                        <label for="mdp">Mot de passe* :</label>
                        <input type="password" id="mdp" name="mdp">
                        <img id="decache_mdp1" class="img_icone_form" onClick="decouvre_mdp()" src="assets/images/icone/oeil.png">
                        <br>
                    </div>
                    <div id="form_in_mdp_verif">
                        <!--Confirmation du mot de passe-->
                        <label for="mdp_verif">Confirmation du mdp* :</label>
                        <input type="password" id="mdp_verif" name="mdp_verif">
                        <img id="decache_mdp2" class="img_icone_form" onClick="decouvre_mdp_verif()" src="assets/images/icone/oeil.png">
                        <br>
                    </div>
                </div>
                <div id="form_jeux_submit">
                    <div id="form_in_dup">
                        <!--Plus de jeux-->
                        <label for="dupliquer_champ">Ajouter plus de jeux :</label>
                        <button type="button" id="dupliquer_champ" name="dupliquer_champ" onClick="duplicate()"><img src="assets/images/icone/bouton-ajouter.png" width="32px"></button>
                        <br>
                    </div>
                    <div id="form_in_jeux">
                        <!--Vos jeux préférés-->
                        <label for="jeux_prefere" id="label_jeux_prefere">Vos jeux préférés* :</label>
                        <input type="text" id="jeux_prefere" name="jeux_prefere">
                        <br>
                    </div>
                    <div id="form_in_descriptions">
                        <!--Et pourquoi donc ?-->
                        <label for="commentaire" id="label_commentaire">Leurs descriptions* :</label>
                        <textarea name="commentaire" id="commentaire" cols="30" rows="10" maxlength="300" onkeyup="display_caratere()"></textarea>
                        <p id="compteur">Caractère : 0 / 300</p>
                        <br>
                    </div>
                    <div id="form_in_submit">
                        <!--Envoyer ?-->
                        <input type="submit" id="button_style" class="js_donne" disabled>
                    </div>
                </div>
            </form>
        </div>
    </main>
    
<?php include("includes/footer.php");?>