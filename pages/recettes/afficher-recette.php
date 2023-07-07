
<!-- Formulaire pour filtrer par allergene-->
<div class=" titre-principal d-flex justify-content-center align-items-center">
        <h1>Trouvez la recette qui vous convient !</h1>
</div>

<form method="get" action="">
    <section class="filters d-flex justify-content-center align-items-center">
        <div class="row mt-3 justify-content-center align-items-center">
            Recette sans :
            <div class="col">
                <select name="allergene" class="form-select">
                    <option value="" disabled selected>Sélectionnez un allergène</option>
                    <option value="">Toutes les recettes</option>
                    <?php
                        $results2 = $connection->query("SELECT nom_allergene, id_allergene FROM " . DB_PREFIX . "ALLERGENE");
                        $results2 = $results2->fetchAll();

                        foreach ($results2 as $allergene) {
                            echo "<option value='".$allergene["id_allergene"]."'>".$allergene["nom_allergene"]."</option>";
                        }                  
                    ?>
                </select>
            </div>
            <div class="col-2">
                <button type="submit" class="button1">Afficher</button>
            </div>
        </div>
    </section>
</form>

<section class="recipe-list">
    <div class="contenu-milieu">
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Difficulté</th>
                        <th>Catégorie</th>
                        <th>Durée</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $id_allergene = isset($_GET['allergene']) ? $_GET['allergene'] : null;

                    $queryPrepare = $connection->prepare("SELECT id_recette, nom_recette, difficulte, temps_preparation, description_recette, nom_categorie
                        FROM MAKISINE_APPARTENIR, MAKISINE_RECETTE, MAKISINE_CATEGORIE 
                        WHERE statut_publication = 1 
                        AND id_recette = recette_categorie 
                        AND id_categorie = categorie 
                        AND id_recette NOT IN (
                            SELECT id_recette FROM MAKISINE_ALLERGENE, MAKISINE_INGREDIENT, MAKISINE_CONTENIR, MAKISINE_RECETTE, MAKISINE_CONSTITUER 
                            WHERE id_allergene = allergene 
                            AND id_ingredient = produit 
                            AND id_ingredient = ingredient 
                            AND id_recette = preparation 
                            AND allergene = :id_allergene)");
                    $queryPrepare -> execute([ "id_allergene" => $id_allergene]);
                    $results3 = $queryPrepare->fetchAll();

                    foreach ($results3 as $recipe_s_allergene) {
                        echo "<tr>";
                        echo "<td>" . $recipe_s_allergene["nom_recette"] . "</td>";
                        echo "<td>";
                        for ($i = 0; $i <= $recipe_s_allergene["difficulte"]; $i++) {
                            echo "<img src='assets/difficulte.png' alt='Image' width='30px'> ";
                        }
                        echo "</td>";
                        echo "<td>".$recipe_s_allergene["nom_categorie"]."</td>";
                        echo "<td>" . $recipe_s_allergene["temps_preparation"] . " minutes</td>";
                        echo "<td>
                        <a href='../recette?id=".$recipe_s_allergene["id_recette"]."' class='btn btn-dark'>
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