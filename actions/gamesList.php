<?php
include("../config/config.php");

// Requête de sélection des jeux et de leur descriptions
$sql = "SELECT utilisateur.pseudo_utilisateur, jeux.nom_jeu, jeux.commentaire_jeu FROM utilisateur JOIN jeux ON utilisateur.id_utilisateur = jeux.id_utilisateur;";
$rsq_select_jeux = $cnx->prepare(query: $sql);

$rsq_select_jeux->execute();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../assets/images/logo/GAMERS.ico" type="image/x-icon">
        <link rel="stylesheet" href="../assets/css/style.css">
        <title>Gamers hub</title>
    </head>
    <body id="body_bck">
        <header>

            <!--Titres et logo du site-->
            <div>
                <h1>Gamers Hub</h1>
                <h2>Là où les joueur trouvent leur tribu !</h2>
                <img src="../assets/images/logo/GAMERS.ico" alt="Le logo de gamer hub" id="logo">
            </div>

            <!--Barre de navigation-->
            <div>
                <nav id="nav_bck">
                    <ul>
                        <li><a href="../index.php" id="nav_link">Accueil</a></li>
                        <li><a href="../inscription.php" id="nav_link">Inscription</a></li>
                        <li><a href="../consultation.php" id="nav_link">Consultation</a></li>
                        <li><a href="../contact.php" id="nav_link">Contact</a></li>
                    </ul>
                </nav>
            </div>

        </header>        

        <main id="body_section">

            <!--Les jeux et leurs avis-->
            <div>

                <table>    
                    <tr> <td colspan="3">Liste des jeux préféré des joueurs</td> </tr>    
                    <?php
                        while ($data = $rsq_select_jeux->fetch(PDO::FETCH_ASSOC)){
                            echo "<tr> <td>" . $data["pseudo_utilisateur"] . "</td> <td>" . $data["nom_jeu"] . "</td> <td>" . $data["commentaire_jeu"] . "</td>  </tr>";
                        }
                    ?>                
                </table>   

            </div>

        </main>
        <footer>

    <!--Section droit réservé-->
    <div>
        <h3>©Tout droit réservé | Gamers_Hub | 2025</h3>
    </div>

</footer>
</body>
</html>