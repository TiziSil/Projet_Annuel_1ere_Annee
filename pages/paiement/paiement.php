<?php
//require "conf.inc.php";
?>

	<div class="row">
		<div class="col-12">
			<h1>Mon abonnement Premium</h1>
		</div>
	</div>

<form action="stripe.php" method="POST">
	<div class="row mt-4">

		<div class="col-lg-12">
			<input type="radio" class="form-check-input" value="0" name="gender" id="genderM">
			<label for="genderM" class="form-label"> M.</label> 
			
			<input type="radio" class="form-check-input" value="1" name="gender" id="genderMme">
			<label for="genderMme" class="form-label"> Mme. </label>
		</div>

	</div>
	<div class="row mt-3">
		<div class="col-lg-3">
			<input type="text" class="form-control" name="name" placeholder="Nom complet présent sur la carte" required="required" 
			value="">
		</div>
		<div class="col-lg-3">
			<input type="text" class="form-control" name="cardNumber" placeholder="Numéro de la carte" required="required" 
			value="">
		</div>
		<div class="col-lg-3">
			<input type="text" class="form-control" name="MM" placeholder="MM" required="required" 
			value="">
		</div>
		<div class="col-lg-3">
			<input type="text" class="form-control" name="YY" placeholder="YY" required="required" 
			value="">
		</div>
	<div class="row mt-4">
		<div class="col-12">
			<input type="submit" value="Payer" class="btn btn-primary">
		</div>

	</div>

</form>

<script type = "text/javascript" src = "https://js.stripe.com/v3/"></script>

<script>
</script>

