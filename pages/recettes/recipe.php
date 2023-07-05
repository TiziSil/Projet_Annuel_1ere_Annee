<?php
    $id_recipe = $_GET['id'];

    $connection = connectDB();
    $results = $connection->query("SELECT id_recette, nom_recette, difficulte, temps_preparation, description_recette, nom_categorie, auteur_recette
                            FROM " . DB_PREFIX . "APPARTENIR, " . DB_PREFIX . "CATEGORIE, " . DB_PREFIX . "RECETTE
                            WHERE statut_publication = 1 AND recette_categorie = id_recette
                            AND categorie = id_categorie AND id_recette = '" . $id_recipe . "'");
    $results = $results->fetchAll();

    $recipe_name = $connection->query("SELECT nom_recette FROM ".DB_PREFIX."RECETTE WHERE id_recette = '" . $id_recipe . "'");
    $recipe_name = $recipe_name->fetch();
    
?>
<section class="recipe">
    <div class=" titre-principal d-flex justify-content-center align-items-center">
        <h1><?= $recipe_name['nom_recette'] ?></h1>
    </div>
    <div class="contenu-milieu">
        <div class="row">
            <div class="col-6">
                <?php 
                    foreach ($results as $recipe) {
                        echo "<b>Préparation</b><br>".$recipe["description_recette"]; 
                        echo "<br><br><b>Temps de préparation</b><br>".$recipe["temps_preparation"]." minutes";
                        echo "<br><br><b>Difficulte</b><br>";
                        for ($i = 0; $i <= $recipe["difficulte"]; $i++) {
                            echo "<img src='assets/difficulte.png' alt='Image' width='40px'>";
                        }
                        echo "<br><br><b>Auteur</b><br>".$recipe["auteur_recette"];
                        echo "<br><br><b>Ingrédients</b><br>"; }
                ?>
            </div>
            <div class="col-6">
                <img src="assets/images/backoffice-background.jpg" width="600px">
            </div>
        </div>
    </div>
</section>