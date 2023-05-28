<!DOCTYPE html>
<html lang="fr">
<?php session_start();
//session_destroy();
include "head.php";
require "core/functions.php"; ?>
<?php
// if(isset($_SESSION)) {
//     echo "session started <br>";
//     echo var_dump($_SESSION);
// }
if (isconnected()){
    echo "<button><a class='nav-link' href='logout.php'>Se déconnecter</a></button>";
    echo "vous êtes connecté";
}

?>
<body>
    <?php include "header.php"; ?>
    <?php include "rooting.php"; ?>
    <?php include "footer.php"; ?>
</body>
<html>