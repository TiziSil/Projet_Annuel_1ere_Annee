<!DOCTYPE html>
<html lang="fr">
<?php session_start();
//session_destroy();
include "head.php";
require "core/functions.php"; ?>
<?php

if (isconnected()){
    echo "vous êtes connecté";
    echo "<button><a class='nav-link' href='logout.php'>Se déconnecter</a></button>";
    }else{
        echo "vous n'êtes pas connecté";
    }
?>
<body>

    <div id="bouton-remonter">
        <a href="#top"><img src="assets/images/fleche-haut.png" alt="Remonter"></a>
    </div>
    <?php include "header.php"; ?>

    <div id="banniere-cookies">
        <h4 class="h4-cookies">Cookies</h4>
        <div class="image-cookies"></div>
        <p>Pour une meilleure navigation, merci de bien vouloir accepter les cookies</p>
        <p><a href="./cookies">En savoir plus</a></p>
        <button class="button3 button-cookies" onclick="accepterCookie()">Accepter tous les cookies</button>
        <button class="button3 button-cookies" onclick="refuserCookie()">Ne pas accepter les cookies</button>
    </div>

    <?php include "rooting.php"; ?>
    <?php include "footer.php"; ?>
    <?php include "pages/recette/afficher-recette.php" ?>
</body>
<html>