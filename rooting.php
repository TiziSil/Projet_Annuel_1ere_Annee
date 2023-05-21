<?php

$page = $_SERVER['REQUEST_URI'];
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
        // <!-- Tuile n°5 Boutique -->
        include "./home-page/tuile-5-boutique.php";
        // <!-- Tuile n°6 Publicités -->
        include "./home-page/tuile-6-pub.php";
        break;

    case $fichier . '/mon-compte':
        require './pages/mon-compte.php';
        break;

    case $fichier . '/mes-paiements':
        require './pages/mes-paiements.php';
        break;

    case $fichier . '/boutique':
        require './pages/boutique.php';
        break;

    case $fichier . '/recettes':
        require './pages/recettes.php';
        break;

    case $fichier . '/promotions':
        require './pages/promotions.php';
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

    case $fichier . '/user':
        require './user.php';
        break;

    default:
        http_response_code(404);
        break;
}
?>
<!-- Home page  -->