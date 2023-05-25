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
<button><a class="nav-link" href="logout.php">Se déconnecter</a></button>

<body>
    <?php include "header.php"; ?>
    <?php include "rooting.php"; ?>
    <?php include "footer.php"; ?>
</body>
<html>