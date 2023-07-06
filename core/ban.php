<?php
session_start();
require "../conf.inc.php";
require 'functions.php';


$idUtilisateur = $_POST['id']; // Récupère l'id
print_r($idUtilisateur);
$connexion = connectDB();
$queryPrepared = $connexion->prepare("SELECT * FROM " . DB_PREFIX . "UTILISATEUR WHERE id_utilisateur = :userId ");
$queryPrepared->bindParam(':userId', $idUtilisateur);


$queryPrepared->execute([  
    "userId" => $idUtilisateur
]);
$row = $queryPrepared->fetch();
//banni un utilisateur en changeant son type de compte
$type_compte = $row['type_compte'];


