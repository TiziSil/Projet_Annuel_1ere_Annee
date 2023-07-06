<?php
session_start();
require_once '../conf.inc.php';
require_once 'functions.php';
require('pdf/fpdf.php');
//utilisateur
$connexion = connectDB();
$queryPrepared = $connexion->prepare("SELECT * FROM " . DB_PREFIX . "UTILISATEUR WHERE email = :email ");

$email = $_SESSION['email']; // Récupère l'e-mail de la session


$queryPrepared->execute([
    "email" => $email
]);
$results = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);


//utilisateur
// Affiche les résultats
foreach ($results as $row) {
    // Accédez aux colonnes par leur nom
    $id = $row['id_utilisateur'];
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
$recipePrepared = $connexion->prepare("SELECT * FROM " . DB_PREFIX . "RECETTE WHERE auteur_recette = :id ");
$recipePrepared->execute([
    "id" => $id
]);
$recipeResults = $recipePrepared->fetchAll(PDO::FETCH_ASSOC);

$pdf = new FPDF();
$pdf->AddPage("UTF-8");

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Informations de '.$prenom ." " .$nom, 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Nom: '.$nom, 0, 1);
$pdf->Cell(0, 10, 'Prenom: '.$prenom, 0, 1);
$pdf->Cell(0, 10, 'Pseudo: '.$pseudo, 0, 1);
$pdf->Cell(0, 10, 'Email: '.$email, 0, 1);
$pdf->Cell(0, 10, 'Telephone: '.$telephone, 0, 1);
$pdf->Cell(0, 10, 'Date de naissance: '.$dateNaissance, 0, 1);
$pdf->Cell(0, 10, 'Points de fidelite: '.$pointsFidelite, 0, 1);
$pdf->Cell(0, 10, 'Role: '.$role, 0, 1);
$pdf->Cell(0, 10, 'Type de compte: '.$typeCompte, 0, 1);
$pdf->Cell(0, 10, 'Statut: '.$statut, 0, 1);
$pdf->Cell(0, 10, 'Date d\'ajout: '.$dateInserted, 0, 1);
$pdf->Cell(0, 10, 'Date de modification: '.$dateUpdated, 0, 1);
$pdf->Cell(0, 10, 'Pays: '.$pays, 0, 1);
$pdf->Cell(0, 10, 'Adresse: '.$adresse, 0, 1);
$pdf->Cell(0, 10, 'Code postal: '.$codePostal, 0, 1);
$pdf->Cell(0, 10, 'Ville: '.$ville, 0, 1);
$pdf ->Ln(10);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Recettes de '.$prenom ." " .$nom, 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
foreach ($recipeResults as $rowRecipe) {
    $nomRecette = $rowRecipe['nom_recette'];
    $difficulte = $rowRecipe['difficulte'];
    $tempsPreparation = $rowRecipe['temps_preparation'];
    $description = $rowRecipe['description_recette'];
    $image = $rowRecipe['image_recette'];

    $pdf->Cell(0, 10, 'Nom de la recette: '.$nomRecette, 0, 1);
    $pdf->Cell(0, 10, 'Difficulte: '.$difficulte, 0, 1);
    $pdf->Cell(0, 10, 'Temps de préparation: '.$tempsPreparation, 0, 1);
    $pdf->MultiCell(0, 10, 'Description: '.$description, 0, 1);
    //$pdf->Cell(0, 10, 'Image: '.$image, 0, 1);
    $pdf->Image('../'.$image, 10,$pdf->GetY()+ 10, 50, 50);

    $pdf->Ln(10); // Ajoute un espace entre les recettes
    $pdf->Ln(10); // Ajoute un espace entre les recettes
    $pdf ->Ln(10);
    $pdf ->Ln(10);
    $pdf ->Ln(10);
    $pdf ->Ln(10);

     
}
// Ajoutez les autres informations de l'utilisateur ici
$pdf->Output("Voici-vos-informations.pdf","I");

?>
