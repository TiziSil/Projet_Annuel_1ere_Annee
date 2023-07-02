<?php
session_start();
require "../conf.inc.php";
require "functions.php";    

//On va vérifier que l'on a quelque chose dans $_POST
//Ce qui signifie que le formulaire a été validé
if (!empty($_POST['email']) &&  !empty($_POST['pwd'])) {

    $email = cleanEmail($_POST["email"]);
    $pwd = $_POST["pwd"];

    //Récupérer en bdd le mot de passe hashé pour l'email
    //provenant du formulaire
    $connect = connectDB();
    $queryPrepared = $connect->prepare("SELECT pwd FROM " . DB_PREFIX . "UTILISATEUR WHERE email=:email");
    $queryPrepared->execute(["email" => $email]);
    $results = $queryPrepared->fetch();

    if(!empty($results) && password_verify($pwd, $results["pwd"]) ){
        $_SESSION['email'] = $email;
        $_SESSION['login'] = true;
        header("Location: ../mon-compte"); // On redirige vers la page "Mon compte"
    }else{
        echo "Identifiants incorrects";
    }
}

