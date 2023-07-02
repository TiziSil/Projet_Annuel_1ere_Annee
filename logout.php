
<?php
session_start();
require "conf.inc.php";   				// On veut deconnecter l'utilisateur
session_destroy();   				// On veut deconnecter l'utilisateur
session_unset();   				// On veut deconnecter l'utilisateur
unset($_SESSION['email']);   				// On veut deconnecter l'utilisateur
unset($_SESSION['login']);   				// On veut deconnecter l'utilisateur
$_SESSION = array();   				// On veut deconnecter l'utilisateur
header("Location: .");   				// On veut deconnecter l'utilisateur