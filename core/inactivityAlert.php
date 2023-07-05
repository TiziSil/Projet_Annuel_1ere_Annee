<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require "../conf.inc.php";
    require "functions.php";

    require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';

    //require 'C:\Users\kirti\phpmailer\vendor\autoload.php';
    require '../vendor/autoload.php';

    $connection = connectDB();
    $results = $connection->query("SELECT email,pseudo FROM ".DB_PREFIX."UTILISATEUR WHERE (date_updated < DATE_SUB(NOW(), INTERVAL 1 MONTH)) or (date_updated IS NULL)");
    $results = $results -> fetchAll();

	foreach($results as $user) {
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'pamakisine@gmail.com';
        $mail->Password   = 'ngjzeprsrycjzbzx';
        $mail->SMTPSecure = 'TLS';
        $mail->Port       = 587;
    
        $mail->setFrom('ne-pas-repondre@makisine.com');
        $mail->addAddress($user["email"], $user["pseudo"] );
        $mail->addReplyTo('pamakisine@gmail.com');
    
        $mail->isHTML(true);
        $mail->Subject = 'Vous nous manquez !';
        $mail->Body    = 'Cela fait plusieurs mois que nous ne avions pas vu ! De nouvelles recettes vous attendent ! <a href="https://makisine.fr/" target="_blank"><button type="button">Voir le site</button></a>';
        $mail->AltBody = 'Cela fait plusieurs mois que nous ne avions pas vu ! De nouvelles recettes vous attendent !';
    
        $mail->send();
	} ?>

<script>
    alert('Les alertes ont ete envoyes avec succes.');
</script>

<?php
    redirection('../mon-compte');