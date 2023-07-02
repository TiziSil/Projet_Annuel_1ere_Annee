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

if(isset($_POST['nom']) and isset($_POST['email']) and isset($_POST['tel'])) {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $telephone = $_POST['tel'];

    $connection = connectDB();
    
    $nouveauMDP = randomPassword();
    // $nouveauMDP = "test";
    $nouveauMDPEncrypt = password_hash($nouveauMDP, PASSWORD_DEFAULT);

    $queryPrepared = $connection->prepare("UPDATE MAKISINE_UTILISATEUR SET pwd = :pwd WHERE email = :email AND telephone = :telephone");
    $queryPrepared->execute(["pwd" => $nouveauMDPEncrypt, "email" => $email, "telephone" => $telephone]);
    
    $results = $queryPrepared->fetch();
    echo $nouveauMDP;


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
	$mail->Subject = 'Vous avez fait une demande de changement de mot de passe';
	$mail->Body    = 'Bonjour,<br/>Voici votre nouveau mot de passe pour votre compte Makisine, n\'oubliez pas de le changer lors de votre prochaine connexion : <br/><b>' . $nouveauMDP . '</b><br/>A bientôt.<br/><br/> L\'équipe Makisine';
	$mail->AltBody = 'Bonjour,<br/>Voici votre nouveau mot de passe pour votre compte Makisine, n\'oubliez pas de le changer lors de votre prochaine connexion : <br/><b>' . $nouveauMDP . '</b><br/>A bientôt.<br/><br/> L\'équipe Makisine';
	$mail->send();
    header('Location: ..');
}