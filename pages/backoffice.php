<?php
//redirectIfNotConnected(); 
//session_destroy();
?>

		<div class="row mt-1">
			<div class=" titre-principal d-flex justify-content-center align-items-center">
				<h1>Bienvenue dans votre espace personnel</h1>
			</div>
		</div>

	<!----------------------------------------------------------------------------------------------------------------->


	<section>

		<div class="row">
			<div class=" titre-secondaire col-12">
			<h2>Gestion des catégories</h2>
			</div>
		</div>

	<!----------------------------------------------------------------------------------------------------------------->


		<!-- Affichage des catégories -->

		<div class="row mt-3">
			<div class="col-12">
				<div class="form-check form-switch">
  					<input id="btn_affichagecategorie" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked">
 					<label class="form-check-label" for="flexSwitchCheckChecked">Visualiser toutes les catégories</label>
				</div>
			</div>
		</div>

		<div class="row mt-3">
			<div class="col-12">
				<div id= "d1">
					<ol class="col-6 col-lg-6 col-sm-10 list-group">

						<?php
							$connection = connectDB();
							$results = $connection->query("SELECT * FROM ".DB_PREFIX."CATEGORIE");
							$results = $results->fetchAll();

							foreach ($results as $category) {
						?>
							
						<li class="list-group-item d-flex justify-content-between align-items-start">
							<div class="ms-2 me-auto">
								<div class="fw-bold"><?= $category["nom_categorie"];?></div>
							</div>
						
						<?php
							$results2 = $connection->query("SELECT COUNT(*) FROM ".DB_PREFIX."APPARTENIR WHERE categorie=".$category["id_categorie"]);
							$results2 = $results2->fetch();
								echo "<span class='badge bg-primary rounded-pill'>".$results2[0]." recettes</span></li>";
							}
						?>

					</ol>
				</div>
			</div>
		</div>

		

	<!----------------------------------------------------------------------------------------------------------------->


		<!-- Création d'une catégorie -->
		
		<!-- Alerte erreur nouvelle catégorie -->
		<?php if(isset($_SESSION['listOfErrorsCategory'])) {?>
		<div class="row mt-3">
			<div class="col-8 col-sm-6 col-lg-4">
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<?php
						echo "Catégorie invalide : ";
						foreach ($_SESSION['listOfErrorsCategory'] as $error)
						{
							echo $error;
						}
						unset($_SESSION['listOfErrorsCategory']);
					?>
				</div>
			</div>
		</div>
		<?php }


		// Alerte confirmation création
		if( isset($_SESSION['isCategoryCreated']) ) { ?>
		<div class="row mt-3">
			<div class="col-8 col-sm-6 col-lg-4">
				<div class="alert alert-success" role="alert">
					<p>La nouvelle catégorie a bien été créée !</p>
				</div>
				<?php
					unset($_SESSION['isCategoryCreated']);
				?>
			</div>
		</div>
		<?php } ?>


		<!-- Formulaire -->
		<form action="core/categoryAdd.php" method="POST">
			<div class="row mt-3 mb-3">
				<div class="col-8 col-sm-6 col-lg-4">
					<input type="text" class="form-control" name="nom_categorie" placeholder="Nouvelle catégorie" required="required" 
					value="">
				</div>
				<div class="col-2">
					<input type="submit" value="Créer la catégorie" class="button1">
				</div>
			</div>
		</form>


	<!----------------------------------------------------------------------------------------------------------------->


		<!-- Suppression d'une catégorie -->

		<!-- Alerte erreur supression catégorie -->
		<?php if(isset($_SESSION['listOfErrorsCategoryDel'])) {?>
			<div class="row mt-3">
				<div class="col-8 col-sm-6 col-lg-4">
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<?php

						foreach ($_SESSION['listOfErrorsCategoryDel'] as $error)
						{
							echo "<li>".$error."</li>";
						}
						unset($_SESSION['listOfErrorsCategoryDel']);
					?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				</div>
			</div>
		<?php }


		//Alerte confirmation suppression
		if( isset($_SESSION['isCategoryDeleted']) ) { ?>
		<div class="row mt-3">
			<div class="col-8 col-sm-6 col-lg-4">
				<div class="alert alert-success" role="alert">
					<p>La catégorie a bien été supprimée !</p>
				</div>
				<?php 
					unset($_SESSION['isCategoryDeleted']);
				?>
			</div>
		</div>
		<?php } ?>


		<!-- Formulaire -->
		<form action="core/categoryDel.php" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ?');">
			<div class="row mt-3 mb-3">
				<div class="col-8 col-sm-6 col-lg-4">
					<select class="form-select" name="id_categorieDel" required="required" value="<?= ( !isset($_SESSION["data"]))
					?$_SESSION["data"]["id_categorieDel"]:""; ?>">
						<option selected>Choisissez une catégorie</option>

						<?php
							$connection = connectDB();
							$results = $connection->query("SELECT id_categorie, nom_categorie FROM ".DB_PREFIX."CATEGORIE WHERE id_categorie NOT IN 
							(SELECT categorie FROM ".DB_PREFIX."APPARTENIR)");
							$results = $results->fetchAll();
						
							foreach ($results as $categorie) {
								echo "<option value='".$categorie["id_categorie"]."'>".$categorie["nom_categorie"]."</option>";
							} ?>
					</select> 
				</div>
				<div class="col-2">
					<input type="submit" value="Supprimer la catégorie" class="button1">
				</div>
			</div>
		</form>

		<p>&nbsp;Attention : seules les catégories vides peuvent être supprimées.</p>
	</section>



<!----------------------------------------------------------------------------------------------------------------->


<section>

	<div class="row">
		<div class=" titre-secondaire col-12">
		<h2>Gestion des ingrédients</h2>
		</div>
	</div>

<!----------------------------------------------------------------------------------------------------------------->


<!-- Affichage des ingrédients -->

	<div class="row mt-3">
		<div class="col-12">
			<div class="form-check form-switch">
  				<input id="btn_affichageingredient" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked">
 				<label class="form-check-label" for="flexSwitchCheckChecked">Visualiser toutes les ingrédients</label>
			</div>
		</div>
	</div>

		<div class="row mt-3">
			<div class="col-8 col-sm-6 col-lg-4">
				<div id= "d2">
					<table class="table table-hover table-striped">
						<thead>
							<tr>
								<th>Ingrédients</th>
								<th>Allergène(s)</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$connection = connectDB();
								$results = $connection->query("SELECT * FROM ".DB_PREFIX."INGREDIENT");
								$results = $results->fetchAll();

								foreach ($results as $ingredient) {
									$results2 = $connection->query("SELECT nom_allergene FROM ".DB_PREFIX."ALLERGENE, ".DB_PREFIX."CONTENIR WHERE id_allergene = allergene and produit=".$ingredient["id_ingredient"]);
									$results2 = $results2->fetchAll();

									echo "<tr>";
									echo "<td><b>".$ingredient["nom_ingredient"]."</b></td>";
							?>
									<td>
							<?php
									$allergeneArray = [];
									foreach ($results2 as $allergene) {
										$allergeneArray[] = $allergene["nom_allergene"];
									}
									echo implode(", ", $allergeneArray)
							?>
									</td>
									</tr>
							<?php	} ?>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>

		

<!----------------------------------------------------------------------------------------------------------------->


<!-- Suppression d'un ingrédient -->

<!-- Alerte erreur supression ingrédient -->
<?php if(isset($_SESSION['listOfErrorsIngredientDel'])) {?>
	<div class="row mt-3">
		<div class="col-8 col-sm-6 col-lg-4">
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<?php

				foreach ($_SESSION['listOfErrorsIngredientDel'] as $error)
				{
					echo "<li>".$error."</li>";
				}
				unset($_SESSION['listOfErrorsIngredientDel']);
			?>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		</div>
	</div>
<?php }


//Alerte confirmation suppression
if( isset($_SESSION['isIngredientDeleted']) ) { ?>
<div class="row mt-3">
	<div class="col-8 col-sm-6 col-lg-4">
		<div class="alert alert-success" role="alert">
			<p>L'ingrédient a bien été supprimé !</p>
		</div>
		<?php 
			unset($_SESSION['isIngredientDeleted']);
		?>
	</div>
</div>
<?php } ?>


<!-- Formulaire -->
<form action="core/ingredientDel.php" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ?');">
	<div class="row mt-3 mb-3">
		<div class="col-8 col-sm-6 col-lg-4">
			<select class="form-select" name="id_ingredientDel" required="required" value="">
				<option selected>Choisissez un ingrédient</option>

				<?php
					$connection = connectDB();
					$results = $connection->query("SELECT id_ingredient, nom_ingredient FROM ".DB_PREFIX."INGREDIENT WHERE id_ingredient NOT IN 
					(SELECT ingredient FROM ".DB_PREFIX."CONSTITUER)");
					$results = $results->fetchAll();
				
					foreach ($results as $ingredient) {
						echo "<option value='".$ingredient["id_ingredient"]."'>".$ingredient["nom_ingredient"]."</option>";
					} ?>
			</select> 
		</div>
		<div class="col-2">
			<input type="submit" value="Supprimer l'ingrédient" class="button1">
		</div>
	</div>
</form>

<p>&nbsp;Attention : seuls les ingrédients non utilisés dans les recettes peuvent être supprimés.</p>



<!----------------------------------------------------------------------------------------------------------------->


<!-- Création d'un ingrédient -->
<div class="row mt-3 mb-3">
	<div class="col-12">
		<h3>Ajouter un ingrédient</h3>
	</div>
</div>

<!-- Alerte erreur nouvel ingrédient -->
<?php if(isset($_SESSION['listOfErrorsIngredient'])) {?>
<div class="row mt-3">
	<div class="col-8 col-sm-6 col-lg-4">
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<?php
				echo "Ingrédient invalide : ";
				foreach ($_SESSION['listOfErrorsIngredient'] as $error)
				{
					echo $error;
				}
				unset($_SESSION['listOfErrorsIngredient']);
			?>
		</div>
	</div>
</div>
<?php }


// Alerte confirmation création
if( isset($_SESSION['isIngredientCreated']) ) { ?>
<div class="row mt-3">
	<div class="col-8 col-sm-6 col-lg-4">
		<div class="alert alert-success" role="alert">
			<p>Le nouvel ingrédient a bien été créé !</p>
		</div>
		<?php
			unset($_SESSION['isIngredientCreated']);
		?>
	</div>
</div>
<?php } ?>


<!-- Formulaire -->
<form action="core/ingredientAdd.php" method="POST">
	<div class="row mt-3 mb-3">
		<div class="col-8 col-sm-6 col-lg-4">
			<input type="text" class="form-control" name="nom_ingredient" placeholder="Nom de l'ingrédient" required="required" 
			value="<?= (!isset($_SESSION['data']))?$_SESSION['data']['nom_ingredient'][0]:""; ?>">
		</div>

		<div class="col-8 col-sm-6 col-lg-4">
			<div id="conteneur_allergene"></div>
			<div class="col" id="champs_allergene">
				<input type="text" class="form-control" name="nom_allergene[]" placeholder="Allergène" value="">
  			</div>
		</div>
		<div class="col-1">
			<button class='btn btn-link' id="btn-ajout-allergene"><img src="assets/bouton-ajout.png" width='20px' title="Ajouter un allergène" alt="Ajouter un allergène"></button>
		</div>
		<div class="col-1">
			<input type="submit" value="Ajouter l'ingrédient" class="button1">
		</div>
	</div>
</form>
</section>


<!----------------------------------------------------------------------------------------------------------------->

<section>
<div class="row mt-3">
	<div class="titre-secondaire col-12">
		<h2>Gestion des recettes</h2>
	</div>
</div>

<!----------------------------------------------------------------------------------------------------------------->



	<!-- Création d'une recette -->

	<div class="row mt-3">
		<div class="col-12">
			<h3>Créez votre propre recette !</h3>
		</div>
	</div>

</section>

<section class="section-radis" class="col">
	<img src="assets/images/separateur.png" class="separateur-de-texte-contact">
</section>

<section id="backoffice-recette">
	<div class="py-4 d-flex flex-column">
		<div class="container py-4">
			<div class="boite">

				<div class="row text-center">
					<h2>Créez votre propre recette !</h2>
				</div>
				<div class="d-flex flex-column">

	<!-- Alerte erreur création recette -->
	<?php if(isset($_SESSION['listOfErrorsRecipe'])) {?>
	<div class="row mt-3">
		<div class="col-8 col-sm-6 col-lg-4">
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<?php

				foreach ($_SESSION['listOfErrorsRecipe'] as $error)
				{
					echo "<li>".$error."</li>";
				}
					unset($_SESSION['listOfErrorsRecipe']);
			?>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		</div>
	</div>
	<?php }


	// Alerte confirmation création 
	if( isset($_SESSION['isRecipeCreated']) ) { ?>
		<div class="row mt-3">
			<div class="col-8 col-sm-6 col-lg-4">
				<div class="alert alert-success" role="alert">
					<p>La nouvelle recette a bien été créée !</p>
				</div>
			</div>
		</div>
		<?php
			unset($_SESSION['isRecipeCreated']);
		} ?>


	<!-- Formulaire -->
		<form action="core/recipeAdd.php" method="POST">

			<div class="mb-3 row">
				<label for="nom_recette" class="col-sm-2 col-form-label">Nom de la recette</label>
				<div class="col-10 col-sm-8 col-lg-6">
					<input type="text" class="form-control" name="nom_recette" placeholder="Nom de la recette" required="required" 
					value="<?= ( !isset($_SESSION["data"]))?$_SESSION["data"]["nom_recette"]:""; ?>">
				</div>
			</div>

			<div class="mb-3 row">
				<label for="id_categorie" class="col-sm-2 col-form-label">Catégorie</label>
				<div class="col-10 col-sm-8 col-lg-6">
					<select class="form-select" name="id_categorie" required="required" value="<?= ( !isset($_SESSION["data"]))
					?$_SESSION["data"]["id_categorie"]:""; ?>">
						<option selected>Choisissez une catégorie</option>

						<?php
							$connection = connectDB();
							$results = $connection->query("SELECT * FROM ".DB_PREFIX."CATEGORIE");
							$results = $results->fetchAll();
						
							foreach ($results as $categorie) {
								echo "<option value='".$categorie["id_categorie"]."'>".$categorie["nom_categorie"]."</option>";
							} ?>
					</select>
				</div>
			</div>

			<div class="mb-3 row">
				<label for="difficulte" class="col-sm-2 col-form-label">Niveau de difficulté</label>
				<div class="col-10 col-sm-8 col-lg-6">
					<input type="radio" class="form-check-input" value="0" <?= ( !isset($_SESSION["data"]) && $_SESSION["data"]["difficulte"]==0)
					?"checked":""; ?> checked = "checked" name="difficulte" id="easy">
					<label for="easy" class="form-label"> Facile </label> 
			
					<input type="radio" class="form-check-input" value="1" <?= ( !isset($_SESSION["data"]) && $_SESSION["data"]["difficulte"]==1)
					?"checked":""; ?> name="difficulte" id="medium">
					<label for="medium" class="form-label"> Moyen </label> 

					<input type="radio" class="form-check-input" value="2" <?= ( !isset($_SESSION["data"]) && $_SESSION["data"]["difficulte"]==2)
					?"checked":""; ?> name="difficulte" id="hard">
					<label for="hard" class="form-label"> Difficile </label> 
				</div>
			</div>

			<div class="mb-3 row">
				<label for="temps_preparation" class="col-sm-2 col-form-label">Temps de préparation (min)</label>
				<div class="col-10 col-sm-8 col-lg-6">
					<input type="text" class="form-control" name="temps_preparation" placeholder="Temps de préparation" required="required" value="<?= 
					( !isset($_SESSION["data"]))?$_SESSION["data"]["temps_preparation"]:""; ?>">
				</div>
			</div>

			<div class="mb-3 row">
				<label for="description_recette" class="col-sm-2 col-form-label">Étapes de préparation</label>
				<div class="col-10 col-sm-8 col-lg-6">
					<textarea class="form-control" name="description_recette" placeholder="Décrivez les étapes de préparation" required="required" 
					value="<?= ( !isset($_SESSION["data"]))?$_SESSION["data"]["description_recette"]:""; ?>" rows="7"></textarea>
				</div>
			</div>

			<div class="mb-3 row">
				<label for="id_ingredient" class="col-sm-2 col-form-label">Ingrédient(s)</label>
				<div id="conteneur_ingredient"></div>
				<div id="champs_ingredient">
					<div class="row">
						<div class="col-2">
							<input type="text" class="form-control" name="quantite_ingredient" placeholder="Quantité" required="required" value="<?= 
							( !isset($_SESSION["data"]))?$_SESSION["data"]["quantite_ingredient"]:""; ?>">
						</div>
						<div class="col-8 col-sm-6 col-lg-4">
							<select class="form-select" name="id_ingredient" required="required" value="">
								<option selected>Choisissez un ingrédient</option>
								<?php
									$connection = connectDB();
									$results = $connection->query("SELECT id_ingredient, nom_ingredient FROM ".DB_PREFIX."INGREDIENT");
									$results = $results->fetchAll();
										
									foreach ($results as $ingredient) {
										echo "<option value='".$ingredient["id_ingredient"]."'>".$ingredient["nom_ingredient"]."</option>";
									} ?>
							</select>
						</div>
					</div>
				</div>
			</div>
				<div class="col-1">
					<button class='btn btn-link' id="btn-ajout-ingredient"><img src="assets/bouton-ajout.png" width='20px' title="Ajouter un ingrédient" alt="Ajouter un ingrédient"></button>
				</div>
			</div>

			<div class="mb-3 row">
				<div class="col-12">
					<input type="submit" value="Publier la recette" class="button1">
				</div>
			</div>

		</form>


	<!----------------------------------------------------------------------------------------------------------------->


		<!-- Suppression d'une recette  -->

		<div class="row">
			<div class="col-12">
			<h2>Supprimer une recette</h2>
			</div>
		</div>


		<!-- Alerte erreur supression recette -->
		<?php if(isset($_SESSION['listOfErrorsRecipeDel'])) {?>
			<div class="row mt-3">
				<div class="col-8 col-sm-6 col-lg-4">
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<?php

						foreach ($_SESSION['listOfErrorsRecipeDel'] as $error)
						{
							echo "<li>".$error."</li>";
						}
						unset($_SESSION['listOfErrorsRecipeDel']);
					?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				</div>
			</div>
		<?php }


		// Alerte confirmation suppression
		if( isset($_SESSION['isRecipeDeleted']) ) { ?>
		<div class="row mt-3">
				<div class="col-8 col-sm-6 col-lg-4">
				<div class="alert alert-success" role="alert">
					<p>La recette a bien été supprimée !</p>
				</div>
				<?php 
					unset($_SESSION['isRecipeDeleted']);
				?>
			</div>
		</div>
		<?php } ?>


		<!-- Formulaire -->
		<form action="core/recipeDel.php" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ?');">
			<div class="row mt-3 mb-3">
				<div class="col-8 col-sm-6 col-lg-4">
					<select class="form-select" name="id_recipeDel" required="required" value="<?= ( !isset($_SESSION["data"]))
					?$_SESSION["data"]["id_recipeDel"]:""; ?>">
						<option selected>Choisissez une recette</option>

						<?php
							$connection = connectDB();
							$results = $connection->query("SELECT id_recette, nom_recette FROM ".DB_PREFIX."RECETTE WHERE statut_publication = 1");
							$results = $results->fetchAll();
						
							foreach ($results as $recette) {
								echo "<option value='".$recette["id_recette"]."'>".$recette["nom_recette"]."</option>";
							} ?>
					</select> 
				</div>
				<div class="col-2">
					<input type="submit" value="Supprimer la recette" class="button1">
				</div>
			</div>
		</form>
	</section>