<!DOCTYPE html>
<html>
<head>
    <title>Page de test pour l'envoi de courriel</title>
</head>
<body>

    <?php
    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire
        $to = $_POST["to"];
        $subject = $_POST["subject"];
        $message = $_POST["message"];
        $headers = "From: pamakisine@gmail.com\r\n";
        $headers .= "Reply-To: reply@example.com\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        // Envoi du courriel
        if (mail($to, $subject, $message, $headers)) {
            echo "<p>Courriel envoyé avec succès à $to.</p>";
        } else {
            echo "<p>Une erreur s'est produite lors de l'envoi du courriel.</p>";
        }
    }
    ?>

    <h1>Page de test pour l'envoi de courriel</h1>

    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="to">Destinataire :</label>
        <input type="email" name="to" id="to" required><br><br>

        <label for="subject">Sujet :</label>
        <input type="text" name="subject" id="subject" required><br><br>

        <label for="message">Message :</label><br>
        <textarea name="message" id="message" rows="5" cols="40" required></textarea><br><br>

        <input type="submit" value="Envoyer">
    </form>

</body>
</html>
