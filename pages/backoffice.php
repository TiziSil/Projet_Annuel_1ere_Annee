<?php
// require "conf.inc.php";
// require "core/functions.php";
//redirectIfNotConnected(); 
//session_destroy();
redirectIfNotConnected();
redirectIfNotAdmin();
?>
<section id="backoffice">
	<div class="container">
		<div class="d-flex flex-row justify-content-center align-items-center titre-backoffice">
			<div class="col-6 categorie-boite">
				<h1>Espace administrateur</h1>
			</div>
		</div>
		<div class="d-flex flex-column justify-content-center align-items-center">
			<div class="d-flex flex-row ">
				<div class="categorie-boite d-flex flex-column">
					<div class="row">
						<div class="col-12">
							<h2>Ajouter une nouvelle catégorie</h2>
						</div>
					</div>

					<!-- Alerte erreur nouvelle catégorie -->
					<?php if (isset($_SESSION['listOfErrorsCategory'])) { ?>
						<div class="row mt-3">
							<div class="col-8 col-sm-6 col-lg-4">
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
									<?php
									echo "Catégorie invalide : ";
									foreach ($_SESSION['listOfErrorsCategory'] as $error) {
										echo $error;
									}
									unset($_SESSION['listOfErrorsCategory']);
									?>
								</div>
							</div>
						</div>
					<?php }


					// Alerte confirmation création
					if (isset($_SESSION['isCategoryCreated'])) { ?>
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
					<form action="core/categoryAdd.php" method="POST" class="d-flex flex-column justify-content-center align-items-center">
						<div class="d-flex flex-row py-3">
							<div class="px-3">
								<input type="text" class="form-control" name="nom_categorie" placeholder="Nouvelle catégorie" required="required" value="">
							</div>
							<div class="px-3">
								<input type="submit" value="Créer la catégorie" class="button2">
							</div>
						</div>
					</form>
				</div>

				<div class="categorie-boite d-flex flex-column">
					<div class="row">
						<div class="col-12">
							<h2>Supprimer une catégorie</h2>
						</div>
					</div>


					<!-- Alerte erreur supression catégorie -->
					<?php if (isset($_SESSION['listOfErrorsCategoryDel'])) { ?>
						<div class="row mt-3">
							<div class="col-8 col-sm-6 col-lg-4">
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
									<?php

									foreach ($_SESSION['listOfErrorsCategoryDel'] as $error) {
										echo "<li>" . $error . "</li>";
									}
									unset($_SESSION['listOfErrorsCategoryDel']);
									?>
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
							</div>
						</div>
					<?php }


					//Alerte confirmation suppression
					if (isset($_SESSION['isCategoryDeleted'])) { ?>
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
						<div class="d-flex flex-row py-3">
							<div class="px-3">
								<select class="form-select" name="id_categorieDel" required="required" value="<?= (!empty($_SESSION["data"])) ? $_SESSION["data"]["id_categorieDel"] : ""; ?>">
									<option selected>Choisissez une catégorie</option>

									<?php
									$connection = connectDB();
									$results = $connection->query("SELECT id_categorie, nom_categorie FROM MAKISINE_CATEGORIE WHERE id_categorie NOT IN (SELECT categorie FROM MAKISINE_APPARTENIR)");
									$results = $results->fetchAll();

									foreach ($results as $categorie) {
										echo "<option value='" . $categorie["id_categorie"] . "'>" . $categorie["nom_categorie"] . "</option>";
									} ?>
								</select>
							</div>
							<div class="px-3">
								<input type="submit" value="Supprimer la catégorie" class="button2">
							</div>
						</div>
					</form>
					<p>&nbsp;Attention : seules les catégories vides peuvent être supprimées.</p>
				</div>
			</div>
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
					<?php if (isset($_SESSION['listOfErrorsRecipe'])) { ?>
						<div class="row">
							<div class="col-8 col-sm-6 col-lg-4">
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
									<?php

									foreach ($_SESSION['listOfErrorsRecipe'] as $error) {
										echo "<li>" . $error . "</li>";
									}
									unset($_SESSION['listOfErrorsRecipe']);
									?>
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
							</div>
						</div>
					<?php }


					// Alerte confirmation création 
					if (isset($_SESSION['isRecipeCreated'])) { ?>
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
					<form class="d-flex flex-column" action="core/recipeAdd.php" method="POST">
						<div class="d-flex flex-row  py-1">
							<label class="col-3 col-form-label" for="nom_recette">Nom de la recette</label>
							<input class="form-control" type="text" name="nom_recette" placeholder="Nom de la recette" required="required" value="<?= (!empty($_SESSION["data"])) ? $_SESSION["data"]["nom_recette"] : ""; ?>">
						</div>

						<div class="d-flex flex-row  py-1">
							<label for="id_categorie" class="col-3 col-form-label">Catégorie</label>
							<select class="form-select" name="id_categorie" required="required" value="<?= (!empty($_SESSION["data"]))
																											? $_SESSION["data"]["id_categorie"] : ""; ?>">
								<option selected>Choisissez une catégorie</option>

								<?php
								$connection = connectDB();
								$results = $connection->query("SELECT * FROM " . DB_PREFIX . "CATEGORIE");
								$results = $results->fetchAll();

								foreach ($results as $categorie) {
									echo "<option value='" . $categorie["id_categorie"] . "'>" . $categorie["nom_categorie"] . "</option>";
								} ?>
							</select>
						</div>

						<div class="d-flex flex-row  py-1">
							<label for="difficulte" class="col-3 col-form-label">Niveau de difficulté</label>
							<div class="d-flex flex-row">
								<div class="px-2">
									<input type="radio" class="form-check-input" value="0" <?= (!empty($_SESSION["data"]) && $_SESSION["data"]["difficulte"] == 0) ? "checked" : ""; ?> checked="checked" name="difficulte" id="easy">
									<label for="easy" class="form-label"> Facile </label>
								</div>
								<div class="px-2">
									<input type="radio" class="form-check-input" value="1" <?= (!empty($_SESSION["data"]) && $_SESSION["data"]["difficulte"] == 1) ? "checked" : ""; ?> name="difficulte" id="medium">
									<label for="medium" class="form-label"> Moyen </label>
								</div>
								<div class="px-2">
									<input type="radio" class="form-check-input" value="2" <?= (!empty($_SESSION["data"]) && $_SESSION["data"]["difficulte"] == 2) ? "checked" : ""; ?> name="difficulte" id="hard">
									<label for="hard" class="form-label"> Difficile </label>
								</div>
							</div>
						</div>

						<div class="d-flex flex-row py-1">
							<label for="temps_preparation" class="col-3 col-form-label">Temps de préparation (min)</label>
							<input type="text" class="form-control" name="temps_preparation" placeholder="Temps de préparation" required="required" value="<?= (!empty($_SESSION["data"])) ? $_SESSION["data"]["temps_preparation"] : ""; ?>">
						</div>

						<div class="d-flex flex-row py-1">
							<label for="description_recette" class="col-3 col-form-label">Étapes de préparation</label>
							<textarea class="form-control" name="description_recette" placeholder="Décrivez les étapes de préparation" required="required" value="<?= (!empty($_SESSION["data"])) ? $_SESSION["data"]["description_recette"] : ""; ?>" rows="7"></textarea>
						</div>

						<div class="d-flex flex-row py-1 justify-content-center align-items-center">
							<input type="submit" value="Publier la recette" class="button2">
						</div>

					</form>
				</div>
			</div>


		</div>
	</div>
</section>

<section class="section-radis" class="col">
	<img src="assets/images/separateur.png" class="separateur-de-texte-contact">
</section>

<section id="backoffice-supression">
	<div class="d-flex flex-column py-5 container">
		<div class="d-flex flex-column py-5 col-lg-4">
			<div class="boite ">
				<div class="">
					<h2>Supprimer une recette</h2>
				</div>


				<!-- Alerte erreur supression recette -->
				<?php if (isset($_SESSION['listOfErrorsRecipeDel'])) { ?>
					<div class="row mt-3">
						<div class="col-8 col-sm-6 col-lg-4">
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<?php

								foreach ($_SESSION['listOfErrorsRecipeDel'] as $error) {
									echo "<li>" . $error . "</li>";
								}
								unset($_SESSION['listOfErrorsRecipeDel']);
								?>
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						</div>
					</div>
				<?php }


				// Alerte confirmation suppression
				if (isset($_SESSION['isRecipeDeleted'])) { ?>
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
					<div class="d-flex flex-column">
						<select class="form-select my-2" name="id_recipeDel" required="required" value="<?= (!empty($_SESSION["data"])) ? $_SESSION["data"]["id_recipeDel"] : ""; ?>">
							<option selected>Choisissez une recette</option>

							<?php
							$connection = connectDB();
							$results = $connection->query("SELECT id_recette, nom_recette FROM MAKISINE_RECETTE WHERE statut_publication = 1");
							$results = $results->fetchAll();

							foreach ($results as $recette) {
								echo "<option value='" . $recette["id_recette"] . "'>" . $recette["nom_recette"] . "</option>";
							} ?>
						</select>
						<input type="submit" value="Supprimer la recette" class="button2 my-2">
					</div>
				</form>

			</div>
		</div>
	</div>
</section>
<!----------------------------------------------------------------------------------------------------------------->


<!-- Inscription Newsletter  -->

<!-- <div class="row">
	<div class="col-12">
		<h2>S'inscrire à la Newsletter</h2>
	</div>
</div> -->


<!-- Alerte erreur supression recette -->