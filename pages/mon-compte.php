<?php
// require 'core/functions.php';
//require "conf.inc.php";
?>
<section class="mon-compte">
    <div class="container">
        <div class="">
            
        </div>
    </div>
</section>
<div>
    <h1>Mon compte</h1>
<nav class="nav flex-column">
<a class="nav-link active" href="modifier-profil">Modifier mon profil</a>
<a class="nav-link" href="#">Mon abonnement</a>
<a class="nav-link" href="#">Mes recettes</a>
</nav>
</div>

<div>
<?php

  // S'il n'y a pas de session alors on ne va pas sur cette page
  if(!isset($_SESSION['id_utilisateur'])){ 
    redirectIfNotConnected(); 
    exit; 
  }
  // On récupère les informations de l'utilisateur connecté
  $connection = connectDB();
  $queryPrepared = $connection -> prepare("SELECT * FROM " . DB_PREFIX . "UTILISATEUR WHERE id_utilisateur = ?");
  $queryPrepared->execute(["email"=>$_SESSION['email']]);
  $results = $queryPrepared->fetch();
  
?>
<h2>Voici le profil de <?= $afficher_profil['nom_utilisateur'] . $afficher_profil['prenom_utilisateur']; ?></h2>
<div>Quelques informations sur vous : </div>
<ul>
    <li>Votre id est : <?= $afficher_profil['id_utilisateur'] ?></li>
    <li>Votre mail est : <?= $afficher_profil['email'] ?></li>
    <li>Votre compte a été crée le : <?= $afficher_profil['date_inserted'] ?>
    </li>
</ul>