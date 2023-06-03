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
</body>
<html>