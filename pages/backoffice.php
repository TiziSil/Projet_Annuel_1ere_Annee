<?php
redirectIfNotConnected();
redirectIfNotAdmin();
?>

		<div class="row mt-1">
			<div class=" titre-principal d-flex justify-content-center align-items-center">
				<h1>Gestion des recettes et leurs composants</h1>
			</div>
		</div>

	<!----------------------------------------------------------------------------------------------------------------->
            
	<section class="gestion-bloc">

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
							$categoryId = $category["id_categorie"];
							$queryPrepared = $connection->prepare("SELECT COUNT(*) FROM ".DB_PREFIX."APPARTENIR WHERE categorie = :id_categorie");
							$queryPrepared->execute(["id_categorie" => $categoryId]);
							$results2 = $queryPrepared->fetch();

								echo "<span class='badge rounded-pill'>".$results2[0]." recettes</span></li>";
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
		<hr class="border-bottom">
	</section>



<!----------------------------------------------------------------------------------------------------------------->


<section class="gestion-bloc">

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
								$results = $connection->query("SELECT * FROM ".DB_PREFIX."INGREDIENT ORDER BY nom_ingredient");
								$results = $results->fetchAll();

								foreach ($results as $ingredient) {
									$queryPrepared = $connection->prepare("SELECT nom_allergene FROM ".DB_PREFIX."ALLERGENE, ".DB_PREFIX."CONTENIR WHERE id_allergene = allergene AND produit = :id_ingredient");
									$queryPrepared->bindValue(':id_ingredient', $ingredient["id_ingredient"]);
									$queryPrepared->execute();
									$results2 = $queryPrepared->fetchAll();


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
			value="">
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
<hr class="border-bottom">
</section>



<!----------------------------------------------------------------------------------------------------------------->


	<!-- Suppression d'une recette  -->

	<section class="gestion-bloc">
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