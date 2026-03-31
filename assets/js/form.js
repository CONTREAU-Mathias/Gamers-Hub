function verif_champ(form) {
    // Vérification des champs principaux
    const pseudo = document.getElementById('pseudo').value.trim();
    const email = document.getElementById('email').value.trim();
    const mdp = document.getElementById('mdp').value;
    const mdpVerif = document.getElementById('mdp_verif').value;
    const jeuxPrefere = document.getElementById('jeux_prefere').value.trim();
    const commentaire = document.getElementById('commentaire').value.trim();

    // Validation email
    if (!emailEstValide(email)) {
        alert("Veuillez entrer une adresse email valide !");
        return false;
    }

    // Vérification que les mots de passe correspondent
    if (mdp !== mdpVerif) {
        alert("Les mots de passe ne correspondent pas !");
        return false;
    }

    // Vérification des champs obligatoires
    if (!pseudo || !email || !mdp || !mdpVerif || !jeuxPrefere || !commentaire) {
        alert("Tous les champs obligatoires doivent être remplis !");
        return false;
    }

    // Si tout est valide, le formulaire peut être soumis
    return true;
}

// Fonction emailEstValide
function emailEstValide(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Démasquage du mdp
function decouvre_mdp() {
    document.getElementById("mdp").setAttribute("type", "text");
    document.getElementById("decache_mdp1").src="assets/images/icone/oeilFerme.png";
    document.getElementById("decache_mdp1").setAttribute("onClick", "couvre_mdp()");
}

function couvre_mdp() {
    document.getElementById("mdp").setAttribute("type", "password");
    document.getElementById("decache_mdp1").src="assets/images/icone/oeil.png";
    document.getElementById("decache_mdp1").setAttribute("onClick", "decouvre_mdp()");
}

function decouvre_mdp_verif() {
    document.getElementById("mdp_verif").setAttribute("type", "text");
    document.getElementById("decache_mdp2").src="assets/images/icone/oeilFerme.png";
    document.getElementById("decache_mdp2").setAttribute("onClick", "couvre_mdp_verif()");
}

function couvre_mdp_verif() {
    document.getElementById("mdp_verif").setAttribute("type", "password");
    document.getElementById("decache_mdp2").src="assets/images/icone/oeil.png";
    document.getElementById("decache_mdp2").setAttribute("onClick", "decouvre_mdp_verif()");
}

// Affichage caratère
function display_caratere() {
    let longueur_texterea = document.getElementById("commentaire").value.length;
    document.getElementById("compteur").innerHTML = "Caractère : " + longueur_texterea + " / 300";
};

// Blocage du submit
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('form_inscription');
    const submitButton = document.getElementById('button_style');

    form.addEventListener('input', function() {
        const pseudo = document.getElementById('pseudo').value;
        const email = document.getElementById('email').value;
        const mdp = document.getElementById('mdp').value;
        const mdpVerif = document.getElementById('mdp_verif').value;
        const jeuxPrefere = document.getElementById('jeux_prefere').value;
        const commentaire = document.getElementById('commentaire').value;

        if (pseudo && email && mdp && mdpVerif && jeuxPrefere && commentaire) {
            submitButton.disabled = false;
            console.log('Bouton activé');
        } else {
            submitButton.disabled = true;
            console.log('Bouton désactivé');
        }
    });
});

function duplicate() {
    // Créer un nouveau conteneur pour les champs supplémentaires
    const containerJeux = document.createElement('div');
    containerJeux.className = 'champ-jeux-supplementaire';

    // Créer un bouton de suppression
    const removeButton = document.createElement('button');
    removeButton.type = 'button';
    removeButton.innerHTML = '✖'; // Croix pour supprimer
    removeButton.className = 'btn-supprimer-champ';
    removeButton.addEventListener('click', function() {
        containerJeux.remove();
        // Optionnel : réactiver la validation du formulaire si nécessaire
        verifierFormulaireComplet();
    });

    // Créer le label pour les jeux
    const labelJeux = document.createElement('label');
    labelJeux.setAttribute('for', 'jeux_prefere_supplementaire');
    labelJeux.textContent = 'Vos jeux préférés* :';

    // Créer l'input pour les jeux
    const inputJeux = document.createElement('input');
    inputJeux.type = 'text';
    inputJeux.id = 'jeux_prefere_supplementaire_' + Date.now(); // ID unique
    inputJeux.name = 'jeux_prefere_supplementaire[]';
    inputJeux.required = true;

    // Créer le label pour le commentaire
    const labelCommentaire = document.createElement('label');
    labelCommentaire.setAttribute('for', 'commentaire_supplementaire');
    labelCommentaire.textContent = 'Leurs descriptions* :';

    // Créer le textarea pour le commentaire
    const textareaCommentaire = document.createElement('textarea');
    textareaCommentaire.id = 'commentaire_supplementaire_' + Date.now(); // ID unique
    textareaCommentaire.name = 'commentaire_supplementaire[]';
    textareaCommentaire.cols = 30;
    textareaCommentaire.rows = 10;
    textareaCommentaire.maxLength = 300;
    textareaCommentaire.required = true;
    textareaCommentaire.setAttribute('onkeyup', 'display_caratere()');

    // Créer le compteur de caractères
    const compteur = document.createElement('p');
    compteur.id = 'compteur_supplementaire_' + Date.now(); // ID unique
    compteur.textContent = 'Caractère : 0 / 300';

    // Ajouter le bouton de suppression
    containerJeux.appendChild(removeButton);

    // Ajouter les éléments au conteneur
    containerJeux.appendChild(labelJeux);
    containerJeux.appendChild(inputJeux);
    containerJeux.appendChild(labelCommentaire);
    containerJeux.appendChild(textareaCommentaire);
    containerJeux.appendChild(compteur);

    // Insérer le nouveau conteneur avant le bouton de soumission
    const formInSubmit = document.getElementById('form_in_submit');
    formInSubmit.parentNode.insertBefore(containerJeux, formInSubmit);

    // Mettre à jour la fonction de comptage des caractères pour les nouveaux champs
    textareaCommentaire.addEventListener('keyup', function() {
        compteur.textContent = `Caractère : ${this.value.length} / 300`;
        // Optionnel : réactiver la validation du formulaire
        verifierFormulaireComplet();
    });

    // Optionnel : réactiver la validation du formulaire
    verifierFormulaireComplet();
}

// Fonction pour vérifier si le formulaire est complet
function verifierFormulaireComplet() {
    const submitButton = document.getElementById('button_style');
    const pseudo = document.getElementById('pseudo').value;
    const email = document.getElementById('email').value;
    const mdp = document.getElementById('mdp').value;
    const mdpVerif = document.getElementById('mdp_verif').value;
    const jeuxPrefere = document.getElementById('jeux_prefere').value;
    const commentaire = document.getElementById('commentaire').value;

    // Vérifier les champs supplémentaires
    const champsSupplementaires = document.querySelectorAll('.champ-jeux-supplementaire');
    let champsSupplementairesValides = true;

    champsSupplementaires.forEach(champ => {
        const inputJeux = champ.querySelector('input[name="jeux_prefere_supplementaire[]"]');
        const textareaCommentaire = champ.querySelector('textarea[name="commentaire_supplementaire[]"]');
        
        if (!inputJeux.value.trim() || !textareaCommentaire.value.trim()) {
            champsSupplementairesValides = false;
        }
    });

    // Activer/désactiver le bouton de soumission
    if (pseudo && email && mdp && mdpVerif && jeuxPrefere && commentaire && champsSupplementairesValides) {
        submitButton.disabled = false;
    } else {
        submitButton.disabled = true;
    }
}

// Ajouter un écouteur d'événements global pour la validation
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('form_inscription');
    
    form.addEventListener('input', verifierFormulaireComplet);
});