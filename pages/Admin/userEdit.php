<?php
redirectIfNotConnected();
redirectIfNotAdmin();
logUserAcitivty("../../log.txt");
$connexion = connectDB();
if(isset($_POST['id']) && isset($_POST['id'])  ){
    // On récupère l'id de l'utilisateur
    $userId = $_POST['id'];
    $queryPrepared = $connexion->prepare("SELECT * FROM " . DB_PREFIX . "UTILISATEUR WHERE id_utilisateur = :id ");

    $queryPrepared->execute([
        'id' => $userId
    ]);
    $results = $queryPrepared->fetchAll(PDO::FETCH_ASSOC); // Affiche les résultats sous forme de tableau associatif
}elseif (empty($_POST)) {
    $userId = $_SESSION['userId'];
    $queryPrepared = $connexion->prepare("SELECT * FROM " . DB_PREFIX . "UTILISATEUR WHERE id_utilisateur = :id ");

    $queryPrepared->execute([
        'id' => $userId
    ]);
    $results = $queryPrepared->fetchAll(PDO::FETCH_ASSOC); // Affiche les résultats sous forme de tableau associatif
}
$_SESSION['userId'] = $userId;

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
<div>
  <h1>Modifier le profil de <?= $prenom ." " .$nom?></h1>
</div>


<nav class="nav flex-column">
<a class="nav-link active" href="user">Retour à la liste des utilisateurs</a>
</nav>
<section class="forum">
    <div class="py-5 d-flex flex-column">
        <div class="container py-5">
            <div class="boite d-flex flex-column">
                <h1>Données personnelles</h1>
                <div>
                    
                </div>
                <?php if(isset($_SESSION['listoferrorsUsersEdit'])) {?>
                <div class="row mt-3">
                    <div class="col-8 col-sm-6 col-lg-4">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php

                            foreach ($_SESSION['listoferrorsUsersEdit'] as $error)
                            {
                                echo "<li>".$error."</li>";
                            }
                                unset($_SESSION['listoferrorsUsersEdit']);
                        ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php if(isset($_SESSION['successUsersEdit'])) {?>
                <div class="row mt-3">
                    <div class="col-8 col-sm-6 col-lg-4">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php

                            foreach ($_SESSION['successUsersEdit'] as $error)
                            {
                                echo "<li>".$error."</li>";
                            }
                                unset($_SESSION['successUsersEdit']);
                        ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <form method="POST" action = "core/userListEdit.php" class="d-flex flex-column">
                <div class="d-flex flex-column my-2">
                        <div class="d-flex flex-row">
                            <label class="d-flex col-6">id</label>
                            <input type="text" class="form-control" name = "id" value = "<?= $idUtilisateur ?>" readonly>
                        </div>
                    </div>                    
                
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
                            <label class="d-flex col-6">Adresse postale</label>
                            <input type="text" class="form-control" name = "newTelephone" placeholder="Téléphone"  value ='<?= $telephone?>'>
                        </div>
                    </div>
                    <div class="d-flex flex-column my-2">
                        <div class="d-flex flex-row">
                            <label class="d-flex col-6">Code postal</label>
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
                            <label class="d-flex col-6">Points de fidélité</label>
                            <input type="number" class="form-control" name = "newPointsFidelite" placeholder="Points de fidélité"  value ='<?= $pointsFidelite?>'>
                        </div>
                    </div>
                    <div class="d-flex flex-column my-2">
                        <div class="d-flex flex-row">
                            <label class="d-flex col-6 align-items-center">Rôle<small class = "text-muted">&nbsp 1 si admin, -1 sinon</small></label>
                            
                            <input type="number" class="form-control" name = "newRole" placeholder="1 Si admin 0 sinon"  value ='<?= $role?>'>
                        </div>
                    </div>
                    <div class="d-flex flex-column my-2">
                        <div class="d-flex flex-row">
                        <label class="d-flex col-6 align-items-center">Statut<small class = "text-muted">&nbsp 1 si Actif, -1 inactif, 2 banni</small></label>
                            <input type="number" class="form-control" name = "newStatut" placeholder="1 = Actif 0 sinon"  value ='<?= $statut?>'>
                        </div>
                    </div>
                    <div class="d-flex flex-column my-2">
                        <div class="d-flex flex-row">
                        <label class="d-flex col-6 align-items-center">Type de compte<small class = "text-muted">&nbsp -1 si normal, 1 si premium</small></label>
                            <input type="number" class="form-control" name = "newTypeCompte" placeholder="premium = 1 sinon 0"  value ='<?= $typeCompte?>'>
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
<?php   
?>