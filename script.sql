create table MAKISINE_ALLERGENE
(
    id_allergene  int          not null
        primary key,
    nom_allergene varchar(200) not null
);

create table MAKISINE_AVATAR
(
    id_avatar        int          not null
        primary key,
    forme_visage     tinyint      null,
    couleur_visage   tinyint      null,
    couleur_yeux     tinyint      null,
    couleur_vetement tinyint      null,
    image_avatar     varchar(255) null
);

create table MAKISINE_CATEGORIE
(
    id_categorie  int          not null
        primary key,
    nom_categorie varchar(200) not null
);

create table MAKISINE_EVENEMENT
(
    id_evenement          int          not null
        primary key,
    organisateur          varchar(120) not null,
    date_evenement        date         not null,
    lieu_evenement        varchar(255) not null,
    prix_evenement        float        not null,
    nombremax_participant int          not null
);

create table MAKISINE_INGREDIENT
(
    id_ingredient  int          not null
        primary key,
    nom_ingredient varchar(200) not null
);

create table MAKISINE_CONTENIR
(
    produit   int not null,
    allergene int not null,
    primary key (produit, allergene),
    constraint MAKISINE_CONTENIR_ibfk_1
        foreign key (produit) references MAKISINE_INGREDIENT (id_ingredient),
    constraint MAKISINE_CONTENIR_ibfk_2
        foreign key (allergene) references MAKISINE_ALLERGENE (id_allergene)
);

create index allergene
    on MAKISINE_CONTENIR (allergene);

create table MAKISINE_NEWSLETTER
(
    id_modele         int     not null
        primary key,
    texte_newsletter  text    not null,
    statut_newsletter tinyint not null,
    frequence         int     not null
);

create table MAKISINE_USTENSILE
(
    id_ustensile   int          not null
        primary key,
    nom_ustensile  varchar(120) not null,
    prix_ustensile float        not null,
    stock          int          not null
);

create table MAKISINE_UTILISATEUR
(
    id_utilisateur     int                                   not null
        primary key,
    nom_utilisateur    varchar(120)                          not null,
    prenom_utilisateur varchar(120)                          not null,
    pseudo             varchar(30)                           not null,
    email              varchar(320)                          not null,
    telephone          varchar(10)                           not null,
    date_de_naissance  date                                  not null,
    point_utilisateur  int                                   not null,
    role_utilisateur   tinyint                               not null,
    type_compte        tinyint                               not null,
    statut             tinyint   default -1                  not null,
    date_inserted      timestamp default current_timestamp() not null,
    date_updated       timestamp                             null on update current_timestamp(),
    avatar_utilisateur int                                   null,
    pwd                varchar(64)                           null,
    gender             tinyint                               null,
    constraint MAKISINE_UTILISATEUR_ibfk_1
        foreign key (avatar_utilisateur) references MAKISINE_AVATAR (id_avatar)
);

create table MAKISINE_COMMANDE
(
    id_commande     int  not null
        primary key,
    client_commande int  null,
    date_commande   date not null,
    constraint MAKISINE_COMMANDE_ibfk_1
        foreign key (client_commande) references MAKISINE_UTILISATEUR (id_utilisateur)
);

create index client_commande
    on MAKISINE_COMMANDE (client_commande);

create table MAKISINE_COMPOSER
(
    reference_commande int not null,
    produit            int not null,
    quantité_produit   int not null,
    primary key (reference_commande, produit),
    constraint MAKISINE_COMPOSER_ibfk_1
        foreign key (reference_commande) references MAKISINE_COMMANDE (id_commande),
    constraint MAKISINE_COMPOSER_ibfk_2
        foreign key (produit) references MAKISINE_USTENSILE (id_ustensile)
);

create index produit
    on MAKISINE_COMPOSER (produit);

create table MAKISINE_MESSAGE_FORUM
(
    id_msg_forum       int          not null
        primary key,
    texte_msg_forum    text         not null,
    image_msg_forum    varchar(255) null,
    emetteur_msg_forum int          null,
    date_msg_forum     date         not null,
    constraint MAKISINE_MESSAGE_FORUM_ibfk_1
        foreign key (emetteur_msg_forum) references MAKISINE_UTILISATEUR (id_utilisateur)
);

create index emetteur_msg_forum
    on MAKISINE_MESSAGE_FORUM (emetteur_msg_forum);

create table MAKISINE_PARTICIPER
(
    evenement   int not null,
    participant int not null,
    primary key (evenement, participant),
    constraint MAKISINE_PARTICIPER_ibfk_1
        foreign key (evenement) references MAKISINE_EVENEMENT (id_evenement),
    constraint MAKISINE_PARTICIPER_ibfk_2
        foreign key (participant) references MAKISINE_UTILISATEUR (id_utilisateur)
);

create index participant
    on MAKISINE_PARTICIPER (participant);

create table MAKISINE_RECETTE
(
    id_recette          int                not null
        primary key,
    nom_recette         varchar(255)       not null,
    difficulte          tinyint            not null,
    statut_publication  tinyint default -1 not null,
    temps_preparation   int                not null,
    description_recette text               not null,
    auteur_recette      int                null,
    constraint MAKISINE_RECETTE_ibfk_1
        foreign key (auteur_recette) references MAKISINE_UTILISATEUR (id_utilisateur)
);

create table MAKISINE_APPARTENIR
(
    recette_categorie int not null,
    categorie         int not null,
    primary key (recette_categorie, categorie),
    constraint MAKISINE_APPARTENIR_ibfk_1
        foreign key (recette_categorie) references MAKISINE_RECETTE (id_recette),
    constraint MAKISINE_APPARTENIR_ibfk_2
        foreign key (categorie) references MAKISINE_CATEGORIE (id_categorie)
);

create index categorie
    on MAKISINE_APPARTENIR (categorie);

create table MAKISINE_COMMENTAIRE
(
    id_commentaire      int          not null
        primary key,
    avis                text         not null,
    image               varchar(255) null,
    recette_commentaire int          null,
    auteur_commentaire  int          null,
    date_commentaire    date         not null,
    constraint MAKISINE_COMMENTAIRE_ibfk_1
        foreign key (recette_commentaire) references MAKISINE_RECETTE (id_recette),
    constraint MAKISINE_COMMENTAIRE_ibfk_2
        foreign key (auteur_commentaire) references MAKISINE_UTILISATEUR (id_utilisateur)
);

create index auteur_commentaire
    on MAKISINE_COMMENTAIRE (auteur_commentaire);

create index recette_commentaire
    on MAKISINE_COMMENTAIRE (recette_commentaire);

create table MAKISINE_CONSTITUER
(
    ingredient          int not null,
    preparation         int not null,
    quantite_ingredient int not null,
    primary key (ingredient, preparation),
    constraint MAKISINE_CONSTITUER_ibfk_1
        foreign key (ingredient) references MAKISINE_INGREDIENT (id_ingredient),
    constraint MAKISINE_CONSTITUER_ibfk_2
        foreign key (preparation) references MAKISINE_RECETTE (id_recette)
);

create index preparation
    on MAKISINE_CONSTITUER (preparation);

create table MAKISINE_NECESSITER
(
    ustensile_necessaire int not null,
    recette              int not null,
    primary key (ustensile_necessaire, recette),
    constraint MAKISINE_NECESSITER_ibfk_1
        foreign key (ustensile_necessaire) references MAKISINE_USTENSILE (id_ustensile),
    constraint MAKISINE_NECESSITER_ibfk_2
        foreign key (recette) references MAKISINE_RECETTE (id_recette)
);

create index recette
    on MAKISINE_NECESSITER (recette);

create index auteur_recette
    on MAKISINE_RECETTE (auteur_recette);

create table MAKISINE_RECEVOIR
(
    newsletter  int not null,
    utilisateur int not null,
    primary key (newsletter, utilisateur),
    constraint MAKISINE_RECEVOIR_ibfk_1
        foreign key (newsletter) references MAKISINE_NEWSLETTER (id_modele),
    constraint MAKISINE_RECEVOIR_ibfk_2
        foreign key (utilisateur) references MAKISINE_UTILISATEUR (id_utilisateur)
);

create index utilisateur
    on MAKISINE_RECEVOIR (utilisateur);

create index avatar_utilisateur
    on MAKISINE_UTILISATEUR (avatar_utilisateur);


