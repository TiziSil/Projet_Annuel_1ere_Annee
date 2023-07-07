<?php

session_start();
require "../conf.inc.php";
require "functions.php";

if (isset($_POST['id']) and isset($_POST['id']) and !empty($_POST['reponse']) and !empty($_POST['reponse'])) {
    echo $_POST['id'];
    echo $_POST['reponse'];
    
    $reponse_text = nl2br(htmlspecialchars($_POST['reponse']));      // DataGrip -> MAKASINE_FORUM
    $reponse_date = date('Y/m/d');
    $reponse_id_author = $_SESSION['id_utilisateur'];
    $reponse_pseudo_author = $_SESSION['pseudo'];

    $connection = connectDB();
    $insertQuestionWebsite = $connection->prepare('INSERT INTO MAKISINE_FORUM_REPONSE(reponse_id_author, reponse_id_question, reponse_date, reponse_pseudo_author, reponse_text)VALUES(?,?,?,?,?)');
    $insertQuestionWebsite->execute(
        array($reponse_id_author,  $_POST['id'],  $reponse_date, $reponse_pseudo_author, $reponse_text)
    );
    redirection('../forum-article?id='.$_POST['id']);
}
