<?php
session_start();
require_once 'conf.inc.php';
require_once 'core/functions.php';
require('core/pdf/fpdf.php');
//utilisateur
$connexion = connectDB();
$queryPrepared = $connexion->prepare("SELECT * FROM " . DB_PREFIX . "UTILISATEUR WHERE email = :email ");

$email = $_SESSION['email']; // Récupère l'e-mail de la session


$queryPrepared->execute([
    "email" => $email
]);
$results = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);


//utilisateur
// Affiche les résultats
foreach ($results as $row) {
    // Accédez aux colonnes par leur nom
    $id = $row['id_utilisateur'];
    $nom = $row['nom_utilisateur'];
    $prenom = $row['prenom_utilisateur'];
    $pseudo = $row['pseudo'];
    $email = $row['email'];
    $telephone = $row['telephone'];
    $dateNaissance = $row['date_de_naissance'];
    $pointsFidelite = $row['point_utilisateur'];
    $role = $row['role_utilisateur'];
    $typeCompte = $row['type_compte'];
    $statut = $row['statut'];
    $dateInserted = $row['date_inserted'];
    $dateUpdated = $row['date_updated'];
    $pays = $row['country'];
    $adresse = $row['adresse'];
    $codePostal = $row['code_postal'];
    $ville = $row['ville'];

}
$recipePrepared = $connexion->prepare("SELECT * FROM " . DB_PREFIX . "RECETTE WHERE auteur_recette = :id ");
$recipePrepared->execute([
    "id" => $id
]);
$recipeResults = $recipePrepared->fetchAll(PDO::FETCH_ASSOC);
//recettes de l'utilisateur

foreach ($recipeResults as $rowRecipe){
    $idRecette = $rowRecipe['id_recette'];
    $nomRecette = $rowRecipe['nom_recette'];
    $difficulte = $rowRecipe['difficulte'];
    $description = $rowRecipe['description_recette'];
}
echo'<pre>';
echo 'recipe Results<br>';
var_dump($recipeResults);
echo 'recipe Row<br>';
var_dump($rowRecipe);
echo'</pre>';


?>
