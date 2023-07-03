<?php
session_start();
require "../conf.inc.php";
require "functions.php";
// redirectIfNotConnected(); 


// Vérification si tous les champs sont remplis
if( count($_POST)<1 
	|| empty($_POST['nom_ingredient'])
){
	die ("ERREUR - La saisie est incorrecte.");
}

$listOfErrorsIngredient = [];
$isIngredientCreated = false;
$nom_allergene = [];


// Nettoyage nom ingrédient
$nom_ingredient = cleanName($_POST['nom_ingredient']);


// Nettoyage nom allergène
foreach($_POST['nom_allergene'] as $allergene) {
	$nom_allergene[] = cleanName($allergene);
}


// Vérification nom de l'ingrédient
$connection = connectDB();
$queryPrepared = $connection->prepare("SELECT * FROM ".DB_PREFIX."INGREDIENT WHERE nom_ingredient=:nom_ingredient");
$queryPrepared->execute([ "nom_ingredient" => $nom_ingredient ]);
$results = $queryPrepared->fetch();

if(!empty($results)){
	$listOfErrorsIngredient[] = "ingrédient existant.";
}


// Vérification nom des allergènes
$listAllergene = [];

$results2 = $connection->query("SELECT nom_allergene FROM ".DB_PREFIX."ALLERGENE");
$results2 = $results2->fetchAll();

foreach ($results2 as $allergene) {
	$listAllergene[] = $allergene["nom_allergene"];
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

	// Insertion en BDD de l'allergène
	foreach ($nom_allergene as $allergene) {
		if( !in_array($allergene, $listAllergene) ) {
			$queryPrepared = $connection->prepare("INSERT INTO ".DB_PREFIX."ALLERGENE (nom_allergene) VALUES (:nom_allergene)");
			$queryPrepared->execute(["nom_allergene"=>$allergene]);
		}

		// Insertion dans la table de liaison
		$queryPrepared = $connection->prepare("SELECT id_ingredient FROM ".DB_PREFIX."INGREDIENT WHERE nom_ingredient=:nom_ingredient");
		$queryPrepared->execute(["nom_ingredient"=>$nom_ingredient]);
		$results3 = $queryPrepared->fetch();

		$queryPrepared = $connection->prepare("SELECT id_allergene FROM ".DB_PREFIX."ALLERGENE WHERE nom_allergene=:nom_allergene");
		$queryPrepared->execute(["nom_allergene"=>$allergene]);
		$results4 = $queryPrepared->fetch();

		$queryPrepared = $connection->prepare("INSERT INTO ".DB_PREFIX."CONTENIR
												(produit, allergene)
												VALUES 
												(:id_ingredient, :id_allergene)");

		$queryPrepared->execute([
									"id_ingredient"=>$results3[0],
									"id_allergene"=>$results4[0]
								]);
	}

	$isIngredientCreated = true;
	$_SESSION['isIngredientCreated'] = $isIngredientCreated;

}else{
	$_SESSION['listOfErrorsIngredient'] = $listOfErrorsIngredient;
	$_SESSION['data'] = $_POST;
}

// Redirection backoffice
header('location:../backoffice'); 