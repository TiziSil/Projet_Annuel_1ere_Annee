<?php
    session_start();
    require "../conf.inc.php";
    require "functions.php";
    // redirectIfNotConnected(); 

    $connection = connectDB();
    $queryPrepared = $connection->prepare("DELETE FROM ".DB_PREFIX."APPARTENIR WHERE recette_categorie=:recette_categorie");
    $queryPrepared->execute(["recette_categorie"=>$_GET['id_recette']]);

    $queryPrepared = $connection->prepare("DELETE FROM ".DB_PREFIX."RECETTE WHERE id_recette=:id_recette");
    $queryPrepared->execute(["id_recette"=>$_GET['id_recette']]);

    header('location:../attente-validation');