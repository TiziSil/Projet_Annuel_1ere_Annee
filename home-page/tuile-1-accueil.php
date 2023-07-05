<section id="accueil" class="col">
    <div class="container taille-tuile-1">
        <div class="gros-cercle col">
            <div class="titre-cercle col">
                <a href="mon-compte">
                    <?php if (!isConnected()) {
                        echo '<h2 class="h2-homepage" >Bienvenue sur Makisine !</h2>';
                    } else {
                        echo '<div><h2 class="h2-homepage">Bienvenue </h2></div><div><h2>' . $_SESSION['pseudo'] . ' !</h2></div>';
                    } ?>
            </div>
            <div class="contenu-cercle">
                <a href="#about-makisine" class="d-flex flex-row">
                    <svg width="32px" height="32px">
                        <image height="32px" width="32px" href="assets/images/chef.svg" />
                    </svg>
                    <h4>Qu'est-ce que Makisine ?</h4>
                </a>

                <?php if (!isConnected()) { ?>
                    <a href="#" onclick="ouvrirModaleInscription()" class="d-flex  lex-row">
                        <svg width="32px" height="32px">
                            <image style="margin-left:2px" height="28px" width="28px" href="assets/images/user-solid.svg" />
                        </svg>
                        <h4>S'inscrire</h4>
                    </a>
                <?php } else { ?>
                    <a href="mon-compte" class="d-flex flex-row">
                        <svg width="32px" height="32px">
                            <image style="margin-left:2px" height="28px" width="28px" href="assets/images/user-solid.svg" />
                        </svg>
                        <h4>Mon compte</h4>
                    </a>
                <?php } ?>

                <?php if (!isConnected()) { ?>
                    <a href="#" onclick="ouvrirModaleConnexion()" class="d-flex flex-row">
                        <svg width="32px" height="32px">
                            <image height="32px" width="32px" href="assets/images/user-lock-solid.svg" />
                        </svg>
                        <h4>Se connecter<h4>
                    </a>
                <?php } else { ?>
                    <a href="logout.php" class="d-flex flex-row">
                        <svg width="32px" height="32px">
                            <image height="32px" width="32px" href="assets/images/user-lock-solid.svg" />
                        </svg>
                        <h4>Se déconnecter</h4>
                    </a>
                <?php } ?>



            </div>
        </div>
    </div>
</section>