<?php
// require "conf.inc.php";
// require "core/functions.php";
//redirectIfNotConnected(); 
//LOGS
$date = "[".date("Y-m-d H:i:s")."]";

$url = $_SERVER['REMOTE_ADDR'].' conect to ' .$_SERVER['SERVER_NAME'] .$_SERVER['PHP_SELF'];


$files = fopen("log.txt", "a+");
fputs($files, $date." ".$url."\n");
fclose($files);
?>

<?php
$connection = connectDB();
$results = $connection->query("SELECT id_recette, nom_recette, difficulte, temps_preparation, description_recette, nom_categorie FROM " . DB_PREFIX .
    "APPARTENIR, " . DB_PREFIX . "CATEGORIE, " . DB_PREFIX . "RECETTE WHERE statut_publication= -1 && recette_categorie = id_recette  && categorie = id_categorie");
$results = $results->fetchAll()
?>

<section id="attente-validation">
    <div class="container ">
        
    <div id="afficher-recette" class="modal py-5">
        <div class="modal-content">
            <span class="close" onclick="fermerModalAfficheRecette()">&times;</span>
                <h2 id="afficher-recette-titre"></h2>
            <p id="afficher-recette-description"></p>
        </div>
    </div>

        <div class="image-attente-validation">
            <h1 class="h1-attente-validation">Gestion des validations en attente</h1>
        </div>

        <div class="bloc-en-attente-validation">
            <div>
                <h2 class="h2-recette-validation-attente">Recettes en attente de validation</h2>
            </div>
            <div class="table-en-attente-validation">
                <table class="table ">
                    <thead>
                        <tr class="tr-td-attente-validation">
                            <th>Référence</th>
                            <th>Nom</th>
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
                            echo "<td>" . $recipe["nom_recette"] . "</td>";
                            echo "<td>" . $recipe["nom_categorie"] . "</td>";
                            echo "<td>" . $recipe["difficulte"] . "</td>";
                            echo "<td>" . $recipe["temps_preparation"] . "</td>";
                            echo "<td><button class='button2' onclick='ouvrirModaleAfficherRecette(" . $recipe["id_recette"] . ")'>Recette</button></td>";
                            echo "<td></td>";
                            echo "<td><a href='core/recipeValidation.php?id_recette=" . $recipe["id_recette"] . "' class='btn button4'>Valider</a><a href='core/recipeReject.php?id_recette=" . $recipe["id_recette"] . "' class='btn btn-danger'>Refuser</a></td>";
                            echo "</tr>";
                        } ?>
                    </tbody>
                </table>
                <div>
            <nav class="nav flex-column">
                <a class="nav-link active button3 retour-mon-compte" href="mon-compte">Retour à mon compte</a>
            </nav>
        </div>
            </div>
        </div>
        
    </div>
    
</section>
