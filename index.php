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
    <?php include "header.php"; ?>
    <?php include "rooting.php"; ?>
    <?php include "footer.php"; ?>
</body>
<html>