<?php
session_start();
require "../conf.inc.php";
require "functions.php";
redirectIfNotConnected();
$userId = $_POST['id'];

//supprimer la contrainte de clé étrangère
$connection = $connectDB();
$queryPrepared =$connection -> prepare("DELETE FROM ".DB_PREFIX."AVATAR where id_utilisateur = $userId");
$queryPrepared -> execute([":id_avatar" => $_SESSION["id_avatar"]]);
//supprimer la ligne de l'utilisateur
$queryPrepared = $connection->prepare("DELETE FROM ".DB_PREFIX."utilisateur WHERE id_ustilisateur= $userId");
$queryPrepared->execute(["id_utilisateur"=>$_GET['id_utilisateur']]);



header("Location: ../");

