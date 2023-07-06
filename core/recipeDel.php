<?php
session_start();
require "../conf.inc.php";
require "functions.php";
// redirectIfNotConnected(); 

// Vérification si tous les champs sont remplis
if( count($_POST)!=1 
    || empty($_POST['id_recipeDel'])
){
    die ("ERREUR - La saisie est incorrecte.");
}

$id_recipeDel = $_POST['id_recipeDel'];
$listOfErrorsRecipeDel = [];
$isRecipeDeleted = false;

// Vérification recette
$listRecipe = [];

$connection = connectDB();
$results2 = $connection->query("SELECT id_recette FROM ".DB_PREFIX."RECETTE");
$results2 = $results2->fetchAll();

foreach ($results2 as $recette) {
	$listRecipe[] = $recette["id_recette"];
}

if( !in_array($id_recipeDel, $listRecipe) ){
	$listOfErrorsRecipeDel[] = "Aucune recette selectionnée";
}

// Si tout est bon, supression en BDD
if(empty($listOfErrorsRecipeDel)){
    $queryPrepared = $connection->prepare("DELETE FROM ".DB_PREFIX."CONSTITUER WHERE preparation=:preparation");
    $queryPrepared->execute(["preparation"=>$id_recipeDel]);

    $queryPrepared = $connection->prepare("DELETE FROM ".DB_PREFIX."APPARTENIR WHERE recette_categorie=:recette_categorie");
    $queryPrepared->execute(["recette_categorie"=>$id_recipeDel]);

    $isRecipeDeleted = true;
    $_SESSION['isRecipeDeleted'] = $isRecipeDeleted;

}else{
	$_SESSION['listOfErrorsRecipeDel'] = $listOfErrorsRecipeDel;
}

// Supression de l'image sur serveur et BDD (+ recette)
if ($isRecipeDeleted) {
    $queryPrepared = $connection->prepare("SELECT image_recette FROM ".DB_PREFIX."RECETTE WHERE id_recette=:id_recette");
    $queryPrepared->execute(["id_recette" => $id_recipeDel]);
    $result = $queryPrepared->fetch();
    
    $dossier = "../";
    $image_recette = $result['image_recette'];
    $chemin_complet = $dossier . $image_recette;
    
    if (file_exists($chemin_complet)) {
        unlink($chemin_complet);
    }


    $queryPrepared = $connection->prepare("DELETE FROM ".DB_PREFIX."RECETTE         WHERE id_recette=:id_recette");
    $queryPrepared->execute(["id_recette" => $id_recipeDel]);
}


// Redirection backoffice
redirection('../backoffice');
