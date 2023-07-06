<?php
session_start();
require "../conf.inc.php";
require "functions.php";
if (isConnected()) {

    $couleurPeau = array("#ffdbb4", "#edb98a", "#fd9841", "#fcee93", "#d08b5b", "#ae5d29", "#614335");
    $couleurCheveux = array("#fd9841", "#d08b5b", "#ffdbb4", "#edb98a", "#fcee93", "#ae5d29", "#614335");
    $peau = array("#peau-1", "#peau-2");
    $cheveux = array("#cheveux-1", "#cheveux-2", '#none');
    $yeux = array("#yeux-1", "#yeux-2");
    $accessoires = array("#none", "#lunettes");
    $pilosite = array("#none", "#pilosite-1", "#pilosite-2");
    $bouche = array("#none", "#bouche-1", "#bouche-2", "#bouche-4");

    $connection = connectDB();
    $avatar = $connection->prepare("SELECT couleurPeau, couleurCheveux, yeux, coiffure, accessoire, pilosite, bouche FROM MAKISINE_UTILISATEUR u JOIN MAKISINE_AVATAR a ON u.avatar_utilisateur = a.id_avatar WHERE u.id_utilisateur = ?");
    $avatar->execute(array($_SESSION['id_utilisateur']));
    $result = $avatar->fetch();
    $avatarVisible = false;

    if (
        isset($result['couleurPeau']) and
        isset($result['couleurCheveux']) and
        isset($result['yeux']) and
        isset($result['coiffure']) and
        isset($result['accessoire']) and
        isset($result['pilosite']) and
        isset($result['bouche'])
    ) {
        echo json_encode($result);
    } else {
        echo '{}';
    }
} else {
    echo '{}';
}


