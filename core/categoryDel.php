<?php
session_start();
require "../conf.inc.php";
require "functions.php";
// redirectIfNotConnected(); 

// Vérification si tous les champs sont remplis
if( count($_POST)!=1 
    || empty($_POST['id_categorieDel'])
){
    die ("ERREUR - La saisie est incorrecte.");
}

$id_categorieDel = $_POST['id_categorieDel'];
$listOfErrorsCategoryDel = [];
$isCategoryDeleted = false;

// Vérification catégorie
$listCategory = [];

$connection = connectDB();
$results2 = $connection->query("SELECT id_categorie FROM ".DB_PREFIX."CATEGORIE WHERE id_categorie NOT IN 
(SELECT categorie FROM ".DB_PREFIX."APPARTENIR)");
$results2 = $results2->fetchAll();

foreach ($results2 as $categorie) {
	$listCategory[] = $categorie["id_categorie"];
}

if( !in_array($id_categorieDel, $listCategory) ){
	$listOfErrorsCategoryDel[] = "Aucune catégorie selectionnée";
}

// Si tout est bon, supression en BDD
if(empty($listOfErrorsCategoryDel)){
    $queryPrepared = $connection->prepare("DELETE FROM ".DB_PREFIX."CATEGORIE WHERE id_categorie=:id_categorie");
    $queryPrepared->execute(["id_categorie"=>$id_categorieDel]);

    $isCategoryDeleted = true;
    $_SESSION['isCategoryDeleted'] = $isCategoryDeleted;

}else{
	$_SESSION['listOfErrorsCategoryDel'] = $listOfErrorsCategoryDel;
}

// Redirection backoffice
redirection('../backoffice');