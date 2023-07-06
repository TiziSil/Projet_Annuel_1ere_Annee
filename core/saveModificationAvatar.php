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
    $tableauCouleurPeau = array("#ffdbb4","#edb98a","#fd9841","#fcee93","#d08b5b","#ae5d29","#614335");
    $tableauCouleurCheveux = array("#fd9841", "#d08b5b", "#ffdbb4", "#edb98a", "#fcee93", "#ae5d29", "#614335");
    $tableauPeau = array("#peau-1", "#peau-2");
    $tableauCheveux = array("#cheveux-1", "#cheveux-2", '#none');
    $tableauYeux = array("#yeux-1", "#yeux-2");
    $tableauAccessoires = array("#none", "#lunettes");
    $tableauPilosite = array("#none", "#pilosite-1", "#pilosite-2");
    $tableauBouche = array("#none", "#bouche-1", "#bouche-2", "#bouche-4");

    $couleurPeau = $_POST['couleurVisage'] % sizeof($tableauPeau);
    $couleurCheveux = $_POST['couleurCheveux'] % sizeof($tableauCouleurCheveux);
    $yeux = $_POST['yeuxSelectionne'] % sizeof($tableauYeux);
    $coiffure = $_POST['cheveuxSelectionne'] % sizeof($tableauCheveux);
    $accessoire = $_POST['accesoireSelectionne'] % sizeof($tableauAccessoires);
    $pilosite = $_POST['pilositeSelectionne'] % sizeof($tableauPilosite);
    $bouche = $_POST['boucheSelectionne'] % sizeof($tableauBouche);


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
}
header('Location: ../modifier-profil');