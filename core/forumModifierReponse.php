<?php
session_start();
require "../conf.inc.php";
require "functions.php";

if (!isConnected()) {
    header('location: .');
}

if (isset($_POST['idReponse']) && isset($_POST['reponse_text']) && !empty($_POST['reponse_text'])) {
    $reponse_text = nl2br(htmlspecialchars($_POST['reponse_text']));
    $reponse_id = $_POST['idReponse'];
    $reponse_id_author = $_SESSION['id_utilisateur'];

    $connection = connectDB();
    $updateReponseQuery = $connection->prepare('SELECT reponse_id_question, reponse_id, reponse_id_author FROM MAKISINE_FORUM_REPONSE WHERE reponse_id = ?');
    $updateReponseQuery->execute(array($reponse_id));
    $result = $updateReponseQuery->fetch();

    if ($result['reponse_id_author'] === $reponse_id_author) { // Si l'utilisateur est propriétaire de sa réponse il peu modifié en base
        $updateReponseQuery = $connection->prepare('UPDATE MAKISINE_FORUM_REPONSE SET reponse_text = ? WHERE reponse_id = ?');
        $updateReponseQuery->execute(array($reponse_text, $reponse_id));
    }
    header('Location: ../forum-article?id=' . $result['reponse_id_question']);
} else {
    header('Location: ../forum');
}
