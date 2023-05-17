<?php
session_start();
require "../conf.inc.php";
require "functions.php";
// redirectIfNotConnected(); 


// Vérification si tous les champs sont remplis
if( count($_POST)!=1 
	|| empty($_POST['nom_categorie'])
){
	die ("ERREUR - La saisie est incorrecte.");
}

// Nettoyage des données
$nom_categorie = cleanFirstname($_POST['nom_categorie']);

$listOfErrorsCategory = [];
$isCategoryCreated = false;

// Vérification nom de la catégorie
$connection = connectDB();
$queryPrepared = $connection->prepare("SELECT * FROM ".DB_PREFIX."CATEGORIE WHERE nom_categorie=:nom_categorie");
$queryPrepared->execute([ "nom_categorie" => $nom_categorie ]);
$results = $queryPrepared->fetch();

if(!empty($results)){
	$listOfErrorsCategory[] = "une catégorie porte déjà ce nom.";
}

// Si tout est bon : insertion en BDD et stockage isCreated, sinon : stockage des erreurs
if(empty($listOfErrorsCategory)){
	$queryPrepared = $connection->prepare("INSERT INTO ".DB_PREFIX."CATEGORIE
											(nom_categorie)
											VALUES 
											(:nom_categorie)");

	$queryPrepared->execute([
								"nom_categorie"=>$nom_categorie
							]);

	$isCategoryCreated = true;
	$_SESSION['isCategoryCreated'] = $isCategoryCreated;

}else{
	$_SESSION['listOfErrorsCategory'] = $listOfErrorsCategory;
}

// Redirection backoffice
header('location:../backoffice');