<?php
require "conf.inc.php";
require "core/functions.php";
//redirectIfNotConnected(); 
//session_destroy();
?>

	<div class="row mt-1">
		<div class="col-12">
        <h1>Espace administrateur </h1>
		</div>
	</div>


<!----------------------------------------------------------------------------------------------------------------->


    <!-- Création d'une catégorie -->

    <div class="row">
		<div class="col-12">
        <h2>Ajouter une nouvelle catégorie</h2>
		</div>
	</div>


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
                <input type="submit" value="Créer la catégorie" class="btn btn-primary">
			</div>
        </div>
	</form>


<!----------------------------------------------------------------------------------------------------------------->


    <!-- Suppression d'une catégorie -->

    <div class="row">
		<div class="col-12">
        <h2>Supprimer une catégorie</h2>
		</div>
	</div>


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
				<select class="form-select" name="id_categorieDel" required="required" value="<?= ( !empty($_SESSION["data"]))
				?$_SESSION["data"]["id_categorieDel"]:""; ?>">
  					<option selected>Choisissez une catégorie</option>

					<?php
						$connection = connectDB();
						$results = $connection->query("SELECT id_categorie, nom_categorie FROM MAKISINE_CATEGORIE WHERE id_categorie NOT IN 
						(SELECT categorie FROM MAKISINE_APPARTENIR)");
						$results = $results->fetchAll();
					
						foreach ($results as $categorie) {
							echo "<option value='".$categorie["id_categorie"]."'>".$categorie["nom_categorie"]."</option>";
						} ?>
				</select> 
			</div>
			<div class="col-2">
                <input type="submit" value="Supprimer la catégorie" class="btn btn-primary">
			</div>
        </div>
	</form>

	<p>&nbsp;Attention : seules les catégories vides peuvent être supprimées.</p>


<!----------------------------------------------------------------------------------------------------------------->


    <!-- Création d'une recette -->

    <div class="row">
		<div class="col-12">
        <h2>Créez votre propre recette !</h2>
		</div>
	</div>


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
				value="<?= ( !empty($_SESSION["data"]))?$_SESSION["data"]["nom_recette"]:""; ?>">
    		</div>
  		</div>

		<div class="mb-3 row">
    		<label for="id_categorie" class="col-sm-2 col-form-label">Catégorie</label>
    		<div class="col-10 col-sm-8 col-lg-6">
				<select class="form-select" name="id_categorie" required="required" value="<?= ( !empty($_SESSION["data"]))
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
				<input type="radio" class="form-check-input" value="0" <?= ( !empty($_SESSION["data"]) && $_SESSION["data"]["difficulte"]==0)
				?"checked":""; ?> checked = "checked" name="difficulte" id="easy">
				<label for="easy" class="form-label"> Facile </label> 
		
				<input type="radio" class="form-check-input" value="1" <?= ( !empty($_SESSION["data"]) && $_SESSION["data"]["difficulte"]==1)
				?"checked":""; ?> name="difficulte" id="medium">
				<label for="medium" class="form-label"> Moyen </label> 

				<input type="radio" class="form-check-input" value="2" <?= ( !empty($_SESSION["data"]) && $_SESSION["data"]["difficulte"]==2)
				?"checked":""; ?> name="difficulte" id="hard">
				<label for="hard" class="form-label"> Difficile </label> 
			</div>
		</div>

		<div class="mb-3 row">
    		<label for="temps_preparation" class="col-sm-2 col-form-label">Temps de préparation (min)</label>
    		<div class="col-10 col-sm-8 col-lg-6">
				<input type="text" class="form-control" name="temps_preparation" placeholder="Temps de préparation" required="required" value="<?= 
				( !empty($_SESSION["data"]))?$_SESSION["data"]["temps_preparation"]:""; ?>">
    		</div>
  		</div>

		<div class="mb-3 row">
    		<label for="description_recette" class="col-sm-2 col-form-label">Étapes de préparation</label>
    		<div class="col-10 col-sm-8 col-lg-6">
				<textarea class="form-control" name="description_recette" placeholder="Décrivez les étapes de préparation" required="required" 
				value="<?= ( !empty($_SESSION["data"]))?$_SESSION["data"]["description_recette"]:""; ?>" rows="7"></textarea>
    		</div>
  		</div>

		<div class="mb-3 row">
    		<div class="col-12">
				<input type="submit" value="Publier la recette" class="btn btn-primary">
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
				<select class="form-select" name="id_recipeDel" required="required" value="<?= ( !empty($_SESSION["data"]))
				?$_SESSION["data"]["id_recipeDel"]:""; ?>">
  					<option selected>Choisissez une recette</option>

					<?php
						$connection = connectDB();
						$results = $connection->query("SELECT id_recette, nom_recette FROM MAKISINE_RECETTE WHERE statut_publication = 1");
						$results = $results->fetchAll();
					
						foreach ($results as $recette) {
							echo "<option value='".$recette["id_recette"]."'>".$recette["nom_recette"]."</option>";
						} ?>
				</select> 
			</div>
			<div class="col-2">
                <input type="submit" value="Supprimer la recette" class="btn btn-primary">
			</div>
        </div>
	</form>


<!----------------------------------------------------------------------------------------------------------------->


    <!-- Inscription Newsletter  -->

    <div class="row">
		<div class="col-12">
        <h2>S'inscrire à la Newsletter</h2>
		</div>
	</div>


	<!-- Alerte erreur supression recette -->
