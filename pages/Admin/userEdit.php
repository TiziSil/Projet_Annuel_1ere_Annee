<?php
redirectIfNotConnected();
redirectIfNotAdmin();

$connexion = connectDB();
if(isset($_POST['id']) AND isset($_POST['id'])){
    // On récupère l'id de l'utilisateur
    $userId = $_POST['id'];
    $queryPrepared = $connexion->prepare("SELECT * FROM " . DB_PREFIX . "UTILISATEUR WHERE id_utilisateur = :id ");
    $queryPrepared->bindParam(':id', $userId); // Lie la valeur de $userId au paramètre :id
    $queryPrepared->execute();
    $results = $queryPrepared->fetchAll(PDO::FETCH_ASSOC); // Affiche les résultats sous forme de tableau associatif
}

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

//conditions pour modifier le profil
//modification du nom
if(isset($_POST['newLastname']) AND !empty($_POST['newLastname'])) {
    $newLastname = htmlspecialchars(cleanLastname($_POST['newLastname']));
    if ($newLastname != $nom){
        $insertLastname = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET nom_utilisateur = ? WHERE id_utilisateur = ?");
        $insertLastname->execute(array($newLastname, $idUtilisateur));
        //echo '<script>window.location.href = "user";</script>';
    }if ($newLastname == $nom){
        //si aucun changement n'a été fait
        echo '<div class="alert alert-primary" role="alert">
        <p>Aucun changement apporté</p>
        </div>';
        echo '<script>window.location.href = "userEdit";</script>';
}
// }else {
//     //si newLastname n'est pas défini ou vide
//     echo '<div class="alert alert-danger" role="alert">
//         <p>Le nom n\'est pas valide</p>
//         </div>
//         <script>window.location.href = "userEdit";</script>';
}


if (isset($_POST['newFirstName']) AND !empty($_POST['newFirstName']) AND $_POST['newFirstName'] != $prenom) {
    $newFirstName = htmlspecialchars(cleanFirstname($_POST['newFirstName']));
    $insertFirstName = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET prenom_utilisateur = ? WHERE id_utilisateur = ?");
    $insertFirstName->execute(array($newFirstName, $idUtilisateur));
    // echo '<script>window.location.href = "user";</script>';
}
if (isset($_POST['newPseudo']) AND !empty($_POST['newPseudo']) AND $_POST['newPseudo'] != $pseudo) {
    $newPseudo = htmlspecialchars(cleanFirstname($_POST['newPseudo']));
    $insertPseudo = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET pseudo = ? WHERE id_utilisateur = ?");
    $insertPseudo->execute(array($newPseudo, $idUtilisateur));
    // echo '<script>window.location.href = "user";</script>';
}
if (isset($_POST['newEmail']) AND !empty($_POST['newEmail']) AND $_POST['newEmail'] != $email) {
    $newEmail = htmlspecialchars(cleanEmail($_POST['newEmail']));
    $insertEmail = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET email = ? WHERE id_utilisateur = ?");
    $insertEmail->execute(array($newEmail, $idUtilisateur));
    // echo '<script>window.location.href = "user";</script>';
}

if (isset($_POST['newTelephone']) AND !empty($_POST['newTelephone']) AND $_POST['newTelephone'] != $telephone) {
    $newTelephone = htmlspecialchars(cleanPhone($_POST['newTelephone']));
    $insertTelephone = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET telephone = ? WHERE id_utilisateur = ?");
    $insertTelephone->execute(array($newTelephone, $idUtilisateur));
    // echo '<script>window.location.href = "user";</script>';
}
 if (isset($_POST['newDateNaissance']) AND !empty($_POST['newDateNaissance']) AND $_POST['newDateNaissance'] != $dateNaissance) {
    $newDateNaissance = htmlspecialchars($_POST['newDateNaissance']);
    $insertDateNaissance = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET date_de_naissance = ? WHERE id_utilisateur = ?");
    $insertDateNaissance->execute(array($newDateNaissance, $idUtilisateur));
    // echo '<script>window.location.href = "user";</script>';
}


if (isset($_POST['point_utilisateur']) AND !empty($_POST['point_utilisateur']) AND $_POST['point_utilisateur'] != $pointsFidelite) {
    $newPointsFidelite = htmlspecialchars($_POST['point_utilisateur']);
    $insertPointsFidelite = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET point_utilisateur = ? WHERE id_utilisateur = ?");
    $insertPointsFidelite->execute(array($newPointsFidelite, $idUtilisateur));
    // echo '<script>window.location.href = "user";</script>';
}

if (isset($_POST['role_utilisateur']) AND !empty($_POST['role_utilisateur']) AND $_POST['role_utilisateur'] != $role) {
    $newRole = htmlspecialchars($_POST['role_utilisateur']);
    $insertRole = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET role_utilisateur = ? WHERE id_utilisateur = ?");
    $insertRole->execute(array($newRole, $idUtilisateur));
    // echo '<script>window.location.href = "user";</script>';
}

if (isset($_POST['type_compte']) AND !empty($_POST['type_compte']) AND $_POST['type_compte'] != $typeCompte) {
    $newTypeCompte = htmlspecialchars($_POST['type_compte']);
    $insertTypeCompte = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET type_compte = ? WHERE id_utilisateur = ?");
    $insertTypeCompte->execute(array($newTypeCompte, $idUtilisateur));
    // echo '<script>window.location.href = "user";</script>';
}

if (isset($_POST['statut']) AND !empty($_POST['statut']) AND $_POST['statut'] != $statut) {
    $newStatut = htmlspecialchars($_POST['statut']);
    $insertStatut = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET statut = ? WHERE id_utilisateur = ?");
    $insertStatut->execute(array($newStatut, $idUtilisateur));
    // echo '<script>window.location.href = "user";</script>';
}
if (isset($_POST['newPays']) AND !empty($_POST['newPays']) AND $_POST['newPays'] != $pays) {
    $newPays = htmlspecialchars($_POST['newPays']);
    $insertPays = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET country = ? WHERE id_utilisateur = ?");
    $insertPays->execute(array($newPays, $idUtilisateur));
    // echo '<script>window.location.href = "user";</script>';
}
if (isset($_POST['newAdresse']) AND !empty($_POST['newAdresse']) AND $_POST['newAdresse'] != $adresse) {
    $newAdresse = htmlspecialchars($_POST['newAdresse']);
    $insertAdresse = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET adresse = ? WHERE id_utilisateur = ?");
    $insertAdresse->execute(array($newAdresse, $idUtilisateur));
    // echo '<script>window.location.href = "user";</script>';
}
if (isset($_POST['newCodePostal']) AND !empty($_POST['newCodePostal']) AND $_POST['newCodePostal'] != $codePostal) {
    $newCodePostal = htmlspecialchars($_POST['newCodePostal']);
    $insertCodePostal = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET code_postal = ? WHERE id_utilisateur = ?");
    $insertCodePostal->execute(array($newCodePostal, $idUtilisateur));
    // echo '<script>window.location.href = "user";</script>';
}
if (isset($_POST['newVille']) AND !empty($_POST['newVille']) AND $_POST['newVille'] != $ville) {
    $newVille = htmlspecialchars($_POST['newVille']);
    $insertVille = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET ville = ? WHERE id_utilisateur = ?");
    $insertVille->execute(array($newVille, $idUtilisateur));
    // echo '<script>window.location.href = "user";</script>';
}


?>
<div>
  <h1>Modifier le profil de <?= $prenom ." " .$nom?></h1>
</div>

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
                <form method="POST" class="d-flex flex-column">
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
                            <label class="d-flex col-6">Nom</label>
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
                            <option value="fr" <?= (!empty($_SESSION["data"]) && $_SESSION["data"]["country"] == "fr") ? "selected" : ""; ?>>France</option>
                            <option value="it" <?= (!empty($_SESSION["data"]) && $_SESSION["data"]["country"] == "it") ? "selected" : ""; ?>>Italie</option>
                            <option value="pt" <?= (!empty($_SESSION["data"]) && $_SESSION["data"]["country"] == "pt") ? "selected" : ""; ?>>Portugal</option>
                            <option value="pl" <?= (!empty($_SESSION["data"]) && $_SESSION["data"]["country"] == "pl") ? "selected" : ""; ?>>Pologne</option>
                            <option value="es" <?= (!empty($_SESSION["data"]) && $_SESSION["data"]["country"] == "es") ? "selected" : ""; ?>>Espagne</option>
                            <option value="be" <?= (!empty($_SESSION["data"]) && $_SESSION["data"]["country"] == "be") ? "selected" : ""; ?>>Belgique</option>
                            <option value="xx" <?= (!empty($_SESSION["data"]) && $_SESSION["data"]["country"] == "xx") ? "selected" : ""; ?>>Autre</option>
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
                            <label class="d-flex col-6">Rôle</label>
                            <input type="number" class="form-control" name = "newRole" placeholder="1 Si admin 0 sinon"  value ='<?= $role?>'>
                        </div>
                    </div>
                    <div class="d-flex flex-column my-2">
                        <div class="d-flex flex-row">
                            <label class="d-flex col-6">Statut</label>
                            <input type="number" class="form-control" name = "newStatut" placeholder="1 = Actif 0 sinon"  value ='<?= $statut?>'>
                        </div>
                    </div>
                    <div class="d-flex flex-column my-2">
                        <div class="d-flex flex-row">
                            <label class="d-flex col-6">Type de Compte</label>
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
$_SESSION['data']= $_POST;   
?>