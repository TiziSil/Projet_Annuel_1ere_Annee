<?php
session_start();
require "../conf.inc.php";
require 'functions.php';


$connexion = connectDB();
$queryPrepared = $connexion->prepare("SELECT * FROM " . DB_PREFIX . "UTILISATEUR WHERE email=:email");
$queryPrepared->execute([
    "email" => $_SESSION["email"]
]);
$row = $queryPrepared->fetch();
echo'<pre>';
var_dump($row);
echo'</pre>';
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
$pointsFidelite = $row['point_utilisateur'];
$role = $row['role_utilisateur'];
$typeCompte = $row['type_compte'];
$statut = $row['statut'];


//recupérations des données du formulaire
$newLastname = htmlspecialchars(cleanLastname($_POST['newLastname']));
$newFirstName = htmlspecialchars(cleanFirstname($_POST['newFirstName']));
$newPseudo =htmlspecialchars($_POST['newPseudo']);
$newEmail = htmlspecialchars(cleanEmail($_POST['newEmail']));
$newTelephone = htmlspecialchars(cleanPhone($_POST['newTelephone']));
$newDateNaissance = htmlspecialchars($_POST['newDateNaissance']);
$newPays = htmlspecialchars($_POST['newPays']);
$newAdresse = htmlspecialchars($_POST['newAdresse']);
$newCodePostal = htmlspecialchars($_POST['newCodePostal']);
$newVille = htmlspecialchars(cleanFirstname($_POST['newVille']));
$oldPwd = $_POST['password'];
$newPwd = $_POST['newPassword'];
$newPwd2 = $_POST['newPasswordConfirm'];


//vérification des données du formulaire
// Vérification des données du formulaire
if (
    ($newLastname == $nom)
    && ($newFirstName == $prenom)
    && ($newPseudo == $pseudo)
    && ($newEmail == $email)
    && ($newTelephone == $telephone)
    && ($newDateNaissance == $dateNaissance)
    && ($newPays == $pays)
    && ($newAdresse == $adresse)
    && ($newCodePostal == $codePostal)
    && ($newVille == $ville)
    
    && (
        (empty($newPwd) && empty($newPwd2))
        || (!empty($newPwd) && !empty($newPwd2) && $newPwd != $newPwd2)
    )
) {
    $listOfErrorsProfileEdit[] = "Vous n'avez rien modifié";
}

if (isset($newLastname) && !empty($newLastname) && $newLastname != $nom) {
    if(strlen($newLastname) < 2){
        $listOfErrorsProfileEdit[] = "Le nom doit faire plus de 2 caractères";
    }else{
        
        $queryPrepared = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET nom_utilisateur=:nom WHERE id_utilisateur=:id");
        $queryPrepared->execute([
            "nom" => $newLastname,
            "id" => $idUtilisateur
        ]);
        $nom = $newLastname;
        $successProfileEdit[] = "Votre nom a bien été modifié";
    }

}
if (isset($newFirstName) && !empty($newFirstName) && $newFirstName != $prenom) {
    if(strlen($newFirstName) < 2){
        $listOfErrorsProfileEdit[] = "Le prénom doit faire plus de 2 caractères";
    }else{
        $queryPrepared = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET prenom_utilisateur=:prenom WHERE id_utilisateur=:id");
        $queryPrepared->execute([
            "prenom" => $newFirstName,
            "id" => $idUtilisateur
        ]);
        $prenom = $newFirstName;
        $successProfileEdit[] = "Votre prénom a bien été modifié";
    }

}
if (isset($newPseudo) && !empty($newPseudo) && $newPseudo != $pseudo) {
    $pseudoPrepared = $connexion->prepare("SELECT pseudo FROM " . DB_PREFIX . "UTILISATEUR WHERE pseudo = :newPseudo");
    $pseudoPrepared->execute(["newPseudo" => $newPseudo]);
    $count = $pseudoPrepared->rowCount();
    if ($count > 0) {
        $listOfErrorsProfileEdit[] = "Le pseudo est déjà utilisé";
    }else{
        $queryPrepared = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET pseudo=:pseudo WHERE id_utilisateur=:id");
        $queryPrepared->execute([
            "pseudo" => $newPseudo,
            "id" => $idUtilisateur
        ]);
        $pseudo = $newPseudo;
        $successProfileEdit[] = "Votre pseudo a bien été modifié";
    }

}
if (isset($newEmail) && !empty($newEmail) && $newEmail != $email) {
    if(!filter_var($newEmail, FILTER_VALIDATE_EMAIL)){
        $listOfErrorsUsersEdit[] = "L'email est incorrect";
    }
    $emailPrepared = $connexion ->prepare("SELECT * FROM ".DB_PREFIX."UTILISATEUR WHERE email = :email");
    
    $emailPrepared-> execute([ "email" => $newEmail ]);
    $results = $emailPrepared -> fetch();
    if (!empty($results)){
        $listOfErrorsProfileEdit[] = "L'email est déjà utilisé";
    }else{
        $queryPrepared = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET email=:email WHERE id_utilisateur=:id");
        $queryPrepared->execute([
            "email" => $newEmail,
            "id" => $idUtilisateur
        ]);
        $email = $newEmail;
        $successProfileEdit[] = "L'email a bien été modifié";
    }

}
if (isset($newTelephone) && !empty($newTelephone) && $newTelephone != $telephone) {
    $queryPrepared = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET telephone=:telephone WHERE id_utilisateur=:id");
    $queryPrepared->execute([
        "telephone" => $newTelephone,
        "id" => $idUtilisateur
    ]);
    $telephone = $newTelephone;
    $successProfileEdit[] = "Votre numéro de téléphone a bien été modifié";

}
$birthdayExploded = explode("-", $newDateNaissance);
if (isset($newDateNaissance) && !empty($newDateNaissance) && $newDateNaissance != $dateNaissance) {
    if (!checkdate($birthdayExploded[1],$birthdayExploded[2],$birthdayExploded[0])){
        $listOfErrorsProfileEdit[] = "Date de naissance incorrecte";
    }else{
        //Vérification de l'age
        $todaySecond = time();
        $birthdaySecond = strtotime($newDateNaissance);
        $ageSecond = $todaySecond - $birthdaySecond;
        $age = $ageSecond/60/60/24/365.25;
        if( $age <= 6 || $age >= 99 ){
            $listOfErrorsProfileEdit[] = "Vous n'avez pas l'âge requis (entre 6 et 99 ans)";
        } else{
            $queryPrepared = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET date_de_naissance=:dateNaissance WHERE id_utilisateur=:id");
            $queryPrepared->execute([
                "dateNaissance" => $newDateNaissance,
                "id" => $idUtilisateur
            ]);
            $dateNaissance = $newDateNaissance;
            $successProfileEdit[] = "La date de naissance a bien été modifié";
        }
    }

}
if (isset($newPays) && !empty($newPays) && $newPays != $pays) {
    // Vérification de cohérence des valeurs pour le champ "pays"
    $listCountries = ["fr", "it", "pt", "pl", "es", "be", "ch", "xx"];
    if (!in_array($newPays, $listCountries)) {
        $listOfErrorsProfileEdit[] = "Le pays n'existe pas";
    } else {
        $queryPrepared = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET country=:pays WHERE id_utilisateur=:id");
        $queryPrepared->execute([
            "pays" => $newPays,
            "id" => $idUtilisateur
        ]);
        $pays = $newPays;
        $successProfileEdit[] = "Le pays a bien été modifié";
    }
}
if (isset($newAdresse) && !empty($newAdresse) && $newAdresse != $adresse) {
    $queryPrepared = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET adresse=:adresse WHERE id_utilisateur=:id");
    $queryPrepared->execute([
        "adresse" => $newAdresse,
        "id" => $idUtilisateur
    ]);
    $adresse = $newAdresse;
    $successProfileEdit[] = "Votre adresse a bien été modifié";

}
if (isset($newCodePostal) && !empty($newCodePostal) && $newCodePostal != $codePostal) {
    $queryPrepared = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET code_postal=:codePostal WHERE id_utilisateur=:id");
    $queryPrepared->execute([
        "codePostal" => $newCodePostal,
        "id" => $idUtilisateur
    ]);
    $codePostal = $newCodePostal;
    $successProfileEdit[] = "Votre code postal a bien été modifié";

}


if (isset($newVille) && !empty($newVille) && $newVille != $ville) {
    $queryPrepared = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET ville=:ville WHERE id_utilisateur=:id");
    $queryPrepared->execute([
        "ville" => $newVille,
        "id" => $idUtilisateur
    ]);
    $ville = $newVille;
    $successProfileEdit[] = "Votre ville a bien été modifié";

}

if (isset($newPwd) && isset($newPwd2)) {
    if (!empty($newPwd) && $newPwd != $newPwd2) {
        $listOfErrorsProfileEdit[] = "Les mots de passe ne correspondent pas";
    } elseif (!empty($newPwd) && !password_verify($oldPwd, $pwd)) {
        $listOfErrorsProfileEdit[] = "Votre mot de passe actuel n'est pas valide";
    } elseif (!empty($newPwd)) {
        // Vérifier la longueur du mot de passe
        if(strlen($pwd) < 8 || !preg_match("#[a-z]#", $pwd) || !preg_match("#[A-Z]#", $pwd) || !preg_match("#[0-9]#", $pwd)) {
            $listOfErrorsProfileEdit[] = "Le mot de passe doit avoir au moins 8 caractères et contenir au moins un chiffre";
        } else {
            $hashedNewPwd = password_hash($newPwd, PASSWORD_DEFAULT); // Hacher le nouveau mot de passe
            $queryPrepared = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET pwd=:pwd WHERE id_utilisateur=:id");
            $queryPrepared->execute([
                "pwd" => $hashedNewPwd,
                "id" => $idUtilisateur
            ]);
            $pwd = $hashedNewPwd;
            $successProfileEdit[] = "Votre mot de passe a bien été modifié";
        }
    }
}


//si NOK alors on affiche un message d'erreur
$_SESSION['successProfileEdit'] = $successProfileEdit;
$_SESSION['listoferrorsProfileEdit'] = $listOfErrorsProfileEdit;
$_SESSION['data'] = $_POST;
redirection('../modifier-profil');

