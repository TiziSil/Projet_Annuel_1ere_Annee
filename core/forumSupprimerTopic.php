<?php
session_start();
require "../conf.inc.php";
require "functions.php";

if (!isConnected()) {
    header('location: .');
}

if (isset($_POST['idQuestion']) && !empty($_POST['idQuestion'])) {
    $question_id = $_POST['idQuestion'];
    $question_id_author = $_SESSION['id_utilisateur'];

    $connection = connectDB();
    $updateQuestionQuery = $connection->prepare('SELECT question_id, question_id_author FROM MAKISINE_FORUM WHERE question_id = ?');
    $updateQuestionQuery->execute(array($question_id));
    $result = $updateQuestionQuery->fetch();

    if ($result['question_id_author'] === $question_id_author) { // Si l'utilisateur est propriétaire de sa réponse il peu modifié en base
        $updateQuestionQuery = $connection->prepare('UPDATE MAKISINE_FORUM SET question_supprimer = ? WHERE question_id = ?');
        $updateQuestionQuery->execute(array(true, $question_id));
    }
    header('Location: ../forum-article?id=' . $question_id);
} else {
    header('Location: ../forum');
}
