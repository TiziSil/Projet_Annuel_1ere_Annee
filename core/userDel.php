<?php
session_start();
require "../conf.inc.php";
require "functions.php";
//redirectIfNotConnected();


$userId = $_POST['id'];

// Connexion à la base de données
$connection = connectDB();


//vérifier si l'utilisateur a une recette
$resultsRecipe = $connection->prepare("SELECT auteur_recette FROM " . DB_PREFIX . "RECETTE WHERE auteur_recette = :id");
$resultsRecipe->execute([':id' => $userId]);

if ($resultsRecipe->rowCount() > 0) {
    $queryRecipe = $connection->prepare("DELETE FROM " . DB_PREFIX . "RECETTE WHERE auteur_recette = :id");
    $queryRecipe->execute([':id' => $userId]);
}


//vérfier si l'utilisateur a un commentaire
$resultsComment = $connection->prepare("SELECT id_commentaire FROM " . DB_PREFIX . "COMMENTAIRE WHERE id_commentaire = :id");
$resultsComment->execute([':id' => $userId]);

if ($resultsComment->rowCount() > 0) {
    $queryComment = $connection->prepare("DELETE FROM " . DB_PREFIX . "COMMENTAIRE WHERE id_commentaire = :id");
    $queryComment->execute([':id' => $userId]);
}

//vérifier si il participe a un evenement
$resultsEvent = $connection->prepare("SELECT id_evenement FROM " . DB_PREFIX . "EVENEMENT WHERE id_evenement = :id");
// Supprimer l'avatar de l'utilisateur
$queryAvatar = $connection->prepare("DELETE FROM " . DB_PREFIX . "AVATAR WHERE id_avatar IN (SELECT avatar_utilisateur FROM " . DB_PREFIX . "UTILISATEUR WHERE id_utilisateur = :id)");
$queryAvatar->execute([':id' => $userId]);
 
// Supprimer l'utilisateur
$queryUser = $connection->prepare("DELETE FROM " . DB_PREFIX . "UTILISATEUR WHERE id_utilisateur = :id");
$queryUser->execute([':id' => $userId]);

redirection('../user');
?>
