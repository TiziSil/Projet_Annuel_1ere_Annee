<?php
//  session_start();
// require_once 'conf.inc.php';
// require_once 'core/functions.php';
redirectIfNotConnected();

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
    $pwd = $row['pwd'];

}

?>
<div>
  <h1>Modifier mon profil</h1>
</div>
<nav class="nav flex-column">
<a class="nav-link active" href="mon-compte">Retour à mon compte</a>
</nav>
<section class="forum">
    <div class="py-5 d-flex flex-column">
        <div class="container py-5">
            <div class="boite d-flex flex-column">
                <h1>Vos données personnelles</h1>
                <?php if(isset($_SESSION['listoferrorsProfileEdit'])) {?>
                <div class="row mt-3">
                    <div class="col-8 col-sm-6 col-lg-4">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php

                            foreach ($_SESSION['listoferrorsProfileEdit'] as $error)
                            {
                                echo "<li>".$error."</li>";
                            }
                                unset($_SESSION['listoferrorsProfileEdit']);
                        ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php if(isset($_SESSION['successProfileEdit'])) {?>
                <div class="row mt-3">
                    <div class="col-8 col-sm-6 col-lg-4">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php

                            foreach ($_SESSION['successProfileEdit'] as $error)
                            {
                                echo "<li>".$error."</li>";
                            }
                                unset($_SESSION['successProfileEdit']);
                        ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <form method="POST" action = "core/profileEdit.php" class="d-flex flex-column">
                    <div class="d-flex flex-column my-2">
                        <div class="d-flex flex-row">
                            <label class="d-flex col-6">Nom</label>
                            <input type="text" class="form-control" name = "newLastname" placeholder="Nom" value = '<?= $nom;?>'>
                        </div>
                    </div>
                    <div class="d-flex flex-column my-2">
                        <div class="d-flex flex-row">
                            <label class="d-flex col-6">Prénom</label>
                            <input type="text" class="form-control" name = "newFirstName" placeholder="Prénom" value ='<?= $prenom?>'>
                        </div>
                    </div>
                    <div class="d-flex flex-column my-2">
                        <div class="d-flex flex-row">
                            <label class="d-flex col-6">Pseudo</label>
                            <input type="text" class="form-control" name = "newPseudo" placeholder="Pseudo" value ='<?= $pseudo ?>'>
                        </div>
                    </div>
                    <div class="d-flex flex-column my-2">
                        <div class="d-flex flex-row">
                            <label class="d-flex col-6">Email</label>
                            <input type="email" class="form-control" name = "newEmail" placeholder="E-mail" value ='<?= $email ?>'>
                        </div>
                    </div>
                    <div class="d-flex flex-column my-2">
                        <div class="d-flex flex-row">
                            <label class="d-flex col-6">Nouveau mot de passe</label>
                            <input type="password" class="form-control" name = "password" placeholder="Votre mot de passe">
                        </div>
                    </div>
                    <div class="d-flex flex-column my-2">
                        <div class="d-flex flex-row">
                            <label class="d-flex col-6">Nouveau mot de passe</label>
                            <input type="password" class="form-control" name = "newPassword" placeholder="Nouveau mot de passe">
                        </div>
                    </div>
                    <div class="d-flex flex-column my-2">
                        <div class="d-flex flex-row">
                            <label class="d-flex col-6">Confirmation nouveau mot de passe</label>
                            <input type="password" class="form-control" name = "newPasswordConfirm" placeholder="Confirmer le mot de passe">
                        </div>
                    </div>
                    <div class="d-flex flex-column my-2">
                        <div class="d-flex flex-row">
                            <label class="d-flex col-6">Téléphone</label>
                            <input type="text" class="form-control" name = "newTelephone" placeholder="Téléphone"  value ='<?= $telephone?>'>
                        </div>
                    </div>
                    <div class="d-flex flex-column my-2">
                        <div class="d-flex flex-row">
                            <label class="d-flex col-6">Date de naissance</label>
                            <input type="date" class="form-control" name = "newDateNaissance" placeholder="Date de naissance"  value ='<?= $dateNaissance?>'>
                        </div>
                    </div>
                    <div class="d-flex flex-column my-2">
                        <div class="d-flex flex-row">
                            <label class="d-flex col-6">Pays</label>
                            <select id = "pays-inscription" onchange ='listePays()' class="form-control" name = "newPays" placeholder="Pays"  value ='<?= $pays?>'>
                            <option value="fr">France</option>
                            <option value="it">Italie</option>
                            <option value="pt">Portugal</option>
                            <option value="pl">Pologne</option>
                            <option value="es">Espagne</option>
                            <option value="be">Belgique</option>
                            <option value="xx">Autre</option>
                        </select>
                        </div>
                    </div>
                    <div class="d-flex flex-column my-2">
                        <div class="d-flex flex-row">
                            <label class="d-flex col-6">Adresse</label>
                            <input type="text" class="form-control" name = "newAdresse" placeholder="Adresse"  value ='<?=$adresse ?>'>
                        </div>
                    </div>
                    <div class="d-flex flex-column my-2">
                        <div class="d-flex flex-row">
                            <label class="d-flex col-6">Code postal</label>
                            <input type="text" class="form-control" name = "newCodePostal" placeholder="Code postal"  value ='<?=$codePostal ?>'>
                        </div>
                    </div>
                    <div class="d-flex flex-column my-2">
                        <div class="d-flex flex-row">
                            <label class="d-flex col-6">Ville</label>
                            <input type="text" class="form-control" name = "newVille" placeholder="Ville"  value ='<?=$ville?>'>
                        </div>
                    </div>

                    <button type = "submit" class="button3">Mettre à jour</button>
                </form>
            </div>


        </div>
    </div>
    </div>
</section>
