<?php
    $connection = connectDB();

    $results = $connection->query("SELECT id_recette, nom_recette, difficulte, temps_preparation, description_recette, nom_categorie, image_recette
                            FROM " . DB_PREFIX . "APPARTENIR, " . DB_PREFIX . "CATEGORIE, " . DB_PREFIX . "RECETTE
                            WHERE statut_publication = 1 AND recette_categorie = id_recette
                            AND categorie = id_categorie");
    $results = $results->fetchAll();

?>


<section id="recettes" class="col">
    <div class="py-4 text-bg">
        <div class=" titre-tuile-4 d-flex justify-content-center align-items-center">
            <svg width="48px" height="48px">
                <image height="48px" width="48px" href="assets/images/open-book.svg" />
            </svg>
            <a href = "afficher-recette">
            <h2 class="align-items-center titre-tuile-4">Recettes</h2>
            </a>
        </div>
    </div>
    <div class="container">
        <div class="tuile-4">
            <div class="d-flex flex-wrap liste-recette">
            <?php
                foreach ($results as $recette) {
                    echo "<div>";
                    echo "<h4>".$recette["nom_recette"]."</h4>";
                    echo "<img src='" . $recette['image_recette'] . "'>";
                    echo "<a href='../recette?id=".$recette["id_recette"]."'>";
            ?>
               
                        <svg width="48px" height="48px">
                            <image height="48px" width="48px" href="assets\images\utensils-solid.svg" />
                        </svg>
                    </a>
                </div>
            <?php } ?>

            </div>
        </div>
</section>