<?php 
session_start();
require "../conf.inc.php";
require "functions.php";

//recuperer donnée
//genre
//nom
//prenom
//date de naissance
//type de compte
//mot de passe
// Vérif données post



//vérification des données
if (
	 empty ($_POST["firstname"])
	|| empty ($_POST["lastname"])
	|| empty ($_POST["email"])
	|| empty ($_POST["birthday"])
	|| empty ($_POST["pwd"])
	|| empty ($_POST["pwdConfirm"])
	|| empty ($_POST["address"])
	|| empty ($_POST["codepostal"])
	|| empty ($_POST["ville"])
	|| empty($_POST['country'])
	|| empty ($_POST["cgu"])
	/*valider avatar et captcha plus tard"*/
	//|| empty ($_POST["avatar"])
	//|| empty ($_POST["captcha"])

){
    die ("Tentative de HACK");
}



//$gender = $_POST['gender'];
$firstname = cleanFirstname($_POST['firstname']);
$lastname = cleanLastname($_POST['lastname']);
$email = cleanEmail($_POST['email']);
$birthday = $_POST['birthday'];
$pwd = $_POST['pwd'];
$pwdConfirm = $_POST['pwdConfirm'];
$address = $_POST['address'];
$postalcode = $_POST['codepostal'];
$city = $_POST['ville'];
$country = $_POST['country'];
$cgu = $_POST['cgu'];

$listOfErrors = [];




// --> Nom plus de 2 caractères
if(strlen($lastname) < 2){
	$listOfErrors[] = "Le nom doit faire plus de 2 caractères";
}

// --> Prénom plus de 2 caractères
// --> Nom plus de 2 caractères
if(strlen($firstname) < 2){
	$listOfErrors[] = "Le prénom doit faire plus de 2 caractères";
}
// --> Format de l'email
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
	$listOfErrors[] = "L'email est incorrect";
}
// --> Unicité de l'email (plus tard)
$connection = connectDB();
$queryPrepared = $connection ->prepare("SELECT * FROM ".DB_PREFIX."utilisateur WHERE email = :email");

$queryPrepared-> execute([ "email" => $email ]);
$results = $queryPrepared -> fetch();
if (!empty($results)){
	$listOfErrors[] = "L'email est déjà utilisé";
}

// --> Date de naissance entre 6ans et 99ans

//$birthday = "1986-11-29";

$birthdayExploded = explode("-", $birthday);
//Vérification de la date
if (!checkdate($birthdayExploded[1],$birthdayExploded[2],$birthdayExploded[0])){
	$listOfErrors[] = "Date de naissance incorrecte";
}else{
	//Vérification de l'age
	$todaySecond = time();
	$birthdaySecond = strtotime($birthday);
	$ageSecond = $todaySecond - $birthdaySecond;
	$age = $ageSecond/60/60/24/365.25;
	if( $age <= 6 || $age >= 99 ){
		$listOfErrors[] = "Vous n'avez pas l'âge requis (entre 6 et 99 ans)";
	}
}

// --> Complexité du pwd
if(strlen($pwd) < 8
 || !preg_match("#[a-z]#", $pwd)
 || !preg_match("#[A-Z]#", $pwd)
 || !preg_match("#[0-9]#", $pwd))
 //|| !preg_match("#[!@#$%^&*()\-_=+{};:,<.>§~]/#", $pwd))
 {
	$listOfErrors[] = "Le mot de passe doit faire au min 8 caractères avec des minuscules, des majuscules, des chiffre" ;
}


// --> Meme mot de passe de confirmation
if( $pwd != $pwdConfirm){
	$listOfErrors[] = "Les mots de passe ne correspondent pas";
}
// --> Est-ce que le pays est cohérent
$listCountries = ["fr", "it", "pt", "pl", "es", "be", "xx"];
if( !in_array($country, $listCountries) ){
	$listOfErrors[] = "Le pays n'existe pas";
}



//Si OK
if(empty($listOfErrors)){
	//Insertion en BDD
	// DSN permet une optimisation, USER, PWD
	//pdo permet d'utiliser n'importe quel sgdb



	$queryPrepared = $connection -> prepare("INSERT INTO ".DB_PREFIX."UTILISATEUR
															(prenom_utilisateur, nom_utilisateur, email, pwd, date_de_naissance, country)
											VALUES
															( :firstname,       :lastname,      :email, :pwd, :birthday, :country)") ;
	$queryPrepared -> execute([
								
								"firstname" => $firstname,
								"lastname" => $lastname,
								"email" => $email,
								"pwd" => password_hash($pwd, PASSWORD_DEFAULT),
								"birthday" => $birthday,
								"country" => $country

			
	]);
	
	
	//Redirection sur la page de connexion
	header('location: /Projet_Annuel_1ere_Annee/ ');
}else{

	//Si NOK
	//On stock les erreurs et la data
	$_SESSION['listOfErrors'] = $listOfErrors;
	unset($_POST["pwd"]);
	unset($_POST["pwdConfirm"]);
	$_SESSION['data'] = $_POST;
	//Redirection sur la page d'inscription
	header('location: erreur.php/');
}
?> 


