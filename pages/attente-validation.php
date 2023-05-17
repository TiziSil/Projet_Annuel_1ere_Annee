<?php
require "conf.inc.php";
require "core/functions.php";
//redirectIfNotConnected(); 
?>

	<div class="row mt-1">
		<div class="col-12">
        <h1>Gestion des validations en attente</h1>
		</div>
	</div>


<!----------------------------------------------------------------------------------------------------------------->


    <!-- Recette en attente de validation -->

    <div class="row">
		<div class="col-12">
        <h2>Recette en attente de validation</h2>
		</div>
	</div>


    <?php

        $connection = connectDB();
        $results = $connection->query("SELECT id_recette, nom_recette, difficulte, temps_preparation, description_recette, nom_categorie FROM ".DB_PREFIX.
        "APPARTENIR, ".DB_PREFIX."CATEGORIE, ".DB_PREFIX."RECETTE WHERE statut_publication= -1 && recette_categorie = id_recette  && categorie = id_categorie");
        $results = $results->fetchAll()
    ?>


    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Référence</th>
                        <th>Catégorie</th>
                        <th>Difficulté</th>
                        <th>Durée</th>
                        <th>Recette</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($results as $recipe) {
                        echo "<tr>";
                        echo "<td>".$recipe["id_recette"]."</td>";
                        echo "<td>".$recipe["nom_categorie"]."</td>";
                        echo "<td>".$recipe["difficulte"]."</td>";
                        echo "<td>".$recipe["temps_preparation"]."</td>";
                        echo "<td>".$recipe["nom_recette"]."<br><br>".$recipe["description_recette"]."</td>";
                        echo "<td><a href='core/recipeValidation.php?id_recette=".$recipe["id_recette"]."' class='btn btn-success'>Valider</a><br><br>
                        <a href='core/recipeReject.php?id_recette=".$recipe["id_recette"]."' class='btn btn-danger'>Refuser</a></td>";
                        echo "</tr>";
                        } ?>
                </tbody>
            </table>
            </div>
        </div>
