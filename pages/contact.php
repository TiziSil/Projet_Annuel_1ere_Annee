<?php

//php mailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
//!!!!!!!!!!!!!!
require 'C:\xampp/vendor/autoload.php'; //mettre le chemin pour le serveur
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

<section id="section-radis" class="col">
    <img src="assets/images/separateur.png" class="separateur-de-texte-contact">
</section>


<section id="contact-2" class="col">
    <div class="filtre-gris">
        <div class="formulaire d-flex flex-column">
            <h3>Formulaire de contact </h3>
            <form method="POST" class="taille-contact d-flex flex-column justify-content-between">
                <div class="champ">
                    <input class="input-champ" size="40" type="text" name="nom" required>
                    <label>Votre nom</label>
                </div>
                <div class="champ">
                    <input class="input-champ" size="40" type="email" name="email" required>
                    <label>Votre e-mail</label>
                </div>
                <div class="champ">
                    <input class="input-champ" size="40" type="text" name="sujet" required>
                    <label>Sujet</label>
                </div>
                <div class="champ">
                <label class = 'input-champ' for="commentaire">Votre message</label>
                    <textarea class="input-champ" cols="43" rows="10" name="commentaire" required></textarea>
                    
                </div>
                <input class="button2" type="submit" value="Envoyer">
            </form>
        </div>
    </div>

</section>

<section id="section-radis" class="col">
    <img src="assets/images/separateur.png" class="separateur-de-texte-contact">
</section>

<section id="contact-3">
    <div class="filtre-gris">
        <div class="contact">
            <div class="contact-adresse">
                <div class="adresse-postale">
                    <h3>Contact</h3>
                    <span class="coordonnees-contact">123, avenue du Paradis</span>
                    <span class="coordonnees-contact">75012 Paris</span>
                    
                    <div class="coordonnees-tel"><strong>Téléphone : </strong><a href="tel:01 00 01 02 03" >01 00 01 02 03</a></div>
                    <div class="coordonnees-mail"><strong>Mail : </strong><a href="mailto:contact@Makisine.fr">contact@Makisine.fr</a></div>
                </div>
                <div class="horaire-contact"><br>
                    <h3>Horaire de contact</h3>
                    <p>Ouvert de 8h à 12h30 et de 13h30 à 20h<br>Du lundi au dimanche</p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php

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
	$mail->addAddress('pamakisine@gmail.com' );     //Add a recipient
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
?>
