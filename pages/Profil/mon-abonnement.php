<?php 
$connexion = connectDB();
$queryPrepared = $connexion->prepare("SELECT * FROM " . DB_PREFIX . "UTILISATEUR WHERE email = :email ");

$email = $_SESSION['email']; // Récupère l'e-mail de la session

$queryPrepared->bindParam(':email', $email); // Lie la valeur de $email au paramètre :email

$queryPrepared->execute();
$results = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
foreach ($results as $row) {
    if ($row['type_compte'] == 1) {
        echo "Vous êtes déjà abonné !";
        ?>
        <br>
        <nav class="nav flex-column">
        <a class="nav-link active" href="mon-compte">Retour à mon compte</a>
        </nav>
        <form action="core/unsubscribe.php" method="POST">
    <button type="submit" class="button3" onclick="confirmUnsubscribe()">Se désabonner</button>
</form>

<script>
    function confirmUnsubscribe() {
        if (confirm("Êtes-vous sûr de vouloir vous désabonner ? 😔")) {
            document.querySelector("form").submit();
        }
    }
</script>

    <?php
    } else { ?>
        <title>Abonnement Standard</title>

        <h1>Abonnement Standard - 10.00€/mois</h1>
        
        <img src="assets/images/Abonnement.png" alt="Image illustrative de l'abonnement">

        <p>Bienvenue dans notre abonnement Standard ! Profitez d'un accès complet à toutes nos fonctionnalités incroyables pour seulement 10€ par mois. Vous ne voulez pas manquer cette offre exclusive. Inscrivez-vous dès maintenant !</p>


            <a href = "pages/Abonnement/public/checkout.php" class = "button1">S'inscrire</a>

        <h2>Avantages de l'abonnement Standard :</h2>
        <ul>
            <li>Accès illimité à toutes les fonctionnalités de notre plateforme.</li>
            <li>Contenu exclusif réservé aux abonnés Standard.</li>
            <li>Support client prioritaire pour répondre à toutes vos questions.</li>
            <li>Mises à jour régulières avec de nouvelles fonctionnalités et améliorations.</li>
        </ul>

        <h2>Conditions de l'abonnement :</h2>
        <ul>
            <li>L'abonnement est facturé automatiquement chaque mois au tarif de 10€.</li>
            <li>Vous pouvez annuler votre abonnement à tout moment.</li>
        </ul>
    <?php }
}
?>