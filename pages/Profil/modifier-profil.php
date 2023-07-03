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

}

//conditions pour modifier le profil
//modification du nom
if(isset($_POST['newLastname']) AND !empty($_POST['newLastname']) AND $_POST['newLastname'] != $nom) {
    $newLastname = htmlspecialchars(cleanLastname($_POST['newLastname']));
    $insertLastname = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET nom_utilisateur = ? WHERE id_utilisateur = ?");
    $insertLastname->execute(array($newLastname, $idUtilisateur));
    echo '<script>window.location.href = "mon-compte";</script>';

}
if (isset($_POST['newFirstName']) AND !empty($_POST['newFirstName']) AND $_POST['newFirstName'] != $prenom) {
    $newFirstName = htmlspecialchars(cleanFirstname($_POST['newFirstName']));
    $insertFirstName = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET prenom_utilisateur = ? WHERE id_utilisateur = ?");
    $insertFirstName->execute(array($newFirstName, $idUtilisateur));
    echo '<script>window.location.href = "mon-compte";</script>';
}
if (isset($_POST['newPseudo']) AND !empty($_POST['newPseudo']) AND $_POST['newPseudo'] != $pseudo) {
    $newPseudo = htmlspecialchars(cleanFirstname($_POST['newPseudo']));
    $insertPseudo = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET pseudo = ? WHERE id_utilisateur = ?");
    $insertPseudo->execute(array($newPseudo, $idUtilisateur));
    echo '<script>window.location.href = "mon-compte";</script>';
}
if (isset($_POST['newEmail']) AND !empty($_POST['newEmail']) AND $_POST['newEmail'] != $email) {
    $newEmail = htmlspecialchars(cleanEmail($_POST['newEmail']));
    $insertEmail = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET email = ? WHERE id_utilisateur = ?");
    $insertEmail->execute(array($newEmail, $idUtilisateur));
    echo '<script>window.location.href = "mon-compte";</script>';
}
if (isset($_POST['newPassword']) AND !empty($_POST['newPassword']) AND isset($_POST['newPasswordConfirm']) AND !empty($_POST['newPasswordConfirm'])) {
    $newPassword = htmlspecialchars($_POST['newPassword']);
    $newPasswordConfirm = htmlspecialchars($_POST['newPasswordConfirm']);
    if ($newPassword == $newPasswordConfirm) {
        $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $insertPassword = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET pwd = ? WHERE id_utilisateur = ?");
        $insertPassword->execute(array($newPassword, $idUtilisateur));
        echo '<script>window.location.href = "mon-compte";</script>';
    } else {
        echo "Les mots de passe ne correspondent pas";
    }
}
if (isset($_POST['newTelephone']) AND !empty($_POST['newTelephone']) AND $_POST['newTelephone'] != $telephone) {
    $newTelephone = htmlspecialchars(cleanPhone($_POST['newTelephone']));
    $insertTelephone = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET telephone = ? WHERE id_utilisateur = ?");
    $insertTelephone->execute(array($newTelephone, $idUtilisateur));
    echo '<script>window.location.href = "mon-compte";</script>';
}
if (isset($_POST['newDateNaissance']) AND !empty($_POST['newDateNaissance']) AND $_POST['newDateNaissance'] != $dateNaissance) {
    $newDateNaissance = htmlspecialchars($_POST['newDateNaissance']);
    $insertDateNaissance = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET date_de_naissance = ? WHERE id_utilisateur = ?");
    $insertDateNaissance->execute(array($newDateNaissance, $idUtilisateur));
    echo '<script>window.location.href = "mon-compte";</script>';
}
if (isset($_POST['newPays']) AND !empty($_POST['newPays']) AND $_POST['newPays'] != $pays) {
    $newPays = htmlspecialchars($_POST['newPays']);
    $insertPays = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET country = ? WHERE id_utilisateur = ?");
    $insertPays->execute(array($newPays, $idUtilisateur));
    echo '<script>window.location.href = "mon-compte";</script>';
}
if (isset($_POST['newAdresse']) AND !empty($_POST['newAdresse']) AND $_POST['newAdresse'] != $adresse) {
    $newAdresse = htmlspecialchars($_POST['newAdresse']);
    $insertAdresse = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET adresse = ? WHERE id_utilisateur = ?");
    $insertAdresse->execute(array($newAdresse, $idUtilisateur));
    echo '<script>window.location.href = "mon-compte";</script>';
}
if (isset($_POST['newCodePostal']) AND !empty($_POST['newCodePostal']) AND $_POST['newCodePostal'] != $codePostal) {
    $newCodePostal = htmlspecialchars($_POST['newCodePostal']);
    $insertCodePostal = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET code_postal = ? WHERE id_utilisateur = ?");
    $insertCodePostal->execute(array($newCodePostal, $idUtilisateur));
    echo '<script>window.location.href = "mon-compte";</script>';
}
if (isset($_POST['newVille']) AND !empty($_POST['newVille']) AND $_POST['newVille'] != $ville) {
    $newVille = htmlspecialchars($_POST['newVille']);
    $insertVille = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET ville = ? WHERE id_utilisateur = ?");
    $insertVille->execute(array($newVille, $idUtilisateur));
    echo '<script>window.location.href = "mon-compte";</script>';
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
                            <label class="d-flex col-6">Téléphone</label>
                            <input type="password" class="form-control" name = "newPassword" placeholder="Mot de passe">
                        </div>
                    </div>
                    <div class="d-flex flex-column my-2">
                        <div class="d-flex flex-row">
                            <label class="d-flex col-6">Date de naissance</label>
                            <input type="password" class="form-control" name = "newPasswordConfirm" placeholder="Confirmer le mot de passe">
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