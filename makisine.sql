CREATE TABLE MAKISINE_AVATAR (
    id_avatar INTEGER PRIMARY KEY AUTO_INCREMENT,
    forme_visage TINYINT,
    couleur_visage TINYINT,
    couleur_yeux TINYINT,
    couleur_vetement TINYINT,
    image_avatar VARCHAR(255)
);

CREATE TABLE MAKISINE_UTILISATEUR (
    id_utilisateur INTEGER PRIMARY KEY AUTO_INCREMENT,
    nom_utilisateur VARCHAR(120) NOT NULL,
    prenom_utilisateur VARCHAR(120) NOT NULL,
    pseudo VARCHAR(30) NOT NULL,
    email VARCHAR(320) NOT NULL,
    telephone VARCHAR(10) NOT NULL,
    date_de_naissance DATE NOT NULL,
    point_utilisateur INTEGER NOT NULL,
    role_utilisateur TINYINT NOT NULL,
    type_compte TINYINT NOT NULL,
    statut TINYINT NOT NULL DEFAULT -1,
    date_inserted TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    date_updated TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(),
    avatar_utilisateur INTEGER REFERENCES MAKISINE_AVATAR(id_avatar)
);

CREATE TABLE MAKISINE_NEWSLETTER (
    id_modele INTEGER PRIMARY KEY AUTO_INCREMENT,
    texte_newsletter TEXT NOT NULL,
    statut_newsletter TINYINT NOT NULL,
    frequence INTEGER NOT NULL
);

CREATE TABLE MAKISINE_EVENEMENT (
    id_evenement INTEGER PRIMARY KEY AUTO_INCREMENT,
    organisateur VARCHAR(120) NOT NULL,
    date_evenement DATE NOT NULL,
    lieu_evenement VARCHAR(255) NOT NULL,
    prix_evenement FLOAT NOT NULL,
    nombremax_participant INTEGER NOT NULL
);

CREATE TABLE MAKISINE_RECEVOIR (
    newsletter INTEGER NOT NULL,
    utilisateur INTEGER NOT NULL,
    PRIMARY KEY (newsletter,utilisateur),
    FOREIGN KEY (newsletter) REFERENCES MAKISINE_NEWSLETTER(id_modele),
    FOREIGN KEY (utilisateur) REFERENCES MAKISINE_UTILISATEUR(id_utilisateur)
);

CREATE TABLE MAKISINE_COMMANDE (
    id_commande INTEGER PRIMARY KEY AUTO_INCREMENT,
    client_commande INTEGER REFERENCES MAKISINE_UTILISATEUR(id_utilisateur),
    date_commande DATE NOT NULL
);

CREATE TABLE MAKISINE_PARTICIPER (
    evenement INTEGER NOT NULL,
    participant INTEGER NOT NULL,
    PRIMARY KEY (evenement,participant),
    FOREIGN KEY (evenement) REFERENCES MAKISINE_EVENEMENT(id_evenement),
    FOREIGN KEY (participant) REFERENCES MAKISINE_UTILISATEUR(id_utilisateur)

);

CREATE TABLE MAKISINE_USTENSILE (
    id_ustensile INTEGER PRIMARY KEY AUTO_INCREMENT,
    nom_ustensile VARCHAR(120) NOT NULL,
    prix_ustensile FLOAT NOT NULL,
    stock INTEGER NOT NULL
);

CREATE TABLE MAKISINE_COMPOSER (
    reference_commande INTEGER NOT NULL,
    produit INTEGER NOT NULL,
    PRIMARY KEY (reference_commande, produit),
    FOREIGN KEY (reference_commande) REFERENCES MAKISINE_COMMANDE(id_commande),
    FOREIGN KEY (produit) REFERENCES MAKISINE_USTENSILE(id_ustensile),
    quantité_produit INTEGER NOT NULL
);

CREATE TABLE MAKISINE_MESSAGE_FORUM (
    id_msg_forum INTEGER PRIMARY KEY AUTO_INCREMENT,
    texte_msg_forum TEXT NOT NULL,
    image_msg_forum VARCHAR(255),
    emetteur_msg_forum INTEGER REFERENCES MAKISINE_UTILISATEUR(id_utilisateur),
    date_msg_forum DATE NOT NULL
);

CREATE TABLE MAKISINE_MESSAGE (
    expediteur INTEGER NOT NULL,
    destinaire INTEGER NOT NULL,
    PRIMARY KEY (expediteur, destinaire),
    FOREIGN KEY (expediteur) REFERENCES MAKISINE_UTILISATEUR(id_utilisateur),
    FOREIGN KEY (destinataire) REFERENCES MAKISINE_UTILISATEUR(id_utilisateur),
    date_message DATE NOT NULL,
    texte_message TEXT NOT NULL
);

CREATE TABLE MAKISINE_RECETTE (
    id_recette INTEGER PRIMARY KEY AUTO_INCREMENT,
    nom_recette VARCHAR(255) NOT NULL,
    difficulte TINYINT NOT NULL,
    statut_publication TINYINT NOT NULL DEFAULT -1,
    temps_preparation INTEGER NOT NULL,
    description_recette TEXT NOT NULL,
    auteur_recette INTEGER REFERENCES MAKISINE_UTILISATEUR(id_utilisateur)
);

CREATE TABLE MAKISINE_NECESSITER (
    ustensile_necessaire INTEGER NOT NULL,
    recette INTEGER NOT NULL,
    PRIMARY KEY (ustensile_necessaire, recette),
    FOREIGN KEY (ustensile_necessaire) REFERENCES MAKISINE_USTENSILE(id_ustensile),
    FOREIGN KEY (recette) REFERENCES MAKISINE_RECETTE(id_recette)
);

CREATE TABLE MAKISINE_COMMENTAIRE (
    id_commentaire INTEGER PRIMARY KEY AUTO_INCREMENT,
    avis TEXT NOT NULL,
    image VARCHAR(255),
    recette_commentaire INTEGER REFERENCES MAKISINE_RECETTE(id_recette),
    auteur_commentaire INTEGER REFERENCES MAKISINE_UTILISATEUR(id_utilisateur),
    date_commentaire DATE NOT NULL
);

CREATE TABLE MAKISINE_INGREDIENT (
    id_ingredient INTEGER PRIMARY KEY AUTO_INCREMENT,
    nom_ingredient VARCHAR(200) NOT NULL
);

CREATE TABLE MAKISINE_CONSTITUER (
    ingredient INTEGER NOT NULL,
    preparation INTEGER NOT NULL,
    PRIMARY KEY (ingredient, preparation),
    FOREIGN KEY (ingredient) REFERENCES MAKISINE_INGREDIENT(id_ingredient),
    FOREIGN KEY (preparation) REFERENCES MAKISINE_RECETTE(id_recette),
    quantite_ingredient INTEGER NOT NULL
);

CREATE TABLE MAKISINE_ALLERGENE (
    id_allergene INTEGER PRIMARY KEY AUTO_INCREMENT,
    nom_allergene VARCHAR(200) NOT NULL
);

CREATE TABLE MAKISINE_CATEGORIE (
    id_categorie INTEGER PRIMARY KEY AUTO_INCREMENT,
    nom_categorie VARCHAR(200) NOT NULL
);

CREATE TABLE MAKISINE_CONTENIR (
    produit INTEGER NOT NULL,
    allergene INTEGER NOT NULL,
    PRIMARY KEY (produit, allergene),
    FOREIGN KEY (produit) REFERENCES MAKISINE_INGREDIENT(id_ingredient),
    FOREIGN KEY (allergene) REFERENCES MAKISINE_ALLERGENE(id_allergene)
);

CREATE TABLE MAKISINE_APPARTENIR (
    recette_categorie INTEGER NOT NULL,
    categorie INTEGER NOT NULL,
    PRIMARY KEY (recette_categorie, categorie),
    FOREIGN KEY (recette_categorie) REFERENCES MAKISINE_RECETTE(id_recette),
    FOREIGN KEY (categorie) REFERENCES MAKISINE_CATEGORIE(id_categorie)
);

CREATE TABLE MAKISINE_NOTE (
    id_note INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    point_note INTEGER NOT NULL,
    recette_note INTEGER REFERENCES MAKISINE_RECETTE(id_recette),
    auteur_note INTEGER REFERENCES MAKISINE_UTILISATEUR(id_utilisateur)
);