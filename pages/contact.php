<?php

//php mailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
//!!!!!!!!!!!!!!
require '../vendor/autoload.php'; //mettre le chemin pour le serveur
//!!!!!!!!!!!!!!
?>

<section id="contact" class="col">
    <div class="container">
        <div class="gros-cercle-2">
            <h1>Contactez-nous!</h1>
            <p class="p-gros-cercle-contact">Besoin d'inspiration culinaire ou de conseils personnalisés ? <br><br> Contactez-nous dès maintenant pour des recettes délicieuses et une assistance sur mesure! <br><br> A très vite!</p>
        </div>
    </div>
</section>

<section class="section-radis" class="col">
    <img src="assets/images/separateur.png" class="separateur-de-texte-contact">
</section>


<section id="contact-2" class="d-flex flex-column">
    <div class="d-flex filtre-gris py-5">
        <div class="container py-3 d-flex flex-row justify-content-end">
            <div class="formulaire col-md-4 col-9 d-flex flex-column mx-5 ">
                <h3>Formulaire de contact </h3>
                <form method="POST" class="d-flex flex-column">
                    <div class="champ my-2">
                        <input class="input-champ" size="40" type="text" name="nom" required>
                        <label>Votre nom</label>
                    </div>
                    <div class="champ my-2">
                        <input class="input-champ" size="40" type="email" name="email" required>
                        <label>Votre e-mail</label>
                    </div>
                    <div class="champ my-2">
                        <input class="input-champ" size="40" type="text" name="sujet" required>
                        <label>Sujet</label>
                    </div>
                    <div class="champ my-2">
                        <label for="commentaire">Votre message</label>
                        <textarea class="input-champ" cols="43" rows="10" name="commentaire" required></textarea>
                    </div>
                    <button class="button2 mt-2">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
    </div>

</section>

<section class="section-radis" class="col">
    <img src="assets/images/separateur.png" class="separateur-de-texte-contact">
</section>

<section id="contact-3">
    <div class="filtre-gris">
        <div class="container">
            <div class="contact-adresse py-5">
                <div class="adresse-postale d-flex flex-column  justify-content-center align-items-center my-3">
                    <div class="py-3">
                        <h3>Contact</h3>
                        <span class="py-1">123, avenue du Paradis</span>
                        <span class="py-1">75012 Paris</span>
                        <div class="py-1 coordonnees-tel"><strong>Téléphone : </strong><a href="tel:01 00 01 02 03">01 00 01 02 03</a></div>
                        <div class="py-1 coordonnees-mail"><strong>Mail : </strong><a href="mailto:contact@Makisine.fr">contact@Makisine.fr</a></div>
                    </div>
                </div>
                <div class="horaire-contact d-flex flex-column  justify-content-center align-items-center my-3">
                    <div class="py-3">
                        <h3 class="py-1">Horaire de contact</h3>
                        <p class="py-1">Ouvert de 8h à 12h30 et de 13h30 à 20h<br>Du lundi au dimanche</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
if (isset($_POST['email']) and isset($_POST['nom']) and !empty($_POST['nom']) and !empty($_POST['email'])) {
    $email = cleanEmail($_POST['email']);
    $nom = cleanLastname($_POST['nom']);
    $texte = $_POST['commentaire'];
	//Server settings
	//$mail->SMTPDebug =2;                      //Enable verbose debug output
	$mail->isSMTP();                                            //Send using SMTP
	$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
	$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	$mail->Username   = 'pamakisine@gmail.com';                     //SMTP username
	$mail->Password   = 'ngjzeprsrycjzbzx';                               //SMTP password
	$mail->SMTPSecure = 'TLS';            //Enable implicit TLS encryption
	$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('ne-pas-repondre@makisine.com');
    $mail->addAddress('pamakisine@gmail.com');     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo($email);
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

	//Content
	$mail->isHTML(true);                                  //Set email format to HTML
	$mail->Subject = 'Message de' .$nom;
	$mail->Body    = $texte;


	$mail->send();
    header('Location: contact');
}
?>