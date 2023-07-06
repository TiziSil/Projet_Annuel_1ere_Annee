<?php
require "functions.php";
require "../conf.inc.php";
if ($_GET['id_recette']) {
    $idRecette = $_GET['id_recette'];
    $connection = connectDB();
    $queryPrepared = $connection->prepare("SELECT quantite_ingredient, nom_ingredient, id_recette FROM " . DB_PREFIX ."CONSTITUER, " . DB_PREFIX . "INGREDIENT, " .
                                 DB_PREFIX . "RECETTE WHERE preparation = id_recette && id_ingredient = ingredient && preparation=:idRecette"); 
    $queryPrepared -> execute([ "idRecette" => $idRecette]);
    $results = $queryPrepared->fetchAll();

    echo json_encode($results);
}