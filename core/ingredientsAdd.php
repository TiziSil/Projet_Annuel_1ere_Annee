<?php
session_start();
require "../conf.inc.php";
require "functions.php";
// redirectIfNotConnected(); 


// Vérification si tous les champs sont remplis
if( count($_POST)!=1 
	|| empty($_POST['nom_ingredient'])
){
	die ("ERREUR - La saisie est incorrecte.");
}

// Nettoyage des données
$nom_ingredient = cleanEmail($_POST['nom_ingredient']);

$listOfErrorsIngredient = [];
$isIngredientCreated = false;

// Vérification nom de l'ingrédient
$connection = connectDB();
$queryPrepared = $connection->prepare("SELECT * FROM ".DB_PREFIX."INGREDIENT WHERE nom_inngredient=:nom_ingredient");
$queryPrepared->execute([ "nom_ingredient" => $nom_ingredient ]);
$results = $queryPrepared->fetch();

if(!empty($results)){
	$listOfErrorsIngredient[] = "ingrédient existant.";
}

// Si tout est bon : insertion en BDD et stockage isCreated, sinon : stockage des erreurs
if(empty($listOfErrorsIngredient)){
	$queryPrepared = $connection->prepare("INSERT INTO ".DB_PREFIX."INGREDIENT
											(nom_ingredient)
											VALUES 
											(:nom_ingredient)");

	$queryPrepared->execute([
								"nom_ingredient"=>$nom_ingredient
							]);

	$isIngredientCreated = true;
	$_SESSION['isIngredientCreated'] = $isIngredientCreated;

}else{
	$_SESSION['listOfErrorsIngredient'] = $listOfErrorsIngredient;
}

// Redirection backoffice
header('location:../backoffice');