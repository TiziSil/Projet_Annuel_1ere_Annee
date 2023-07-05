<?php
session_start();
require "../conf.inc.php";
require "functions.php";

if (!IsConnected()) {
    header('location: .');
}

if (!empty($_POST['idQuestion']) and !empty($_POST["textQuestion"]) and isset($_POST['idQuestion']) and isset($_POST["textQuestion"])) {
    $new_question_text = nl2br(htmlspecialchars($_POST["textQuestion"])); // Nouvelle valeur du champ question_text
    $question_id = $_POST['idQuestion'];
    $question_id_author = $_SESSION['id_utilisateur'];

    $connection = connectDB();
    $updateReponseQuery = $connection->prepare('SELECT question_id, question_id_author FROM MAKISINE_FORUM WHERE question_id = ?');
    $updateReponseQuery->execute(array($question_id));
    $result = $updateReponseQuery->fetch();

    if ($result['question_id_author'] === $question_id_author) { // Si l'utilisateur est propriétaire de sa réponse il peu modifié en base
        $updateQuestionWebsite = $connection->prepare('UPDATE MAKISINE_FORUM SET question_text = ? WHERE question_id = ?');
        $updateQuestionWebsite->execute(array($new_question_text, $question_id));
    }
    header('Location: ../forum-article?id=' . $question_id);
} else {
    header('location: ../forum');
}
