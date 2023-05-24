<!DOCTYPE html>
<html lang="fr">
<?php session_start();
//session_destroy();
include "head.php";
require 'core/functions.php';
require "conf.inc.php"; ?>
<?php
if (!isConnected()) {
    echo "Vous n'êtes pas connecté";
}else if (isConnected()) {
    echo "Vous êtes connecté";
}
?>
<button><a class="nav-link" href="logout.php">Se déconnecter</a></button>

<body>
    <?php include "header.php"; ?>
    <?php include "rooting.php"; ?>
    <?php include "footer.php"; ?>
</body>
<html>