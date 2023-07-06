<?php
    $id_recipe = $_GET['id'];

    $connection = connectDB();
    $queryPrepared = $connection->prepare("SELECT id_recette, nom_recette, difficulte, temps_preparation, description_recette, nom_categorie, pseudo
                            FROM " . DB_PREFIX . "APPARTENIR, " . DB_PREFIX . "CATEGORIE, " . DB_PREFIX . "RECETTE, " . DB_PREFIX . "UTILISATEUR
                            WHERE statut_publication = 1 AND recette_categorie = id_recette
                            AND categorie = id_categorie AND auteur_recette = id_utilisateur AND id_recette =:id_recipe");
    $queryPrepared->execute([ "id_recipe" => $id_recipe ]);
    $results = $queryPrepared->fetchAll();

    $queryPrepared2 = $connection->prepare("SELECT nom_recette FROM ".DB_PREFIX."RECETTE WHERE id_recette =:id_recipe");
    $queryPrepared2->execute([ "id_recipe" => $id_recipe ]);
    $recipe_name = $queryPrepared2->fetch();

    $queryPrepared3 = $connection->prepare("SELECT nom_ingredient, quantite_ingredient FROM ".DB_PREFIX."CONSTITUER, ".DB_PREFIX."INGREDIENT WHERE 
                                id_ingredient = ingredient && preparation =:id_recipe");
    $queryPrepared3->execute([ "id_recipe" => $id_recipe ]);
    $ingredients_list = $queryPrepared3->fetchAll();

?>
<section class="recipe">
    <div class=" titre-principal d-flex justify-content-center align-items-center">
        <h1><?= $recipe_name['nom_recette'] ?></h1>
    </div>
    <div class="contenu-milieu">
        <div class="row bloc-ferme">
            <div class="col-6">
                <?php 
                    foreach ($results as $recipe) {
                        echo "<b>Préparation</b><br>".$recipe["description_recette"]; 
                        echo "<br><br><b>Temps de préparation</b><br>".$recipe["temps_preparation"]." minutes";
                        echo "<br><br><b>Difficulte</b><br>";
                        for ($i = 0; $i <= $recipe["difficulte"]; $i++) {
                            echo "<img src='assets/difficulte.png' alt='Image' width='60px'>";
                        }
                        echo "<br><br><b>Auteur</b><br>".$recipe["pseudo"];
                        echo "<br><br><b>Ingrédients</b><br>"; }
                        foreach ($ingredients_list as $ingredient) {
                            echo "<li>".$ingredient["quantite_ingredient"]." ".$ingredient["nom_ingredient"]."</li>";
                        }

                ?>
            </div>
            <div class="col-6">
                <img src="assets/images/backoffice-background.jpg" width="600px">
            </div>
        </div>

        <?php
        if(isConnected()) {
            $email = $_SESSION['email'];
            $queryPrepared = $connection->prepare("SELECT role_utilisateur FROM ".DB_PREFIX."UTILISATEUR WHERE email=:email");
            $queryPrepared->execute([ "email" => $_SESSION["email"] ]);
            $role= $queryPrepared->fetch();

            if ($role['role_utilisateur'] == 1) {
            ?>
            <form action="core/recipeDel.php" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ?');">
                <input type="text" name="id_recipeDel" value="<?= $id_recipe?>" style="display: none;">
                <input type="submit" value="Supprimer la recette" class="btn btn-danger" style="color: white !important; margin-top: 50px;">
            </form>
            <?php }} ?>
        
    </div>
</section>
