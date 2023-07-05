//php mailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
//!!!!!!!!!!!!!!
//require 'C:\Users\Mathis\vendor\autoload.php';
require '../vendor/autoload.php'; //mettre le chemin pour le serveur
//!!!!!!!!!!!!!!

//Create an instance; passing `true` enables exceptions
	$mail = new PHPMailer(true);


	//Server settings
	//$mail->SMTPDebug =2;                      //Enable verbose debug output
	$mail->isSMTP();                                            //Send using SMTP
	$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
	$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	$mail->Username   = 'pamakisine@gmail.com';                     //SMTP username
	$mail->Password   = 'ngjzeprsrycjzbzx';      //eonrxdnodvegnjrp                         //SMTP password
	$mail->SMTPSecure = 'TLS';            //Enable implicit TLS encryption
	$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

	//Recipients
	$mail->setFrom('ne-pas-repondre@makisine.com');
	$mail->addAddress($email, $pseudo );     //Add a recipient
	// $mail->addAddress('ellen@example.com');               //Name is optional
	$mail->addReplyTo('pamakisine@gmail.com');
	// $mail->addCC('cc@example.com');
	// $mail->addBCC('bcc@example.com');

	//Attachments
	// $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
	// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

	//Content
	$mail->isHTML(true);                                  //Set email format to HTML
	$mail->Subject = 'Bienvenue sur Makisine';
	$mail->Body    = 'Bienvenue sur notre site <b>Makisine</b>';
	$mail->AltBody = 'Bienvenue sur notre site Makisine';

	$mail->send();