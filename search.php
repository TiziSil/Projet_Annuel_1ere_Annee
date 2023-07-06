<?php
require 'core/functions.php';
require "conf.inc.php";
session_start();

// Récupérer le terme de recherche depuis la requête
$searchTerm = $_GET['query'];

// Effectuer la recherche dans la base de données
$connexion = connectDB();
$queryPrepared = $connexion->prepare("SELECT * FROM " . DB_PREFIX . "UTILISATEUR WHERE 
    (nom_utilisateur LIKE :searchTerm) OR 
    (prenom_utilisateur LIKE :searchTerm) OR 
    (pseudo LIKE :searchTerm) OR 
    (email LIKE :searchTerm)");
$queryPrepared->execute(["searchTerm" => "%" . $searchTerm . "%"]);
$results = $queryPrepared->fetchAll();

// Générer le HTML du tableau des résultats de recherche
$tableHTML = '
<div class = "row">
    <div class ="col-11">
        <table class = "table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Pseudo</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>';


foreach ($results as $user){
    $id = $user["id_utilisateur"];
    $nom = $user["nom_utilisateur"];
    $prenom = $user["prenom_utilisateur"];
    $pseudo = $user["pseudo"];
    $email = $user["email"];

    $tableHTML .= '
            <tr>
            <td>' . $id . '</td>
            <td>' . $nom . '</td>
            <td>' . $prenom . '</td>
            <td>' . $pseudo . '</td>
            <td>' . $email . '</td>
            </tr>';
}
$tableHTML .= '</tbody>
</table>';

// Renvoyer le tableau des résultats sous forme de HTML
echo $tableHTML;
?>
