CREATE DATABASE IF NOT EXISTS gamers_hub;

CREATE TABLE utilisateur (
    id_utilisateur INT NOT NULL AUTO_INCREMENT,
    pseudo_utilisateur VARCHAR(50) NOT NULL,
    email_utilisateur VARCHAR(50) NOT NULL,
    mot_de_passe__utilisateur VARCHAR(50) NOT NULL,
    PRIMARY KEY(id_utilisateur)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE jeux (
    id_jeu INT NOT NULL AUTO_INCREMENT,
    nom_jeu VARCHAR(50) NOT NULL,
    commentaire_jeu VARCHAR(300) NOT NULL,
    id_utilisateur INT NOT NULL,
    PRIMARY KEY(id_jeu),
    CONSTRAINT FK_idUtilisateur FOREIGN KEY (id_utilisateur)
    REFERENCES utilisateur(id_utilisateur)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/* Insertion des données pour vérification */
INSERT INTO utilisateur (id_utilisateur, pseudo_utilisateur, email_utilisateur, mot_de_passe__utilisateur) VALUES 
(0,"xX_MarckAntoine_Xx", "marck@gmail.com", "$2y$10$BnsKcXVCELE5OCvmbWOYZ.uedKRURY7abjg5L3fbBSLTey2GkG3Di"),
(0,"DarkGamer69", "gamersecretmail@gmail.com", "$2y$10$vFeNdsBa6d5Qq10.O47XteQYv/GDno67knjVoqv4jCacPaCl1mNsO"),
(0,"Mr_Keybord", "keybord-801@gmail.com", "$2y$10$1JYs2Cj521dKntSnhIwKpOf80RO5afa4KddXZstm2FvgP9NfPWhnO")

INSERT INTO jeux (id_jeu, nom_jeu, commentaire_jeu, id_utilisateur) VALUES 
(0,"HellDivers 2", "Après une longue période de paix dorée et de colonisation interstellaire, d'anciens adversaires reviennent sous une forme plus évoluée et menacent à nouveau la Super-Terre. Face à cette nouvelle guerre galactique, la Super-Terre fait de nouveau appel à l'élite de ses défenseurs : les Helldivers.", 1),
(0,"Warhammer 40,000: Space Marine 2", "Warhammer 40,000: Space Marine 2 est un jeu vidéo hack 'n' slash de tir à la troisième personne. Le jeu se déroule dans l'univers Warhammer 40,000 de Games Workshop et présente le chapitre Ultramarines de Space Marine.", "2"),
(0,"Cooking Mama", "Cooking Mama implique que le joueur suive les instructions de la « Mama » titulaire pour cuisiner divers plats. Pour ce faire, il utilise le contrôleur de l'appareil, généralement l'écran tactile, pour effectuer diverses tâches de cuisine.", "3")