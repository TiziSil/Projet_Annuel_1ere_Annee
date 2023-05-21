<?php
session_start();
require "../conf.inc.php";
require "functions.php";


//supprimer la contrainte de clé étrangère
$connection = $connectDB();
$queryPrepared =$connection -> prepare("DELETE FROM ".DB_PREFIX."AVATAR where idUser = :idUser");) 
//supprimer la ligne de l'utilisateur

