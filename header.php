<?php if (!isConnected()) {
  include "pages/modale-connexion.php";
  include "pages/modale-inscription.php";
}
?>

<header>
  <div style="z-index:15;position: absolute;" class="collapse" id="navbarToggleExternalContent">
    <div class="p-4 text-bg col menu-burger">
      <button class="navbar-toggler burger-button burger-button-menu" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <svg width="32px" height="32px">
          <image height="32px" fill="#DEC7B1" width="32px" href="assets\images\burger-solid.svg" />
        </svg>
      </button>

      <a href="index.php#about-makisine">Qu'est ce que Makisine ?</a>
      <a href="index.php#categorie-recettes">Catégorie de recettes</a>
      <a href="afficher-recette">Recettes</a>
      <a href="./forum">Forum</a>
      <a href="./contact">Nous contacter</a>
      <?php if (isConnected()) { ?>
        <a href="logout.php">Déconnexion</a>
        <a href="mon-compte">Mon compte</a>
      <?php } else {
      } ?>
    </div>
  </div>
  <div class="py-2 text-bg">
    <div class="container-fluid text-center">
      <div class="mx-3 d-flex align-items-center">
        <div class="col">
          <button class="navbar-toggler burger-button" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <svg width="32px" height="32px">
              <image height="32px" fill="#DEC7B1" width="32px" href="assets\images\burger-solid.svg" />
            </svg>
          </button>
        </div>


        <div class="col logo">
          <a href="index.php"><img src="assets\images\Logo_light.png" alt="Makisine"></a>
        </div>

        <div class="col">
          <div class="header-droite d-flex flex-row">

            <a href="#" onclick="activerDesactiveDarkMode()" class="header-droite-margin" style="margin-right: -4px;"
              title="Mode sombre">
              <svg fill="white" class="d-block" width="32px" height="32px">
                <image height="32px" fill="#FFFFFF" width="32px" href="./assets/images/moon-solid.svg" />
              </svg>
            </a>
            <?php if (isConnected()) {?>
              <a href="./mon-compte" class="header-droite-margin" title="Mon compte">
                <?php if(aAvatar()) {
                  require('pages/visionneuse-avatar.php');
                } else { ?>
                  <svg fill="white" class="d-block" width="32px" height="32px">
                    <use href="#people-circle" />
                  </svg>
                <?php } ?>
              </a>

              <a href="logout.php" class="header-droite-margin"  title="Se déconnecter">
                <svg fill="white" class="d-block" width="32px" height="32px">
                  <image height="32px" width="32px" href="assets/images/right-from-bracket-solid.svg" />
                </svg>
              </a>

            <?php } else { ?>
              <a href="#" onclick="ouvrirModaleConnexion()" class="header-droite-margin"  title="Se connecter">
                <svg fill="white" class="d-block" width="32px" height="32px">
                  <use href="#people-circle" />
                </svg>
              </a>
            <?php } ?>


          </div>
        </div>

      </div>
    </div>
  </div>
</header>