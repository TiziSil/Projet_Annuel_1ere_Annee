<!DOCTYPE html>
<html lang="fr">
<?php session_start();
require "core/functions.php";

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
    <?php include "rooting.php"; ?>
    <?php include "footer.php"; ?>
</body>
<html>