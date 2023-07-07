<?php

$page = $_SERVER['REQUEST_URI'];
$page = explode('?', $page)[0];
$fichier = substr(dirname(__FILE__), strrpos(str_replace('\\', '/', dirname(__FILE__)), '/') + 1);
if ($fichier === 'htdocs' || $fichier === 'www') {
    $fichier = '';
} else {
    $fichier = '/' . $fichier;
}


switch ($page) {

    case '':
    case $fichier . '/index.php':
    case $fichier . '/':
        // <!-- Tuile n°1 Accueil -->
        include "./home-page/tuile-1-accueil.php";
        // <!-- Tuile n°2 Qu'est-ce que Makisine -->
        include "./home-page/tuile-2-about-makisine.php";
        // <!-- Tuile n°3 Catégorie de recettes -->
        include "./home-page/tuile-3-categorie-recettes.php";
        // <!-- Tuile n°4 Recettes -->;
        include "./home-page/tuile-4-recettes.php";
      
        break;


    case $fichier . '/recettes':
        require './pages/recettes.php';
        break;

    case $fichier . '/backoffice':
        require './pages/backoffice.php';
        break;

    case $fichier . '/attente-validation':
        require './pages/attente-validation.php';
        break;

    case $fichier . '/paiement':
        require './pages/paiement/paiement.php';
        break;

    case $fichier . '/contact':
        require './pages/contact.php';
        break;
    case $fichier . '/user':
        require './pages/user.php';
        break;

    case $fichier . '/mot-de-passe-oublie':
        require './pages/mot-de-passe-oublie.php';
        break;

    case $fichier . '/cookies':
        require './pages/cookies.php';
        break;
    
    //Profil
    case $fichier . '/mon-abonnement':
        require './pages/Profil/mon-abonnement.php';
        break;

    case $fichier . '/mon-compte':
        require './pages/Profil/mon-compte.php';
        break;
    
    case $fichier . '/modifier-profil':
        require './pages/Profil/modifier-profil.php';
        break;
    
    case $fichier . '/mes-recettes':
        require './pages/Profil/mes-recettes.php';
        break;
    
    case $fichier . '/mon-compte-admin':
        require './pages/Profil/mon-compte-admin.php';
        break;

    case $fichier . '/error404':
        require '/error404.php';
        break;        



    case $fichier . '/erreur':
        require '/erreur.php';
        break;

    

    //abonnement
    case $fichier . '/checkout':
        require './pages/Abonnement/checkout.php';
        break;
    
    //admin
    case $fichier . '/userEdit':
        require './pages/Admin/userEdit.php';
        break;
    case $fichier . '/forum':
        require './pages/forum.php';
        break;

    case $fichier . '/forum-article':
        require './pages/forum-afficher-article.php';
        break;
        
    case $fichier . '/afficher-recette':
        require './pages/recettes/afficher-recette.php';
        break;


    case $fichier . '/categorie-recette':
        require './pages/recettes/listByCategory.php';
        break;

    case $fichier . '/recette':
        require './pages/recettes/recipe.php';
        break;

    case $fichier . '/creation-recette':
        require './pages/recipeCreation.php';
        break;
    
    case $fichier . '/filtre':
        require './pages/recettes/Filtre.php';
        break;

    //logs
    
    default:
        require 'error404.php';
        break;
}
?>
<!-- Home page  -->