<?php
session_start();
require "functions.php";
require "../conf.inc.php";
$connexion = connectDB();

$email = $_SESSION['email']; // Récupère l'e-mail de la session
$premium = 1; // Nouvelle valeur pour le champ type_compte

$queryPrepared = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET type_compte = :premium WHERE email = :email");

$queryPrepared->bindParam(':premium', $premium, PDO::PARAM_INT); // Lie la valeur de $premium au paramètre :premium
$queryPrepared->bindParam(':email', $email, PDO::PARAM_STR); // Lie la valeur de $email au paramètre :email

$queryPrepared->execute();
echo '<script>window.location.href = "../mon-compte";</script>';
