<?php

// require 'core/functions.php';
//require "conf.inc.php";
redirectIfNotConnected();


// S'il n'y a pas de session alors on ne va pas sur cette page
// On récupère les informations de l'utilisateur connecté

$connexion = connectDB();
$queryPrepared = $connexion->prepare("SELECT * FROM " . DB_PREFIX . "UTILISATEUR WHERE email = :email ");

$email = $_SESSION['email']; // Récupère l'e-mail de la session

$queryPrepared->bindParam(':email', $email); // Lie la valeur de $email au paramètre :email

$queryPrepared->execute();
$results = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
  // Affiche les résultats
foreach ($results as $row) {
    // Accédez aux colonnes par leur nom
    $idUtilisateur = $row['id_utilisateur'];
    $nom = $row['nom_utilisateur'];
    $prenom = $row['prenom_utilisateur'];
    $pseudo = $row['pseudo'];
    $email = $row['email'];
    $telephone = $row['telephone'];
    $dateNaissance = $row['date_de_naissance'];
    $pointsFidelite = $row['point_utilisateur'];
    $role = $row['role_utilisateur'];
    $typeCompte = $row['type_compte'];
    $statut = $row['statut'];
    $dateInserted = $row['date_inserted'];
    $dateUpdated = $row['date_updated'];
    $pays = $row['country'];
    $adresse = $row['adresse'];
    $codePostal = $row['code_postal'];
    $ville = $row['ville'];
}
?>


<section class="mon-compte">
    <div class="container">
        <div class="">
            <h1>Bienvenue <?= $pseudo?> !</h1>
        </div>
    </div>
</section>
<div>
    <h1>Mon compte</h1>
<nav class="nav flex-column">
<a class="nav-link active" href="modifier-profil">Modifier mon profil</a>
<a class="nav-link" href="mon-abonnement">Mon abonnement</a>
<a class="nav-link" href="#">Mes recettes</a>
<?php
if ($role == 1){

    echo '<a class="nav-link" href="backoffice">Mon espace administrateur</a>';
    echo '<a class="nav-link" href="user">Liste des utilisateurs</a>';
    echo '<a class="nav-link" href="attente-validation">Valider des recettes</a>';
}
?>
</nav>
</div>

<div>