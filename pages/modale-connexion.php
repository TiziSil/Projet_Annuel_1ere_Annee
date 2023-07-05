
<div id="modale-connexion" class="modale-connexion">
    <div class="modale-content-connexion">
        <span class="close" id="close-modale-connexion" onclick="fermerModaleConnexion()">&times;</span>
        <div>
            <h1 class="h1-connexion">Me connecter</h1>
        </div>
        <div>
            <form class="form-connexion" action="core/connexion.php" method="POST">
                <div class="champ">
                    <input autocomplete="off" placeholder="Veuillez entrer votre adresse email" class="input-champ" type= "email" name="email" value="<?= ( !empty($_SESSION["data"]))?$_SESSION["data"]["email"]:""; ?>">
                </div>
                <div class="champ">
                    <input placeholder="Et votre mot de passe" class="input-champ" type="password" name = "pwd">
                </div>
                <div class="btn">
                    <button class="button1">Se connecter</button>
                    <a class="button2" onclick="fermerSeConnecteEtOuvrirInscription()"> S'inscrire </a>
                </div>

                <a href="./mot-de-passe-oublie" class="button3">Mot de passe oublié</a>
            </form>
        </div>
    </div>
</div>