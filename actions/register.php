<?php
include("../config/config.php");

// Création des fonctions de vérification des données et du mot de passe
function securisation_donnees(string $donnee): string {
    $donnee = trim($donnee);
    $donnee = strip_tags($donnee);
    $donnee = stripslashes($donnee);
    return $donnee;
}

function verification_mot_de_passe(string $mdp, string $mdp_verif): bool {
    return $mdp === $mdp_verif;
}

// Récupération des données du formulaire
$util_pseudo = securisation_donnees($_POST["pseudo"]);
$util_email = securisation_donnees($_POST["email"]);
$util_mdp = securisation_donnees($_POST["mdp"]);
$util_mdp_verif = securisation_donnees($_POST["mdp_verif"]);

// Vérification de la variable mot de passe avec mot de passe verif
if (!verification_mot_de_passe($util_mdp, $util_mdp_verif)) {
    $_SESSION['error'] = "Confirmation du mot de passe incorrect.";
    header('Location: ../inscription.php');
    exit();
}

// Hash du mot de passe
$util_mdp_hash = password_hash($util_mdp, PASSWORD_BCRYPT);

try {
    // Début de la transaction
    $cnx->beginTransaction();

    // Insertion des données de la table utilisateur
    $sql_1 = "INSERT INTO utilisateur (pseudo_utilisateur, email_utilisateur, mot_de_passe__utilisateur) 
              VALUES (:pseudo_utilisateur, :email_utilisateur, :mot_de_passe_utilisateur)";
    $rs_insert_1 = $cnx->prepare($sql_1);
    $rs_insert_1->execute([
        ":pseudo_utilisateur" => $util_pseudo,
        ":email_utilisateur" => $util_email,
        ":mot_de_passe_utilisateur" => $util_mdp_hash
    ]);

    // Récupération de l'ID de l'utilisateur
    $util_id = $cnx->lastInsertId();

    // Insertion du jeu principal
    $util_jeux = securisation_donnees($_POST["jeux_prefere"]);
    $util_descriptions = securisation_donnees($_POST["commentaire"]);

    $sql_3 = "INSERT INTO jeux (nom_jeu, commentaire_jeu, id_utilisateur) 
              VALUES (:nom_jeu, :commentaire_jeu, :id_utilisateur2)";
    $rs_insert_2 = $cnx->prepare($sql_3);
    $rs_insert_2->execute([
        ":nom_jeu" => $util_jeux,
        ":commentaire_jeu" => $util_descriptions,
        ":id_utilisateur2" => $util_id
    ]);

    // Insertion des jeux supplémentaires (s'ils existent)
    if (isset($_POST['jeux_prefere_supplementaire'])) {
        $jeux_supplementaires = $_POST['jeux_prefere_supplementaire'];
        $commentaires_supplementaires = $_POST['commentaire_supplementaire'];

        foreach ($jeux_supplementaires as $index => $jeu) {
            if (!empty($jeu)) {
                $jeu_secu = securisation_donnees($jeu);
                $commentaire_secu = securisation_donnees($commentaires_supplementaires[$index]);

                $rs_insert_2->execute([
                    ":nom_jeu" => $jeu_secu,
                    ":commentaire_jeu" => $commentaire_secu,
                    ":id_utilisateur2" => $util_id
                ]);
            }
        }
    }

    // Validation de la transaction
    $cnx->commit();

    // Redirection vers la page principale
    header('Location: ../index.php');
    exit();

} catch(PDOException $e) {
    // Annulation de la transaction en cas d'erreur
    $cnx->rollBack();
    
    // Gestion de l'erreur
    $_SESSION['error'] = "Erreur lors de l'inscription : " . $e->getMessage();
    header('Location: ../inscription.php');
    exit();
}