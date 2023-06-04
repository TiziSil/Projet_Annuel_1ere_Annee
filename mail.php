<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'C:\xampp/vendor/autoload.php';


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 3;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'pamakisine@gmail.com';                     //SMTP username
    $mail->Password   = 'ngjzeprsrycjzbzx';                               //SMTP password
    $mail->SMTPSecure = 'TLS';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('ne-pas-repondre@makisine.com');
    $mail->addAddress('mathis2000.te@hotmail.fr', 'Mathis TE');     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('pamakisine@gmail.com', 'Information');
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
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

// $mail->SMTPDebug = 2;                      //Enable verbose debug output
// $mail->isSMTP();                                            //Send using SMTP
// $mail->Host       = 'smtp.office365.com';                     //Set the SMTP server to send through
// $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
// $mail->Username   = 'makisine@outlook.com';                     //SMTP username
// $mail->Password   = 'ProjetAnnuel2023MKS@';                               //SMTP password
// $mail->SMTPSecure = 'STARTTLS';            //Enable implicit TLS encryption
// $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
