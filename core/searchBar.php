<?php
require "../core/functions.php";

$connection = connectDB();
$queryPrepared = $connection->prepare("SELECT * FROM ".DB_PREFIX."UTILISATEUR ORDER BY id DESC");
$queryPrepared->execute();

if (isset($_POST['search'])) {
    $search = htmlspecialchars($_POST['search']);
    $queryPrepared = $connection->prepare("SELECT * FROM ".DB_PREFIX."UTILISATEUR WHERE * LIKE "%'.$serch.'%" ORDER BY id DESC");
}