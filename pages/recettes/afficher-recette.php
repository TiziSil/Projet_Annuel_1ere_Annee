
<!-- Formulaire pour filtrer par allergene-->
<div class=" titre-principal d-flex justify-content-center align-items-center">
        <h1>Trouvez la recette qui vous convient !</h1>
</div>

<form method="get" action="">
    <section class="filters d-flex justify-content-center align-items-center">
        <div class="row mt-3 justify-content-center align-items-center">
            Recette sans :
            <div class="col-5">
                <select name="allergene" class="form-select">
                    <option value="" disabled selected>Sélectionnez un allergène</option>
                    <option value="">Toutes les recettes</option>
                    <?php
                        $connection = connectDB();
                        $results2 = $connection->query("SELECT nom_allergene, id_allergene FROM " . DB_PREFIX . "ALLERGENE");
                        $results2 = $results2->fetchAll();

                        foreach ($results2 as $allergene) {
                            echo "<option value='".$allergene["id_allergene"]."'>".$allergene["nom_allergene"]."</option>";
                        }                  
                    ?>
                </select>
            </div>

            <div class="col-1">
                ou
            </div>

            <div class="col-4">
                <input type="text" name="nom_recherche" class="form-control" placeholder="Rechercher par nom">
            </div>
        </div>
        <div class="row mt-3 justify-content-center align-items-center" style="margin-left: 50px;">
            <button type="submit" class="button1">Rechercher</button>
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
                    $nom_recherche = isset($_GET['nom_recherche']) ? $_GET['nom_recherche'] : null;

                    $queryPrepare = $connection->prepare("SELECT id_recette, nom_recette, difficulte, temps_preparation, description_recette, nom_categorie
                        FROM " . DB_PREFIX . "APPARTENIR, " . DB_PREFIX . "RECETTE, " . DB_PREFIX . "CATEGORIE 
                        WHERE statut_publication = 1 
                        AND id_recette = recette_categorie 
                        AND id_categorie = categorie
                        AND nom_recette LIKE :nom_recherche
                        AND id_recette NOT IN (
                            SELECT id_recette FROM " . DB_PREFIX . "ALLERGENE, " . DB_PREFIX . "INGREDIENT, " . DB_PREFIX . "CONTENIR, " . DB_PREFIX . "RECETTE, " . DB_PREFIX . "CONSTITUER 
                            WHERE id_allergene = allergene 
                            AND id_ingredient = produit 
                            AND id_ingredient = ingredient 
                            AND id_recette = preparation 
                            AND allergene = :id_allergene)");
                    $queryPrepare -> execute([ 
                                                "id_allergene" => $id_allergene,
                                                "nom_recherche" => '%' . $nom_recherche . '%'
                                            ]);
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