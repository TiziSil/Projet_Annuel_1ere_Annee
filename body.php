<?php

$page = $_SERVER['REQUEST_URI'];

switch ($page) {

    case '':
    case '/ProjetAnnuel/index.php':
    case '/ProjetAnnuel/':
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

    case '/ProjetAnnuel/mon-compte':
        require './pages/mon-compte.php';
        break;

    case '/ProjetAnnuel/mes-paiements':
        require './pages/mes-paiements.php';
        break;

    default:
        http_response_code(404);
        break;
}
?>
<!-- Home page  -->