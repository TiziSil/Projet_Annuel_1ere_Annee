<?php
session_start();
require "../conf.inc.php";
require "functions.php";
// redirectIfNotConnected(); 

// Vérification si tous les champs sont remplis
if( count($_POST)!=1 
    || empty($_POST['id_ingredientDel'])
){
    die ("ERREUR - La saisie est incorrecte.");
}

$id_ingredientDel = $_POST['id_ingredientDel'];
$listOfErrorsIngredientDel = [];
$isIngredientDeleted = false;

// Vérification ingrédient
$listIngredient = [];

$connection = connectDB();
$results2 = $connection->query("SELECT id_ingredient FROM ".DB_PREFIX."INGREDIENT WHERE id_ingredient NOT IN 
(SELECT ingredient FROM ".DB_PREFIX."CONSTITUER)");
$results2 = $results2->fetchAll();

foreach ($results2 as $ingredient) {
	$listIngredient[] = $ingredient["id_ingredient"];
}

if( !in_array($id_ingredientDel, $listIngredient) ){
	$listOfErrorsIngredientDel[] = "Aucun ingrédient selectionné";
}

// Si tout est bon, supression en BDD
if(empty($listOfErrorsIngredientDel)){

    $queryPrepared = $connection->prepare("DELETE FROM ".DB_PREFIX."CONTENIR WHERE produit=:id_ingredient");
    $queryPrepared->execute(["id_ingredient"=>$id_ingredientDel]);

    $queryPrepared = $connection->prepare("DELETE FROM ".DB_PREFIX."INGREDIENT WHERE id_ingredient=:id_ingredient");
    $queryPrepared->execute(["id_ingredient"=>$id_ingredientDel]);

    $isIngredientDeleted = true;
    $_SESSION['isIngredientDeleted'] = $isIngredientDeleted;

}else{
	$_SESSION['listOfErrorsIngredientDel'] = $listOfErrorsIngredientDel;
}

// Redirection backoffice
redirection('../backoffice');