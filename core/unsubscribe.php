<?php
session_start();
require "functions.php";
require "../conf.inc.php";
$connexion = connectDB();

$email = $_SESSION['email']; // Récupère l'e-mail de la session
$nonPremium = -1; // Nouvelle valeur pour le champ type_compte (non premium)

$queryPrepared = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET type_compte = :nonPremium WHERE email = :email");

$queryPrepared->bindParam(':nonPremium', $nonPremium, PDO::PARAM_INT); // Lie la valeur de $nonPremium au paramètre :nonPremium
$queryPrepared->bindParam(':email', $email, PDO::PARAM_STR); // Lie la valeur de $email au paramètre :email

$queryPrepared->execute();
echo '<script>window.location.href = "../mon-compte";</script>';