<section class="deja-abonne d-flex flex-column py-5">
    <div class="container d-flex flex-column py-5 my-5">
        <?php
        $connexion = connectDB();
        $queryPrepared = $connexion->prepare("SELECT * FROM " . DB_PREFIX . "UTILISATEUR WHERE email = :email ");
        $email = $_SESSION['email']; // Récupère l'e-mail de la session
        $queryPrepared->bindParam(':email', $email); // Lie la valeur de $email au paramètre :email
        $queryPrepared->execute();
        $results = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as $row) {
            if ($row['type_compte'] == 1) { ?>
                <h1 class='h1-abonnement-ok'>Merci ! <br />Vous êtes déjà abonné !</h1>
                <div class="boite d-flex flex-row justify-content-between">
                    <div class="d-flex flex-column flex-fill mx-1">
                        <a class="clickable button2" href="mon-compte">Retour à mon compte</a>
                    </div>
                    <form class="d-flex flex-column flex-fill mx-1" action="core/unsubscribe.php" method="POST">
                        <button class="button2" type="submit" onclick="confirmUnsubscribe()">Se désabonner</button>
                    </form>
                </div>
            <?php } else { ?>
                <div class="boite d-flex flex-column">
                    <h1>Abonnement Standard - 10.00€/mois</h1>
                    <div class="d-flex flex-row justify-content-center">
                        <img class="d-flex img-supprimer-fond-blanc" src="assets/images/Abonnement.png"
                            alt="Image illustrative de l'abonnement">
                    </div>
                    <p>Bienvenue dans notre abonnement Standard ! Profitez d'un accès complet à toutes nos fonctionnalités
                        incroyables pour seulement 10€ par mois. Vous ne voulez pas manquer cette offre exclusive.
                        Inscrivez-vous
                        dès maintenant !</p>
                    <a href="pages/Abonnement/public/checkout.php" class="button2">S'inscrire</a>
                </div>
            </div>
        </section>

        <section class="section-radis" class="col">
            <img src="assets/images/separateur.png" class="separateur-de-texte-contact">
        </section>
        
        <section class="avantage-abonne py-5">
            <div class="container py-5 my-5">
                <div class="boite">
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
                </div>
            </div>
        <?php }
        } ?>
    </div>
</section>

<script>
    function confirmUnsubscribe() {
        if (confirm("Êtes-vous sûr de vouloir vous désabonner ? 😔")) {
            document.querySelector("form").submit();
        }
    }
</script>