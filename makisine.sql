--test dans la bdd sur le serveur
/*CREATE TABLE makisine_AVATAR(
    id_avatar INTEGER PRIMARY KEY,
    forme_visage VARCHAR(255),
    couleur_visage VARCHAR(255),
    couleur_yeux VARCHAR(255),
    couleur_vetement VARCHAR(255),
    dessin_avatar VARCHAR(255)


);

CREATE TABLE makisine_UTILISATEUR(
    id_utilisateur INTEGER PRIMARY KEY,
    nom_utilisateur VARCHAR(60),
    prenom_utilisateur VARCHAR(60),
    pseudonyme VARCHAR(100),
    email VARCHAR(255),
    telephone CHAR(10),
    date_naissance DATE,
    point TINYINT,
    role TINYINT,
    type_compte TINYINT,
    theme VARCHAR(50),
    date_connexion DATE,
    date_uptdate_profil DATE,
    id_avatar INTEGER,
    FOREIGN KEY (id_avatar) REFERENCES makisine_AVATAR(id_avatar)



);
CREATE TABLE makisine_RECETTE(
    id_recette INTEGER PRIMARY KEY,
    nom_recette VARCHAR(60),
    difficulte TINYINT,
    temps_preparation VARCHAR(20),
    description TEXT,
    id_utilisateur INTEGER REFERENCES makisine_UTILISATEUR(id_utilisateur),
    id_utilisateur_1 INTEGER REFERENCES makisine_UTILISATEUR(id_utilisateur)

);

CREATE TABLE makisine_NOTE(
    id_note INTEGER PRIMARY KEY,
    point_note TINYINT,
    id_recette INTEGER REFERENCES makisine_RECETTE(id_recette),
    id_utilisateur INTEGER REFERENCES makisine_UTILISATEUR(id_utilisateur)



);

CREATE TABLE makisine_COMMANDE(
    id_commande INTEGER PRIMARY KEY,
    date_commande DATE,
    id_utilisateur INTEGER REFERENCES makisine_UTILISATEUR(id_utilisateur)
);

CREATE TABLE makisine_COMMENTAIRE(
    id_commentaire INTEGER PRIMARY KEY,
    avis TEXT,
    image VARCHAR(200),
    date_commentaire DATE,
    id_recette INTEGER REFERENCES makisine_recette(id_recette),
    id_utilisateur INTEGER REFERENCES makisine_UTILISATEUR(id_utilisateur)

);

CREATE TABLE makisine_INGREDIENT(
    id_ingredient INTEGER PRIMARY KEY,
    nom_ingredient VARCHAR(100)
);


CREATE TABLE makisine_ALLERGENE(
    id_allergene INTEGER PRIMARY KEY,
    nom_allergene VARCHAR(100)

);

CREATE TABLE makisine_CATEGORIE(
    id_categorie INTEGER PRIMARY KEY ,
    nom_categorie VARCHAR(60)
);


CREATE TABLE makisine_USTENSILE(
    id_ustensile INTEGER PRIMARY KEY,
    nom_ustensile VARCHAR(60),
    prix_ustensile VARCHAR(10),
    stock INTEGER

);

CREATE TABLE makisine_MESSAGE_FORUM(
    id_forum INTEGER PRIMARY KEY,
    texte_forum TEXT,
    image_forum VARCHAR(255),
    id_utilisateur INTEGER REFERENCES makisine_UTILISATEUR(id_utilisateur),
    date_msgforum DATE
);

CREATE TABLE makisine_EVENEMENT(
    id_evenement INTEGER PRIMARY KEY,
    organisateur VARCHAR(100),
    date_evenement DATE,
    lieu_evenement VARCHAR(100),
    prix_evenement FLOAT,
    nombreparticipant INTEGER
);

CREATE TABLE makisine_NEWSLETTER(
    id_modele INTEGER PRIMARY KEY,
    texte_newletter TEXT,
    image_newsletter VARCHAR(255),
    frequence INTEGER
);









CREATE TABLE makisine_ecrit(
    utilisateur INTEGER REFERENCES makisine_UTILISATEUR(id_utilisateur),
    utilisateur_1 INTEGER REFERENCES makisine_UTILISATEUR(id_utilisateur),
    date_message DATE,
    texte_message TEXT,
    PRIMARY KEY (utilisateur,utilisateur_1)
);

CREATE TABLE makisine_necessite(
    id_ustensile INTEGER REFERENCES makisine_USTENSILE(id_ustensile),
    id_recette INTEGER REFERENCES  makisine_RECETTE(id_recette),
    PRIMARY KEY (id_ustensile,id_recette)
);

CREATE TABLE makisine_appartient(
    id_recette INTEGER REFERENCES makisine_RECETTE(id_recette),
    id_categorie INTEGER REFERENCES makisine_CATEGORIE(id_categorie),
    PRIMARY KEY (id_recette,id_categorie)
);

CREATE TABLE makisine_compose(
    id_commande INTEGER REFERENCES makisine_COMMANDE(id_commande),
    id_ustensile INTEGER REFERENCES makisine_USTENSILE(id_ustensile),
    quantite_ustensile INTEGER,
    PRIMARY KEY (id_commande,id_ustensile)
);

CREATE TABLE makisine_recoit(
    id_newsletter INTEGER REFERENCES makisine_NEWSLETTER(id_modele),
    id_utilisateur INTEGER REFERENCES makisine_UTILISATEUR(id_utilisateur),
    PRIMARY KEY (id_newsletter,id_utilisateur)
);

CREATE TABLE makisine_participe(
    id_evenement INTEGER REFERENCES makisine_EVENEMENT(id_evenement),
    id_utilisateur INTEGER REFERENCES  makisine_UTILISATEUR(id_utilisateur),
    PRIMARY KEY (id_evenement,id_utilisateur)
);

CREATE TABLE makisine_contient(
    id_ingredient INTEGER REFERENCES makisine_INGREDIENT(id_ingredient),
    id_allergene INTEGER REFERENCES makisine_ALLERGENE(id_allergene),
    PRIMARY KEY (id_ingredient,id_allergene)
);

CREATE TABLE makisine_constitue(
    id_ingredient INTEGER REFERENCES makisine_INGREDIENT(id_ingredient),
    id_recette INTEGER REFERENCES makisine_RECETTE(id_recette),
    PRIMARY KEY (id_ingredient,id_recette)
);

ALTER TABLE makisine_UTILISATEUR ADD pwd VARCHAR(64);
commit;
*/