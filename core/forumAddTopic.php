<?php
session_start();
require "../conf.inc.php";
require "functions.php";

if(!isset($_SESSION['id'])) {
    header('location: .');
}

if (isset($_POST['validate'])) {
    echo $_POST['title'];
    echo $_POST['content'];
    if (!empty($_POST['title']) and !empty($_POST["content"])) {

        $question_title = htmlspecialchars($_POST['title']);
        $question_text = nl2br(htmlspecialchars($_POST['content']));      // DataGrip -> MAKASINE_FORUM
        $question_date = date('Y/m/d');
        $question_id_author = $_SESSION['id']; 
        $question_pseudo_author = $_SESSION['pseudo'];

        $connection = connectDB();
        $insertQuestionWebsite = $connection->prepare('INSERT INTO MAKISINE_FORUM(question_title, question_text, question_date, question_id_author, question_pseudo_author)VALUES(?,?,?,?,?)');
        $insertQuestionWebsite->execute(
            array($question_title,  $question_text,  $question_date,  $question_id_author,  $question_pseudo_author)
        );
        header('location:../forum');
    } else {
        header('location:../forum');
    }
}
