<?php if(isset($_SESSION['listOfErrors'])) {?>
	<div class="row">
		<div class="col-12">
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
			  
			  <?php

			  foreach ($_SESSION['listOfErrors'] as $error)
			  {
			  	echo "<li>".$error."</li>";
			  }
			  unset($_SESSION['listOfErrors']);}
			  ?>




<div id="inscriptions-coordonnees" class="form-inscription">
    
   
        <div class="champ">
            <input autocomplete="off" type="text" name="firstname" required="required"
            value="<?= ( !empty($_SESSION["data"]))?$_SESSION["data"]["firstname"]:""; ?>">
            <label>Prénom</label>
        </div>
        <div class="champ">
            <input autocomplete="off" type="text" name="lastname" required="required"
            value="<?= ( !empty($_SESSION["data"]))?$_SESSION["data"]["lastname"]:""; ?>">
            <label>Nom</label>
        </div>
        <div class="champ">
            <input autocomplete="off" type="email" name="email" required="required"
            value="<?= ( !empty($_SESSION["data"]))?$_SESSION["data"]["email"]:""; ?>">
            <label>Email</label>
        </div>
        <div class="champ">
            <input autocomplete="off" type="date" value="1979-01-01" name="birthday" required="required"
            value="<?= ( !empty($_SESSION["data"]))?$_SESSION["data"]["birthday"]:""; ?>">
            <label>Date de naissance</label>
        </div>
        <div class="champ">
            <input autocomplete="off" type="password" name="pwd" required="required">
            <label>Mot de passe</label>
        </div>
        <div class="champ">
            <input autocomplete="off" type="password" name="pwdConfirm" required="required">
            <label>Confirmation mot de passe</label>
        </div>
        <a onclick="afficherAdressePostal()" class="button3">Suivant</a>

</div>
