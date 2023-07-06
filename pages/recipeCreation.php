<?php
redirectIfNotConnected();
?>

<!-- Création d'une recette -->
<section id="backoffice-recette">
	<div class="py-4 d-flex flex-column">
		<div class="container py-4">
			<div class="boite">

				<div class="row text-center titre-principal d-flex justify-content-center align-items-center" style="margin-bottom:50px;">
					<h1>Créez votre propre recette !</h1>
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
					<input type="text" id="nom_recette" class="form-control" name="nom_recette" placeholder="Nom de la recette" required="required" 
					value="">
				</div>
			</div>

			<div class="mb-3 row">
				<label for="id_categorie" class="col-sm-2 col-form-label">Catégorie</label>
				<div class="col-10 col-sm-8 col-lg-6">
					<select class="form-select" id="id_categorie" name="id_categorie" required="required" value="">
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
					<input type="radio" class="form-check-input" value="0" checked = "checked" name="difficulte" id="easy">
					<label for="easy" class="form-label"> Facile </label> 
			
					<input type="radio" class="form-check-input" value="1" name="difficulte" id="medium">
					<label for="medium" class="form-label"> Moyen </label> 

					<input type="radio" class="form-check-input" value="2" name="difficulte" id="hard">
					<label for="hard" class="form-label"> Difficile </label> 
				</div>
			</div>

			<div class="mb-3 row">
				<label for="temps_preparation" class="col-sm-2 col-form-label">Temps de préparation (min)</label>
				<div class="col-10 col-sm-8 col-lg-6">
					<input type="text" id="temps_preparation" class="form-control" name="temps_preparation" placeholder="Temps de préparation" required="required" value="">
				</div>
			</div>

			<div class="mb-3 row">
				<label for="description_recette" class="col-sm-2 col-form-label">Étapes de préparation</label>
				<div class="col-10 col-sm-8 col-lg-6">
					<textarea class="form-control" id="description_recette" name="description_recette" placeholder="Décrivez les étapes de préparation" required="required" 
					value="" rows="7"></textarea>
				</div>
			</div>

			<div class="mb-3 row">
				<label for="id_ingredient" class="col-sm-2 col-form-label">Ingrédient(s)</label>
				<div id="conteneur_ingredient"></div>
				<div id="champs_ingredient">
					<div class="row">
						<div class="col-2">
							<input type="text" id="id_ingredient" class="form-control" name="quantite_ingredient" placeholder="Quantité" required="required" value="">
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
</section>