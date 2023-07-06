<section id="categorie-recettes" class="col">
    <div class="py-4 text-bg">
        <div class=" titre-tuile-2 d-flex justify-content-center align-items-center">
            <svg width="48px" height="48px">
                <image height="48px" width="48px" href="assets/images/cupcake.svg" />
            </svg>
            <h2 class="align-items-center titre-tuile-3">Catégorie de recettes</h2>
        </div>
    </div>
    <div class="container">
        <div class="tuile-3">
            <div class="tuile-3-interieur d-flex justify-content-center">
                <div class="d-flex py-5">
                    <div class="col">
                        <ul class="tableau">

                		<?php
                            // Affichage des catégories
                            $connection = connectDB();
                        	$results = $connection->query("SELECT * FROM ".DB_PREFIX."CATEGORIE");
                        	$results = $results->fetchAll();

                            foreach ($results as $category) {
                                echo "<a href='../categorie-recette?id=".$category["id_categorie"]."'><button type='button' class='button1'>".$category["nom_categorie"]."</button></a>";
                            }
                		?>

                        </ul>

            </div>
        </div>
</section>