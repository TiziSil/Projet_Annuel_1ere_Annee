<?php include "pages/modale-connexion.php"; ?>
<?php include "pages/modale-inscription.php"; ?>
<?php include "conf.inc.php" ?>

<header>
  <div style="z-index:15;position: absolute;" class="collapse" id="navbarToggleExternalContent">
    <div class="p-4 text-bg col menu-burger">
      <button class="navbar-toggler burger-button burger-button-menu" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
        <svg width="32px" height="32px">
          <image height="32px" fill="#DEC7B1" width="32px" href="assets\images\burger-solid.svg" />
        </svg>
      </button>
      <a href="index.php#about-makisine">Qu'est ce que Makisine ?</a>
      <a href="index.php#categorie-recettes">Catégorie de recettes</a>
      <a href="index.php#recettes">Recettes</a>
      <a href="index.php#boutique">Notre boutique</a>
      <a href="index.php#pub">Promotions</a>
      <a href="index.php#footer">Nous contacter</a>
    </div>
  </div>
  <div class="py-2 text-bg">
    <div class="container-fluid text-center">
      <div class="mx-3 d-flex align-items-center">
        <div class="col">
          <button class="navbar-toggler burger-button" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
            <svg width="32px" height="32px">
              <image height="32px" fill="#DEC7B1" width="32px" href="assets\images\burger-solid.svg" />
            </svg>
          </button>
        </div>


        <div class="col logo">
          <img src="assets\images\Logo_light.png" alt="Makisine">
        </div>

        <div class="col">
          <a href="#" onclick="ouvrirModaleConnexion()" class="mon-compte-button" title="Mon compte">
            <svg fill="white" class="d-block" width="32px" height="32px">
              <use href="#people-circle" />
            </svg>
          </a>
        </div>

      </div>
    </div>
  </div>
</header>