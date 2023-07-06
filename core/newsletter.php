<?php
session_start();
require "../conf.inc.php";
require "functions.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

require '../vendor/autoload.php';

$connexion = connectDB();

$queryPrepared = $connexion->prepare("SELECT id_recette, nom_recette, difficulte, statut_publication, temps_preparation, description_recette, auteur_recette FROM MAKISINE_RECETTE ORDER BY id_recette DESC LIMIT 1");
$queryPrepared->execute();
$recette = $queryPrepared->fetch();

$queryPrepared = $connexion->prepare("SELECT pseudo, email FROM MAKISINE_UTILISATEUR");
$queryPrepared->execute();
$utilisateurs = $queryPrepared->fetchAll();

$title = 'Venez jeter un œil à nos nouvelles recettes !';

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'pamakisine@gmail.com';
$mail->Password = 'ngjzeprsrycjzbzx';
$mail->SMTPSecure = 'tls';
$mail->CharSet = 'UTF-8'; 
$mail->Port = 587;
$mail->setFrom('ne-pas-repondre@makisine.com');
$mail->addReplyTo('pamakisine@gmail.com');
$mail->isHTML(true);
$mail->Subject = $title . ' - Makisine';

foreach ($utilisateurs as $utilisateur) {
    $pseudo = $utilisateur['pseudo'];
    $email = $utilisateur['email'];

    $html = "
    <html>
        <head> 
            <title>Bonjour ". $pseudo . " ! <br />" . $title . "</title> 
        </head> 
        <body>
            <div class='boite'>
                <h1>Bonjour ". $pseudo . " ! <br />" . $title . "</h1>
            </div>

            <div class='boite'>
                <div>
                    <h2><a href='http://makisine.fr/recette?id=". $recette['id_recette'] ."'>" . $recette['nom_recette'] . "</a></h2>
                    <img src='https://media-cdn.tripadvisor.com/media/photo-s/22/8e/b2/d7/legumes-saute-nature.jpg' />
                    <p>" . $recette['description_recette'] . "</p>
                </div>
            </div>
        </body>
    </html>
    ";

    $mail->clearAddresses();
    $mail->addAddress($email, $pseudo);
    $mail->Body = $html;
    $mail->AltBody = $html;
    $mail->send();
}
