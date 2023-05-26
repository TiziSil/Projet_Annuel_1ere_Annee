<?php
// require "conf.inc.php";
require "core/functions.php";
//redirectIfNotConnected(); 
?>

<section id="attente-validation">
    <div>
        <div class="image-attente-validation">
            <h1 class="h1-attente-validation">Gestion des validations en attente</h1>
        </div>


        <!-- Recette en attente de validation -->

        <div>
            <h2 class="h2-recette-validation-attente">Recettes en attente de validation</h2>
        </div>


        <?php
        $connection = connectDB();
        $results = $connection->query("SELECT id_recette, nom_recette, difficulte, temps_preparation, description_recette, nom_categorie FROM " . DB_PREFIX .
            "APPARTENIR, " . DB_PREFIX . "CATEGORIE, " . DB_PREFIX . "RECETTE WHERE statut_publication= -1 && recette_categorie = id_recette  && categorie = id_categorie");
        $results = $results->fetchAll()
        ?>


        <div class="">
            <div class="">
                <table class="table">
                    <caption></caption>
                    <thead>
                        <tr>
                            <th>Référence</th>
                            <th>Catégorie</th>
                            <th>Difficulté</th>
                            <th>Durée</th>
                            <th>Recette</th>
                            <th>Ingredients</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($results as $recipe) {
                            echo "<tr>";
                            echo "<td>" . $recipe["id_recette"] . "</td>";
                            echo "<td>" . $recipe["nom_categorie"] . "</td>";
                            echo "<td>" . $recipe["difficulte"] . "</td>";
                            echo "<td>" . $recipe["temps_preparation"] . "</td>";
                            echo "<td>" . $recipe["nom_recette"] . "<br><br>" . $recipe["description_recette"] . "</td>";
                            echo "<td><a href='core/recipeValidation.php?id_recette=" . $recipe["id_recette"] . "' class='btn btn-success'>Valider</a><br><br>
                        <a href='core/recipeReject.php?id_recette=" . $recipe["id_recette"] . "' class='btn btn-danger'>Refuser</a></td>";
                            echo "</tr>";
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>