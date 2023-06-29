<?php
//  session_start();
// require_once 'conf.inc.php';
// require_once 'core/functions.php';
redirectIfNotConnected();

$connection = connectDB();
  // S'il n'y a pas de session alors on ne va pas sur cette page
  if(!isset($_SESSION['id'])){ 
    redirectIfNotConnected(); 
    exit; 
  }
  // On récupère les informations de l'utilisateur connecté
  $afficher_profil = $DB->query("SELECT * 
    FROM utilisateur 
    WHERE id = ?", 
  array($_SESSION['id']));
  
  $afficher_profil = $afficher_profil->fetch(); 
?>

<div>
    <form action = "../core/modif-profil" method = "POST">
        <input type="text" class="form-control" placeholder="Nom">

        <input type="text" class="form-control" placeholder="Prénom">
        <input type="text" class="form-control" placeholder="Email">
        <input type="text" class="form-control" placeholder="Mot de passe">
        <input type="text" class="form-control" placeholder="Confirmer le mot de passe">
        <input type="text" class="form-control" placeholder="Adresse">
        <input type="text" class="form-control" placeholder="Code postal">
        <input type="text" class="form-control" placeholder="Ville">
        <input type="text" class="form-control" placeholder="Pays">
        <input type="text" class="form-control" placeholder="Téléphone">
        <input type="text" class="form-control" placeholder="Date de naissance">
    </form>
</div>