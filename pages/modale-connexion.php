<div id="modale-connexion" class="modale-connexion">
    <div class="modale-content-connexion">
        <div>
            <h1 class="h1-connexion">Me connecter</h1><span class="close" id="close-modale-connexion" onclick="fermerModaleConnexion()">&times;</span>
        </div>
        <div>
            <?php
            //On va vérifier que l'on a quelque chose dans $_POST
            //Ce qui signifie que le formulaire a été validé
            if (!empty($_POST['email']) &&  !empty($_POST['pwd'])) {

                $email = cleanEmail($_POST["email"]);
                $pwd = $_POST["pwd"];

                //Récupérer en bdd le mot de passe hashé pour l'email
                //provenant du formulaire
                $connect = connectDB();
                $queryPrepared = $connect->prepare("SELECT pwd FROM " . DB_PREFIX . "UTILISATEUR WHERE email=:email");
                $queryPrepared->execute(["email" => $email]);
                $results = $queryPrepared->fetch();

                if (!empty($results) && password_verify($pwd, $results["pwd"])) {
                    $_SESSION['email'] = $email;
                    $_SESSION['login'] = true;
                    header("Location: /Projet_Annuel_1ere_Annee/");
                } else {
                    echo "Identifiants incorrects";
                }
            }

            ?>
        </div> 
        <div>
            <form class="form-connexion" method="POST">
                <div class="champ">
                    <input autocomplete="off" placeholder="Veuillez entrer votre adresse email" class="input-champ" type="email">
                </div>
                <div class="champ">
                    <input placeholder="Et votre mot de passe" class="input-champ" type="password">
                </div>
                <div class="btn">
                    <button class="button1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Se connecter&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                    <a class="button2" onclick="fermerSeConnecteEtOuvrirInscription()"> S'inscrire </a>
                </div>
                <div class="alert alert-danger" role="alert">Erreur lors de la connexion</div>
                <a class="button3">Mot de passe oublié</a>
            </form>
        </div>
    </div>
</div>