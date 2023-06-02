<!DOCTYPE html>
<html lang="fr">
<?php session_start();
//session_destroy();
include "head.php"; ?>
<?php
// if(isset($_SESSION)) {
//     echo "session started <br>";
//     echo var_dump($_SESSION);
// }
?>

<body>

    <div id="bouton-remonter">
        <a href="#top"><img src="assets/images/fleche-haut.png" alt="Remonter"></a>
    </div>
    <?php include "header.php"; ?>
    <div class="cookies">
        <h4 class="h4-cookies">Cookies</h4>
        <a href=""><img src="assets/images/cookies.avif">
        <p>Veuillez accepter les cookies avant de continuer</p>
        <p><a href="#">En savoir plus</a></p>
        <button class="button3 button-cookies">Accepter tous les cookies</button>
        <button class="button3 button-cookies">Ne pas accepter les cookies</button>
    </div>
    <?php include "rooting.php"; ?>
    <?php include "footer.php"; ?>
</body>
<html>