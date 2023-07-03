<?php
session_start();
if(isset($_SESSION['listOfErrors'])) {?>
	<div class="row">
		<div class="col-12">
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
			  
			  <?php

			  foreach ($_SESSION['listOfErrors'] as $error)
			  {
			  	echo "<li>".$error."</li>";
			  }
			  unset($_SESSION['listOfErrors']);
			  ?>



			  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		</div>
	</div>
    <div>
        <nav class="nav flex-column">
        <a class="nav-link active" href="index.php">Retour à l'accueil</a>
        </nav>
    </div>
<?php } ?> 
