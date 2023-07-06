@@ -1,94 +1,94 @@
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
    <div class="py-5 d-flex flex-column">
        <div class="container py-5">
            <div class="search-bar">
                <h1 class="h1-moncompte">Bienvenue
                    <?= $pseudo ?> !
                </h1>
                <form id="" class="d-flex row">
                    <div class="col-10 input-form-mon-compte d-flex">
                        <svg width="16px" height="16px">
                            <image height="16px" fill="#DEC7B1" width="16px" href="./assets/images/loupe.svg" />
                        </svg>
                        <input class="input-form-mon-compte" placeholder="Recherchez votre recette" required
                            type="text">
                    </div>
                    <button class="button2  col-2">Recherchez</button>
                </form>
            </div>

            <div class="container py-4"></div>


        </div>
    </div>
</section>

<section class="section-radis" class="col">
    <img src="assets/images/separateur.png" class="separateur-de-texte-contact">
</section>


<section class="partie-selection">
    <div class="container py-5">
        <div class="py-5 my-5">
            <div class="boite my-5">
                <h1>Mon compte</h1>
                <div class="d-flex flex-row justify-content-between">
                    <a class="flex-fill button3 btnmoncompte mx-1" href="./modifier-profil">Modifier mon profil</a>
                    <a class="flex-fill button3 btnmoncompte mx-1" href="./mon-abonnement">Mon abonnement</a>
                    <a class="flex-fill button3 btnmoncompte mx-1" href="./creation-recette">Créer des recettes</a>
                    <a class="flex-fill button3 btnmoncompte mx-1" href="./core/exportPdf.php">Exporter mes données</a>
<?php if ($role == 1) { ?>
                        <a class="flex-fill button3 mx-1" href="./user">Liste des utilisateurs</a>
                        <a class="flex-fill button3 mx-1" href="./attente-validation">Valider des recettes</a>
                        <a class="flex-fill button3 btnmoncompte mx-1" href="./user">Liste des utilisateurs</a>
                        <a class="flex-fill button3 btnmoncompte mx-1" href="./attente-validation">Valider des recettes</a>
                        <a class="flex-fill button3 btnmoncompte mx-1" href="./backoffice">Gestion des recettes et autres éléments</a>
                        <a class="flex-fill button3 btnmoncompte mx-1" href="./core/inactivityAlert.php">Envoyer un mail aux utilisateurs inactifs</a>
                        <a class="flex-fill button3 btnmoncompte mx-1" href="./core/extractlogtopdf.php">Extraire les log de connexion</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
