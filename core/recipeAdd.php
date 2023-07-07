<?php
session_start();
require "../conf.inc.php";
require "functions.php";
redirectIfNotConnected(); 


// Vérification si tous les champs sont remplis
if( count($_POST)!=7 
	|| empty($_POST['nom_recette'])
	|| !isset($_POST['id_categorie'])
	|| !isset($_POST['difficulte'])
	|| empty($_POST['temps_preparation'])
	|| empty($_POST['description_recette'])
	|| empty($_POST['quantite_ingredient'][0])
	|| empty($_POST['id_ingredient'][0])
	|| count($_FILES)!= 1
	|| !(isset($_FILES['image_recette']) && $_FILES['image_recette']['error'] == 0)
) {

	die ("ERREUR - La saisie est incorrecte.");
}


$listOfErrorsRecipe = [];
$isRecipeCreated = false;


// Vérification des données $_POST
$nom_recette = trim($_POST['nom_recette']);
$id_categorie = $_POST['id_categorie'];
$difficulte = $_POST['difficulte'];
$temps_preparation = $_POST['temps_preparation'];
$description_recette = $_POST['description_recette'];
$quantite_ingredient = [];
$id_ingredient = [];

foreach($_POST["quantite_ingredient"] as $quantite) {
	$quantite_ingredient[] = $quantite;
}

foreach($_POST["id_ingredient"] as $ingredient) {
	$id_ingredient[] = $ingredient;
}



// Vérification et stockage des données $_FILES
//$dossier_image = "C:\\xampp\\htdocs\\ProjetAnnuel\\pages\\recettes\\photo_recette\\";
$dossier_image = '/var/www/pages/recettes/photo_recette/';
$photo_temp = $_FILES['image_recette']['tmp_name'];

if (!is_uploaded_file($photo_temp)) {
	$listOfErrorsRecipe[] = "Fichier introuvable";
}

if ($_FILES['image_recette']['size'] >= 1000000) {
	$listOfErrorsRecipe[] = "Fichier trop volumineux";
}

$extension = ["png", "jpeg", "jpg"];
$photo_extension = strtolower(pathinfo($_FILES['image_recette']['name'], PATHINFO_EXTENSION));

if (!in_array($photo_extension, $extension)) {
	$listOfErrorsRecipe[] = "Type de fichier non-autorisé";
}



// Récupération id de l'utilisateur
$connection = connectDB();
$queryPrepared = $connection->prepare("SELECT id_utilisateur FROM ".DB_PREFIX."UTILISATEUR WHERE email=:email");
$queryPrepared->execute([ "email" => $_SESSION["email"] ]);
$results3 = $queryPrepared->fetch();
$auteur_recette = $results3['id_utilisateur'];


// Vérification nom de la recette
$queryPrepared = $connection->prepare("SELECT * FROM ".DB_PREFIX."RECETTE WHERE nom_recette=:nom_recette");
$queryPrepared->execute([ "nom_recette" => $nom_recette ]);
$results = $queryPrepared->fetch();

if(!empty($results)) {
	$listOfErrorsRecipe[] = "Une autre recette porte déjà ce nom.";
}

// Vérification catégorie
$listCategory = [];
$results2 = $connection->query("SELECT id_categorie FROM ".DB_PREFIX."CATEGORIE");
$results2 = $results2->fetchAll();

foreach ($results2 as $categorie) {
	$listCategory[] = $categorie["id_categorie"];
}

if( !in_array($id_categorie, $listCategory) ) {
	$listOfErrorsRecipe[] = "La catégorie n'existe pas";
}


// Vérification difficulté
$listDifficulty = [0,1,2];
if( !in_array($difficulte, $listDifficulty) ) {
	$listOfErrorsRecipe[] = "Le niveau de difficulté n'existe pas";
}

// Vérification temps de préparation
if(!is_numeric($temps_preparation) || $temps_preparation <= 0) {
	$listOfErrorsRecipe[] = "La durée n'est pas valide.";
}

// Vérification description
if(strlen($description_recette) < 50) {
	$listOfErrorsRecipe[] = "La description doit faire au moins 50 caractères";
}

/* Vérification quantité
foreach($quantite_ingredient as $quantite) {
	if(!is_numeric($quantite) || $quantite <= 0) {
		$listOfErrorsRecipe[] = "Les quantités ne sont pas toutes valides.";
	}
}*/

// Vérification ingrédient
$listIngredient = [];
$results4 = $connection->query("SELECT id_ingredient FROM ".DB_PREFIX."INGREDIENT");
$results4 = $results4->fetchAll();

foreach ($results4 as $ingredient) {
	$listIngredient[] = $ingredient["id_ingredient"];
}

foreach($id_ingredient as $ingredient2) {
	if( !in_array($ingredient2, $listIngredient) ){
		$listOfErrorsRecipe[] = "Ingrédients inexistants. Contactez-nous.";
	}
}

//Si OK
if(empty($listOfErrorsRecipe)) {
	//Insertion en BDD des informations de la recette
	$queryPrepared = $connection->prepare("INSERT INTO ".DB_PREFIX."RECETTE
											(nom_recette, difficulte, temps_preparation, description_recette, auteur_recette)
											VALUES 
											(:nom_recette, :difficulte, :temps_preparation, :description_recette, :auteur_recette)");

	$queryPrepared->execute([
								"nom_recette"=>$nom_recette,
								"difficulte"=>$difficulte,
								"temps_preparation"=>$temps_preparation,
								"description_recette"=>$description_recette,
								"auteur_recette"=>$auteur_recette
							]);

	
	// Insertion en BDD de la catégorie
	$queryPrepared = $connection->prepare("SELECT id_recette FROM ".DB_PREFIX."RECETTE WHERE nom_recette=:nom_recette");
	$queryPrepared->execute(["nom_recette"=>$nom_recette]);
	$results3 = $queryPrepared->fetch();

	$queryPrepared = $connection->prepare("INSERT INTO ".DB_PREFIX."APPARTENIR
											(recette_categorie, categorie)
											VALUES 
											(:recette_categorie, :id_categorie)");

	$queryPrepared->execute([
								"recette_categorie"=>$results3[0],
								"id_categorie"=>$id_categorie
							]);


	// Insertion en BDD des ingrédients
	for ($i = 0; $i < count($quantite_ingredient); $i++) {
		$quantite = $quantite_ingredient[$i];
		$ingredient = $id_ingredient[$i];

		$queryPrepared = $connection->prepare("INSERT INTO ".DB_PREFIX."CONSTITUER
												(ingredient, preparation, quantite_ingredient)
												VALUES 
												(:ingredient, :id_recette, :quantite_ingredient)");

		$queryPrepared->execute([
			":ingredient" => $ingredient,
			":id_recette" => $results3[0],
			"quantite_ingredient" => $quantite
		]);
	}

	// Insertion en BDD de la photo
	$photo_nom = "MAKISINE_recette_".$results3[0].".".$photo_extension;
	if (!move_uploaded_file($photo_temp, $dossier_image.$photo_nom)) {
		exit("Impossible d'enregistrer l'image dans le dossier");
	}

	$queryPrepared = $connection->prepare("UPDATE ".DB_PREFIX."RECETTE SET image_recette=:image_recette WHERE id_recette=:id_recette");

	$queryPrepared->execute([
								"image_recette" => ("pages/recettes/photo_recette/".$photo_nom),
								"id_recette" => $results3[0]
							]);



	$isRecipeCreated = true;
	$_SESSION['isRecipeCreated'] = $isRecipeCreated;

}else{
	$_SESSION['listOfErrorsRecipe'] = $listOfErrorsRecipe;
	$_SESSION['data'] = $_POST;
}

// Redirection backoffice
redirection('../creation-recette');
