<?php
    $id_category = $_GET['id'];

    $connection = connectDB();

    $queryPrepared = $connection->prepare("SELECT id_recette, nom_recette, difficulte, temps_preparation, description_recette, nom_categorie
                            FROM " . DB_PREFIX . "APPARTENIR, " . DB_PREFIX . "CATEGORIE, " . DB_PREFIX . "RECETTE
                            WHERE statut_publication = 1 AND recette_categorie = id_recette
                            AND categorie = id_categorie AND categorie =:id_category");
    $queryPrepared->execute([ "id_category" => $id_category ]);
    $results = $queryPrepared->fetchAll();

    $queryPrepared2 = $connection->prepare("SELECT nom_categorie, categorie FROM ".DB_PREFIX."CATEGORIE, ".DB_PREFIX."APPARTENIR WHERE categorie=id_categorie 
                            && categorie =:id_category");
    $queryPrepared2->execute([ "id_category" => $id_category ]);
    $category_name = $queryPrepared2->fetch();
    
?>
<section class="recipe-list">
    <div class=" titre-principal d-flex justify-content-center align-items-center">
        <h1>Recettes de la catégorie <?= $category_name['nom_categorie'] ?></h1>
    </div>
    <div class="contenu-milieu">
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Difficulté</th>
                        <th>Durée</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($results as $recipe) {
                        echo "<tr>";
                        echo "<td>" . $recipe["nom_recette"] . "</td>";
                        echo "<td>";
                        for ($i = 0; $i <= $recipe["difficulte"]; $i++) {
                            echo "<img src='assets/difficulte.png' alt='Image' width='30px'> ";
                        }
                        echo "</td>";
                        echo "<td>" . $recipe["temps_preparation"] . " minutes</td>";
                        echo "<td>
                        <a href='../ProjetAnnuel/recette?id=".$recipe["id_recette"]."' class='btn btn-dark'>
                        Voir la recette
                        </a>
                        </td>";
                        echo "</tr>";
                        
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>
</section>