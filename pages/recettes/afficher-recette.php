<?php
// require "conf.inc.php";
// require "core/functions.php";
//redirectIfNotConnected(); 
?>

<?php
$connection = connectDB();
$results = $connection->query("SELECT id_recette, nom_recette, difficulte, temps_preparation, description_recette, nom_categorie FROM " . DB_PREFIX .
    "APPARTENIR, " . DB_PREFIX . "CATEGORIE, " . DB_PREFIX . "RECETTE WHERE statut_publication= -1 && recette_categorie = id_recette  && categorie = id_categorie");
$results = $results->fetchAll();

?>

<div>
    <h1>Recettes</h1>
</div>
<div>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th>Référence</th>
                    <th>Nom</th>
                    <th>Catégorie</th>
                    <th>Difficulté</th>
                    <th>Durée</th>
                    <th>Recette</th>


                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($results as $recipe) {
                    echo "<tr>";
                    echo "<td>" . $recipe["id_recette"] . "</td>";
                    echo "<td>" . $recipe["nom_recette"] . "</td>";
                    echo "<td>" . $recipe["nom_categorie"] . "</td>";
                    echo "<td>" . $recipe["difficulte"] . "</td>";
                    echo "<td>" . $recipe["temps_preparation"] . "</td>";
                    echo "<td>" . $recipe["description_recette"] . "</td>";

                    echo "</tr>";
                    
                } ?>
            </tbody>
        </table>
    </div>
</div>
</div>
<nav class="nav flex-column">
<a class="nav-link active" href="index.php">Retour à l'accueil</a>
</nav>