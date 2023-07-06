<?php
session_start();
require_once '../conf.inc.php';
require_once 'functions.php';
//On va vérifier que l'on a quelque chose dans $_POST
//Ce qui signifie que le formulaire a été validé
if (isset($_POST['email']) &&  isset($_POST['pwd'])) {
    $email = cleanEmail($_POST["email"]);
    $pwd = $_POST["pwd"];

    //Récupérer en bdd le mot de passe hashé pour l'email
    //provenant du formulaire
    $connect = connectDB();
    $queryPrepared = $connect->prepare("SELECT id_utilisateur, pseudo, pwd, statut FROM " . DB_PREFIX . "UTILISATEUR WHERE email=:email");
    $queryPrepared->execute(["email" => $email]);
    $results = $queryPrepared->fetch();

    if(!empty($results) && password_verify($pwd, $results["pwd"]) ){
        if ($results['statut'] == 2) {
            echo '<script>window.location.href = "../banni.php";</script>';
            exit();
        }
        $_SESSION['email'] = $email;
        $_SESSION['id_utilisateur'] = $results['id_utilisateur'];
        $_SESSION['pseudo'] = $results['pseudo'];
        $_SESSION['login'] = true;
        echo '<script>window.location.href = "../index.php";</script>';
    }else{
        echo '<script>window.location.href = "../erreur.php";</script>';
    }

    }
?>