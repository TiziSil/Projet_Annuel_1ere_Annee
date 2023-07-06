<?php
session_start();
require "../conf.inc.php";
require 'functions.php';


$idUtilisateur = $_POST['id']; // Récupère l'id
print_r($idUtilisateur);
$connexion = connectDB();
$queryPrepared = $connexion->prepare("SELECT * FROM " . DB_PREFIX . "UTILISATEUR WHERE id_utilisateur = :userId ");
$queryPrepared->bindParam(':userId', $idUtilisateur);


$queryPrepared->execute([  
    "userId" => $idUtilisateur
]);
$row = $queryPrepared->fetch();
echo '<pre>';
//print_r($row);
var_dump($row);
echo'</pre>';
// Accédez aux colonnes par leur nom

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
$newPseudo =htmlspecialchars(cleanFirstname($_POST['newPseudo']));
$newEmail = htmlspecialchars(cleanEmail($_POST['newEmail']));
$newTelephone = htmlspecialchars(cleanPhone($_POST['newTelephone']));
$newDateNaissance = htmlspecialchars($_POST['newDateNaissance']);
$newPays = htmlspecialchars($_POST['newPays']);
$newAdresse = htmlspecialchars($_POST['newAdresse']);
$newCodePostal = htmlspecialchars($_POST['newCodePostal']);
$newVille = htmlspecialchars(cleanFirstname($_POST['newVille']));
$newPointsFidelite = htmlspecialchars($_POST['newPointsFidelite']);
$newRole = htmlspecialchars($_POST['newRole']);
$newTypeCompte = htmlspecialchars($_POST['newTypeCompte']);


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
    && ($newPointsFidelite == $pointsFidelite)
    && ($newRole == $role)
    && ($newTypeCompte == $typeCompte)

) {
    $listOfErrorsUsersEdit[] = "Vous n'avez rien modifié";
}

if (isset($newLastname) && !empty($newLastname) && $newLastname != $nom) {
    if(strlen($lastname) < 2){
        $listOfErrorsUsersEdit[] = "Le nom doit faire plus de 2 caractères";
    }else{
    
        $queryPrepared = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET nom_utilisateur=:nom WHERE id_utilisateur=:id");
        $queryPrepared->execute([
            "nom" => $newLastname,
            "id" => $idUtilisateur
        ]);
        $nom = $newLastname;
        $successUsersEdit[] = "Le nom a bien été modifié";
    }

}
if (isset($newFirstName) && !empty($newFirstName) && $newFirstName != $prenom) {
    if(strlen($firstname) < 2){
        $listOfErrors[] = "Le prénom doit faire plus de 2 caractères";
    }else{
        $queryPrepared = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET prenom_utilisateur=:prenom WHERE id_utilisateur=:id");
        $queryPrepared->execute([
            "prenom" => $newFirstName,
            "id" => $idUtilisateur
        ]);
        $prenom = $newFirstName;
        $successUsersEdit[] = "Le prénom a bien été modifié";
    }

}
if (isset($newPseudo) && !empty($newPseudo) && $newPseudo != $pseudo) {
    $pseudoPrepared = $connexion -> prepare("SELECT pseudo FROM ".DB_PREFIX."UTILISATEUR WHERE pseudo = :pseudo");
    $pseudoPrepared-> execute(["pseudo" => $pseudo]);
    $results = $pseudoPrepared -> fetch();
    if (!empty($results)){
        $listOfErrorsUsersEdit[] = "Le pseudo est déjà utilisé";
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
    if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
        $listOfErrorsUsersEdit[] = "L'email est incorrect";
    } else {
        $emailPrepared = $connexion->prepare("SELECT * FROM " . DB_PREFIX . "UTILISATEUR WHERE email = :email");
        $emailPrepared->execute(["email" => $newEmail]);
        $results = $emailPrepared->fetch();

        if (!empty($results)) {
            $listOfErrorsUsersEdit[] = "L'email est déjà utilisé";
        } else {
            $queryPrepared = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET email=:email WHERE id_utilisateur=:id");
            $queryPrepared->execute([
                "email" => $newEmail,
                "id" => $idUtilisateur
            ]);
            $email = $newEmail;
            $successUsersEdit[] = "L'email a bien été modifié";
        }
    }
}

if (isset($newTelephone) && !empty($newTelephone) && $newTelephone != $telephone) {
    $queryPrepared = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET telephone=:telephone WHERE id_utilisateur=:id");
    $queryPrepared->execute([
        "telephone" => $newTelephone,
        "id" => $idUtilisateur
    ]);
    $telephone = $newTelephone;
    $successUsersEdit[] = "Le numéro de téléphone a bien été modifié";

}
$birthdayExploded = explode("-", $newDateNaissance);
if (isset($newDateNaissance) && !empty($newDateNaissance) && $newDateNaissance != $dateNaissance) {
    if (!checkdate($birthdayExploded[1],$birthdayExploded[2],$birthdayExploded[0])){
        $listOfErrorsUsersEdit[] = "Date de naissance incorrecte";
    }else{
        //Vérification de l'age
        $todaySecond = time();
        $birthdaySecond = strtotime($newDateNaissance);
        $ageSecond = $todaySecond - $birthdaySecond;
        $age = $ageSecond/60/60/24/365.25;
        if( $age <= 6 || $age >= 99 ){
            $listOfErrorsUsersEdit[] = "Vous n'avez pas l'âge requis (entre 6 et 99 ans)";
        } else{
            $queryPrepared = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET date_de_naissance=:dateNaissance WHERE id_utilisateur=:id");
            $queryPrepared->execute([
                "dateNaissance" => $newDateNaissance,
                "id" => $idUtilisateur
            ]);
            $dateNaissance = $newDateNaissance;
            $successUsersEdit[] = "La date de naissance a bien été modifié";
        }
    }

}
if (isset($newPays) && !empty($newPays) && $newPays != $pays) {
    // Vérification de cohérence des valeurs pour le champ "pays"
    $listCountries = ["fr", "it", "pt", "pl", "es", "be", "ch", "xx"];
    if (!in_array($newPays, $listCountries)) {
        $listOfErrorsUsersEdit[] = "Le pays n'existe pas";
    } else {
        $queryPrepared = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET country=:pays WHERE id_utilisateur=:id");
        $queryPrepared->execute([
            "pays" => $newPays,
            "id" => $idUtilisateur
        ]);
        $pays = $newPays;
        $successUsersEdit[] = "Le pays a bien été modifié";
    }
}

if (isset($newAdresse) && !empty($newAdresse) && $newAdresse != $adresse) {
    $queryPrepared = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET adresse=:adresse WHERE id_utilisateur=:id");
    $queryPrepared->execute([
        "adresse" => $newAdresse,
        "id" => $idUtilisateur
    ]);
    $adresse = $newAdresse;
    $successUsersEdit[] = "L'adresse a bien été modifié";

}
if (isset($newCodePostal) && !empty($newCodePostal) && $newCodePostal != $codePostal) {
    $queryPrepared = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET code_postal=:codePostal WHERE id_utilisateur=:id");
    $queryPrepared->execute([
        "codePostal" => $newCodePostal,
        "id" => $idUtilisateur
    ]);
    $codePostal = $newCodePostal;
    $successUsersEdit[] = "Le code postal a bien été modifié";

}


if (isset($newVille) && !empty($newVille) && $newVille != $ville) {
    $queryPrepared = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET ville=:ville WHERE id_utilisateur=:id");
    $queryPrepared->execute([
        "ville" => $newVille,
        "id" => $idUtilisateur
    ]);
    $ville = $newVille;
    $successUsersEdit[] = "Le ville a bien été modifié";

}


if (isset($pointsFidelite) && !empty($pointsFidelite) && $pointsFidelite != $pointsFidelite) {
    $queryPrepared = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET points_fidelite=:pointsFidelite WHERE id_utilisateur=:id");
    $queryPrepared->execute([
        "pointsFidelite" => $pointsFidelite,
        "id" => $idUtilisateur
    ]);
    $pointsFidelite = $pointsFidelite;
    $successUsersEdit[] = "Les points de fidélité ont bien été modifié";

}
if (isset($role) && !empty($role) && $role != $role) {
    $queryPrepared = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET role=:role WHERE id_utilisateur=:id");
    $queryPrepared->execute([
        "role" => $role,
        "id" => $idUtilisateur
    ]);
    $role = $role;
    $successUsersEdit[] = "Le rôle a bien été modifié";

}
if (isset($statut) && !empty($statut) && $statut != $statut) {
    $queryPrepared = $connexion->prepare("UPDATE " . DB_PREFIX . "UTILISATEUR SET statut=:statut WHERE id_utilisateur=:id");
    $queryPrepared->execute([
        "statut" => $statut,
        "id" => $idUtilisateur
    ]);
    $statut = $statut;
    $successUsersEdit[] = "Le statut a bien été modifié";

}
//si NOK alors on affiche un message d'erreur
$_SESSION['successUsersEdit'] = $successUsersEdit;
$_SESSION['listoferrorsUsersEdit'] = $listOfErrorsUsersEdit;
$_SESSION['data'] = $_POST;
$_SESSION['userId'] = $idUtilisateur;

//print_r($_SESSION['data']);
redirection('../userEdit');