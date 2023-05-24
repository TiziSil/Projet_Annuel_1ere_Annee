<?php
session_start();
require "../conf.inc.php";
require "functions.php";


//supprimer la contrainte de clé étrangère
$connection = $connectDB();
$queryPrepared =$connection -> prepare("DELETE FROM ".DB_PREFIX."AVATAR where id_utilisateur = :id_utilisateur");
$queryPrepared -> execute([":id_avatar" => $_SESSION["id_avatar"]]);
//supprimer la ligne de l'utilisateur
$queryPrepared = $connection->prepare("DELETE FROM ".DB_PREFIX."utilisateur WHERE id=:id");
$queryPrepared->execute(["id_utilisateur"=>$_GET['id_utilisateur']]);



header("Location: ../user");

