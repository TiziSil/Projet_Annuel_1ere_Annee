<?php
require "functions.php";
require "../conf.inc.php";
if ($_GET['id_recette']) {
    $idRecette = $_GET['id_recette'];
    $connection = connectDB();
    $results = $connection->query("SELECT id_recette, nom_recette, difficulte, temps_preparation, description_recette, nom_categorie FROM " . DB_PREFIX .
        "APPARTENIR, " . DB_PREFIX . "CATEGORIE, " . DB_PREFIX . "RECETTE WHERE id_recette = " . $idRecette . " && recette_categorie = id_recette  && categorie = id_categorie");
    $results = $results->fetchAll();

    echo json_encode($results);
}
