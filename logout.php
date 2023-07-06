
<?php
session_start();				// On récupère la connexion existante sinon on ne peut pas la supprimer
require "conf.inc.php";   		// On veut deconnecter l'utilisateur
require "core/functions.php";
session_destroy();   			// On veut deconnecter l'utilisateur
session_unset();   				// On veut deconnecter l'utilisateur
unset($_SESSION['email']);  	// On veut deconnecter l'utilisateur
unset($_SESSION['login']);  	// On veut deconnecter l'utilisateur
$_SESSION = array();   			// On veut deconnecter l'utilisateur
redirection('/');   		// On veut deconnecter l'utilisateur