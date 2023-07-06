<?php
session_start();
require "../conf.inc.php";
require "functions.php";

if (!isConnected()) {
    header('location: .');
}

if (
    isset($_POST['couleurVisage']) and
    isset($_POST['couleurCheveux']) and
    isset($_POST['cheveuxSelectionne']) and
    isset($_POST['boucheSelectionne']) and
    isset($_POST['pilositeSelectionne']) and
    isset($_POST['yeuxSelectionne']) and
    isset($_POST['accesoireSelectionne']) and
    isset($_SESSION['id_utilisateur'])
) {
    $couleurPeau = $_POST['couleurVisage'];
    $couleurCheveux = $_POST['couleurCheveux'];
    $yeux = $_POST['yeuxSelectionne'];
    $coiffure = $_POST['cheveuxSelectionne'];
    $accessoire = $_POST['accesoireSelectionne'];
    $pilosite = $_POST['pilositeSelectionne'];
    $bouche = $_POST['boucheSelectionne'];

    $connection = connectDB();
    $avatar = $connection->prepare("SELECT id_avatar, couleurPeau, couleurCheveux, yeux, coiffure, accessoire, pilosite, bouche FROM MAKISINE_UTILISATEUR u JOIN MAKISINE_AVATAR a ON u.avatar_utilisateur = a.id_avatar WHERE u.id_utilisateur = ?");
    $avatar->execute(array($_SESSION['id_utilisateur']));
    $result = $avatar->fetch();
    if($result) {
        $updateAvatar = $connection->prepare("UPDATE MAKISINE_AVATAR SET couleurPeau = ?, couleurCheveux = ?, yeux = ?, coiffure = ?, accessoire = ?, pilosite = ?, bouche = ? WHERE id_avatar = ?");
        $updateAvatar->execute(array($couleurPeau, $couleurCheveux, $yeux, $coiffure, $accessoire, $pilosite, $bouche, $result['id_avatar']));
    } else {
        $insertAvatar = $connection->prepare("INSERT INTO MAKISINE_AVATAR (couleurPeau, couleurCheveux, yeux, coiffure, accessoire, pilosite, bouche) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $insertAvatar->execute(array($couleurPeau, $couleurCheveux, $yeux, $coiffure, $accessoire, $pilosite, $bouche));
        $avatarId = $connection->lastInsertId(); // récupère le dernier ID inséré
        $updateUserAvatar = $connection->prepare("UPDATE MAKISINE_UTILISATEUR SET avatar_utilisateur = ? WHERE id_utilisateur = ?");
        $updateUserAvatar->execute(array($avatarId, $_SESSION['id_utilisateur']));
    }
    header('Location: ../modifier-profil');
} else {
    header('Location: ../modifier-profil');
}