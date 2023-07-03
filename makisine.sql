create table Makisine.MAKISINE_ALLERGENE
(
    id_allergene  int auto_increment
        primary key,
    nom_allergene varchar(200) not null
);

create table Makisine.MAKISINE_AVATAR
(
    id_avatar      int auto_increment
        primary key,
    image_avatar   varchar(255) null,
    couleurPeau    varchar(60)  null,
    couleurCheveux varchar(60)  null,
    yeux           varchar(60)  null,
    coiffure       varchar(60)  null,
    accessoire     varchar(60)  null,
    pilosite       varchar(60)  null,
    bouche         varchar(60)  null
);

create table Makisine.MAKISINE_CATEGORIE
(
    id_categorie  int auto_increment
        primary key,
    nom_categorie varchar(200) not null
);

create table Makisine.MAKISINE_EVENEMENT
(
    id_evenement          int auto_increment
        primary key,
    organisateur          varchar(120) not null,
    date_evenement        date         not null,
    lieu_evenement        varchar(255) not null,
    prix_evenement        float        not null,
    nombremax_participant int          not null
);

create table Makisine.MAKISINE_INGREDIENT
(
    id_ingredient  int auto_increment
        primary key,
    nom_ingredient varchar(200) not null
);

create table Makisine.MAKISINE_CONTENIR
(
    produit   int not null,
    allergene int not null,
    primary key (produit, allergene),
    constraint MAKISINE_CONTENIR_ibfk_1
        foreign key (produit) references Makisine.MAKISINE_INGREDIENT (id_ingredient),
    constraint MAKISINE_CONTENIR_ibfk_2
        foreign key (allergene) references Makisine.MAKISINE_ALLERGENE (id_allergene)
);

create index allergene
    on Makisine.MAKISINE_CONTENIR (allergene);

create table Makisine.MAKISINE_NEWSLETTER
(
    id_modele         int auto_increment
        primary key,
    texte_newsletter  text    not null,
    statut_newsletter tinyint not null,
    frequence         int     not null
);

create table Makisine.MAKISINE_USTENSILE
(
    id_ustensile   int auto_increment
        primary key,
    nom_ustensile  varchar(120) not null,
    prix_ustensile float        not null,
    stock          int          not null
);

create table Makisine.MAKISINE_UTILISATEUR
(
    id_utilisateur     int auto_increment
        primary key,
    nom_utilisateur    varchar(120)                          not null,
    prenom_utilisateur varchar(120)                          not null,
    pseudo             varchar(30)                           not null,
    email              varchar(320)                          not null,
    telephone          varchar(10)                           not null,
    date_de_naissance  date                                  not null,
    point_utilisateur  int                                   null,
    role_utilisateur   tinyint   default -1                  not null,
    type_compte        tinyint   default -1                  not null,
    statut             tinyint   default 1                   not null,
    date_inserted      timestamp default current_timestamp() not null,
    date_updated       timestamp                             null on update current_timestamp(),
    avatar_utilisateur int                                   null,
    country            char(2)                               null,
    adresse            varchar(100)                          null,
    code_postal        varchar(10)                           null,
    ville              varchar(30)                           null,
    pwd                varchar(64)                           not null,
    n_password         char                                  null,
    constraint MAKISINE_UTILISATEUR_ibfk_1
        foreign key (avatar_utilisateur) references Makisine.MAKISINE_AVATAR (id_avatar)
);

create table Makisine.MAKISINE_COMMANDE
(
    id_commande     int auto_increment
        primary key,
    client_commande int  null,
    date_commande   date not null,
    constraint MAKISINE_COMMANDE_ibfk_1
        foreign key (client_commande) references Makisine.MAKISINE_UTILISATEUR (id_utilisateur)
);

create index client_commande
    on Makisine.MAKISINE_COMMANDE (client_commande);

create table Makisine.MAKISINE_COMPOSER
(
    reference_commande int not null,
    produit            int not null,
    quantité_produit   int not null,
    primary key (reference_commande, produit),
    constraint MAKISINE_COMPOSER_ibfk_1
        foreign key (reference_commande) references Makisine.MAKISINE_COMMANDE (id_commande),
    constraint MAKISINE_COMPOSER_ibfk_2
        foreign key (produit) references Makisine.MAKISINE_USTENSILE (id_ustensile)
);

create index produit
    on Makisine.MAKISINE_COMPOSER (produit);

create table Makisine.MAKISINE_MESSAGE
(
    expediteur    int  not null,
    destinaire    int  not null,
    date_message  date not null,
    texte_message text not null,
    primary key (expediteur, destinaire),
    constraint MAKISINE_MESSAGE_ibfk_1
        foreign key (expediteur) references Makisine.MAKISINE_UTILISATEUR (id_utilisateur),
    constraint MAKISINE_MESSAGE_ibfk_2
        foreign key (destinaire) references Makisine.MAKISINE_UTILISATEUR (id_utilisateur)
);

create index destinaire
    on Makisine.MAKISINE_MESSAGE (destinaire);

create table Makisine.MAKISINE_MESSAGE_FORUM
(
    id_msg_forum       int auto_increment
        primary key,
    texte_msg_forum    text         not null,
    image_msg_forum    varchar(255) null,
    emetteur_msg_forum int          null,
    date_msg_forum     date         not null,
    constraint MAKISINE_MESSAGE_FORUM_ibfk_1
        foreign key (emetteur_msg_forum) references Makisine.MAKISINE_UTILISATEUR (id_utilisateur)
);

create index emetteur_msg_forum
    on Makisine.MAKISINE_MESSAGE_FORUM (emetteur_msg_forum);

create table Makisine.MAKISINE_PARTICIPER
(
    evenement   int not null,
    participant int not null,
    primary key (evenement, participant),
    constraint MAKISINE_PARTICIPER_ibfk_1
        foreign key (evenement) references Makisine.MAKISINE_EVENEMENT (id_evenement),
    constraint MAKISINE_PARTICIPER_ibfk_2
        foreign key (participant) references Makisine.MAKISINE_UTILISATEUR (id_utilisateur)
);

create index participant
    on Makisine.MAKISINE_PARTICIPER (participant);

create table Makisine.MAKISINE_RECETTE
(
    id_recette          int auto_increment
        primary key,
    nom_recette         varchar(255)       not null,
    difficulte          tinyint            not null,
    statut_publication  tinyint default -1 not null,
    temps_preparation   int                not null,
    description_recette text               not null,
    auteur_recette      int                null,
    constraint MAKISINE_RECETTE_ibfk_1
        foreign key (auteur_recette) references Makisine.MAKISINE_UTILISATEUR (id_utilisateur)
);

create table Makisine.MAKISINE_APPARTENIR
(
    recette_categorie int not null,
    categorie         int not null,
    primary key (recette_categorie, categorie),
    constraint MAKISINE_APPARTENIR_ibfk_1
        foreign key (recette_categorie) references Makisine.MAKISINE_RECETTE (id_recette),
    constraint MAKISINE_APPARTENIR_ibfk_2
        foreign key (categorie) references Makisine.MAKISINE_CATEGORIE (id_categorie)
);

create index categorie
    on Makisine.MAKISINE_APPARTENIR (categorie);

create table Makisine.MAKISINE_COMMENTAIRE
(
    id_commentaire      int auto_increment
        primary key,
    avis                text         not null,
    image               varchar(255) null,
    recette_commentaire int          null,
    auteur_commentaire  int          null,
    date_commentaire    date         not null,
    constraint MAKISINE_COMMENTAIRE_ibfk_1
        foreign key (recette_commentaire) references Makisine.MAKISINE_RECETTE (id_recette),
    constraint MAKISINE_COMMENTAIRE_ibfk_2
        foreign key (auteur_commentaire) references Makisine.MAKISINE_UTILISATEUR (id_utilisateur)
);

create index auteur_commentaire
    on Makisine.MAKISINE_COMMENTAIRE (auteur_commentaire);

create index recette_commentaire
    on Makisine.MAKISINE_COMMENTAIRE (recette_commentaire);

create table Makisine.MAKISINE_CONSTITUER
(
    ingredient          int not null,
    preparation         int not null,
    quantite_ingredient int not null,
    primary key (ingredient, preparation),
    constraint MAKISINE_CONSTITUER_ibfk_1
        foreign key (ingredient) references Makisine.MAKISINE_INGREDIENT (id_ingredient),
    constraint MAKISINE_CONSTITUER_ibfk_2
        foreign key (preparation) references Makisine.MAKISINE_RECETTE (id_recette)
);

create index preparation
    on Makisine.MAKISINE_CONSTITUER (preparation);

create table Makisine.MAKISINE_NECESSITER
(
    ustensile_necessaire int not null,
    recette              int not null,
    primary key (ustensile_necessaire, recette),
    constraint MAKISINE_NECESSITER_ibfk_1
        foreign key (ustensile_necessaire) references Makisine.MAKISINE_USTENSILE (id_ustensile),
    constraint MAKISINE_NECESSITER_ibfk_2
        foreign key (recette) references Makisine.MAKISINE_RECETTE (id_recette)
);

create index recette
    on Makisine.MAKISINE_NECESSITER (recette);

create table Makisine.MAKISINE_NOTE
(
    id_note      int auto_increment
        primary key,
    point_note   int not null,
    recette_note int null,
    auteur_note  int null,
    constraint MAKISINE_NOTE_ibfk_1
        foreign key (recette_note) references Makisine.MAKISINE_RECETTE (id_recette),
    constraint MAKISINE_NOTE_ibfk_2
        foreign key (auteur_note) references Makisine.MAKISINE_UTILISATEUR (id_utilisateur)
);

create index auteur_note
    on Makisine.MAKISINE_NOTE (auteur_note);

create index recette_note
    on Makisine.MAKISINE_NOTE (recette_note);

create index auteur_recette
    on Makisine.MAKISINE_RECETTE (auteur_recette);

create table Makisine.MAKISINE_RECEVOIR
(
    newsletter  int not null,
    utilisateur int not null,
    primary key (newsletter, utilisateur),
    constraint MAKISINE_RECEVOIR_ibfk_1
        foreign key (newsletter) references Makisine.MAKISINE_NEWSLETTER (id_modele),
    constraint MAKISINE_RECEVOIR_ibfk_2
        foreign key (utilisateur) references Makisine.MAKISINE_UTILISATEUR (id_utilisateur)
);

create index utilisateur
    on Makisine.MAKISINE_RECEVOIR (utilisateur);

create index avatar_utilisateur
    on Makisine.MAKISINE_UTILISATEUR (avatar_utilisateur);


