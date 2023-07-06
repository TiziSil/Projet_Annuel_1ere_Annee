<?php
session_start();
require "../conf.inc.php";
require "functions.php";
// redirectIfNotConnected(); 

  $connection = connectDB();
  $queryPrepared = $connection->prepare("UPDATE ".DB_PREFIX."RECETTE SET statut_publication = 1 WHERE id_recette=:id_recette");
  $queryPrepared->execute(["id_recette"=>$_GET['id_recette']]);

  redirection('../attente-validation');