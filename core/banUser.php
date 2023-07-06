<?php
session_start();
require "../conf.inc.php";
require 'functions.php';


$idUtilisateur = $_POST['id']; // Récupère l'id
print_r($idUtilisateur);
$connexion = connectDB();
$queryPrepared = $connexion->prepare("SELECT * FROM " . DB_PREFIX . "UTILISATEUR WHERE id_utilisateur = :userId ");
$queryPrepared->execute([
    "userId" => $idUtilisateur
]);


$queryPrepared->execute([  
    "userId" => $idUtilisateur
]);
$row = $queryPrepared->fetch();
//banni un utilisateur en changeant son type de compte
$statut = $row['statut'];

//si l'utilisateur est banni, on le débanni
if ($statut == 2) {
    $queryPrepared = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET statut = 1 WHERE id_utilisateur = :userId ");
    $queryPrepared->execute([
        "userId" => $idUtilisateur
    ]);
    $queryPrepared->execute();
    redirection('../user');
} else {
    //si l'utilisateur n'est pas banni, on le banni
    $queryPrepared = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET statut = 2 WHERE id_utilisateur = :userId ");
    $queryPrepared->execute([
        "userId" => $idUtilisateur
    ]);
    $queryPrepared->execute();
    redirection('../user');
}

