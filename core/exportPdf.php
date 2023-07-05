<?php
session_start();
require_once '../conf.inc.php';
require_once 'functions.php';
require('pdf/fpdf.php');

$connexion = connectDB();
$queryPrepared = $connexion->prepare("SELECT * FROM " . DB_PREFIX . "UTILISATEUR WHERE email = :email ");

$email = $_SESSION['email']; // Récupère l'e-mail de la session

$queryPrepared->bindParam(':email', $email); // Lie la valeur de $email au paramètre :email

$queryPrepared->execute();
$results = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
  // Affiche les résultats
foreach ($results as $row) {
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

}

$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Informations de '.$prenom ." " .$nom, 0, 1, 'C');

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

// Ajoutez les autres informations de l'utilisateur ici
$pdf->Output("Voici vos informations.pdf","I");
//$pdf->Output("Voici vos informations.pdf", "D");
?>
