<?php
session_start();
require "../conf.inc.php";
require "functions.php";
//php mailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
//!!!!!!!!!!!!!!
require '../vendor/autoload.php'; //mettre le chemin pour le serveur

// if(isset($_POST['nom']) and isset($_POST['email']) and isset($_POST['tel'])) {
$nom = 'Silrine';
$email = 'nakey27588@msback.com';
$title = 'Venez jeter un oeil à nos nouvelles recettes !';

$html = "
<html>
    <head> 
        <title>". $title ."</title> 
    </head> 
    <body> 
        <h1>". $title ."</h1>
        <div>
            <h2>Sauté de veaux aux linguine</h2>
            <p>
                Découpez la viande en gros cubes, salez et farinez-la. Faites-la dorer dans 40 g de beurre à feu moyen dans une sauteuse. Pelez et coupez les échalotes en 2. Ajoutez-les ainsi que 15 cl d'eau, le jus de citron, le laurier et le thym. Salez et poivrez, couvrez et laissez mijotez pendant 1h30.
                Faites cuire les spaghettis le temps indiqué sur le paquet.
                Lavez les poireaux et coupez-les en tronçons. Faites-les suer avec 40 g de beurre dans une poêle à feu doux pendant 5 minutes. Salez et poivrez. Ajoutez-y les pâtes et mélangez.
                Ajoutez la crème à la viande 5 minutes avant la fin de la cuisson.
            </p>
        </div>
    </body>
    <style>

    </style>
</html>
";

echo $html;


$mail = new PHPMailer(true);
$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = 'pamakisine@gmail.com';                     //SMTP username
$mail->Password   = 'ngjzeprsrycjzbzx';                               //SMTP password
$mail->SMTPSecure = 'TLS';            //Enable implicit TLS encryption
$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
$mail->setFrom('ne-pas-repondre@makisine.com');
$mail->addAddress($email, $nom);     //Add a recipient
$mail->addReplyTo('pamakisine@gmail.com');
$mail->isHTML(true);                                  //Set email format to HTML
$mail->Subject = $title . '- Makisine';
$mail->Body    = $html;
$mail->AltBody = $html;
$mail->send();
// header('Location: ..');
// }