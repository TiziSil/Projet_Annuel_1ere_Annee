<?php


function Hello() {
	return "Hello";
}

function cleanFirstname($firstName){
	return ucwords(strtolower(trim($firstName)));
}

function cleanLastname($lastName){
	return strtoupper(trim($lastName));
}

function cleanEmail($email){
	return strtolower(trim($email));
}

function cleanPhone($telephone){
	return str_replace('#[ -.]#','',$telephone);
}

function cleanName($name) {
	return ucfirst(strtolower(trim($name)));
}


function connectDB(){

	try{
		$connection = new PDO("mysql:host=".DB_HOST.";dbname=".DB_DATABASE.";port=".DB_PORT,DB_USER, DB_PWD);
	}catch(Exception $e){
		die("Erreur SQL ".$e->getMessage());
	}
	return $connection;
}



function isConnected(){
	if(!empty($_SESSION['email']) && !empty($_SESSION['login'])){

		$connection = connectDB();
		$queryPrepared = $connection->prepare("SELECT id_utilisateur FROM ".DB_PREFIX."UTILISATEUR where email=:email");
		$queryPrepared->execute(["email"=>$_SESSION['email']]);
		$result = $queryPrepared->fetch();

		if(!empty($result)){
			return true;
		}
		
	}
	return false;
}

function redirectIfNotConnected(){
	if(!isConnected()){
		echo '<script>window.location.href = "./index.php";</script>';
	}
} 

function redirectIfNotAdmin(){
	if (!isConnected()){
		echo '<script>window.location.href = "mon-compte";</script>';
	}else{
		$connection = connectDB();
		$queryPrepared = $connection->prepare("SELECT role_utilisateur FROM ".DB_PREFIX."UTILISATEUR where email=:email");
		$queryPrepared->execute(["email"=>$_SESSION['email']]);
		$result = $queryPrepared->fetch();
		if($result['role_utilisateur'] != 1){
			echo '<script>window.location.href = "mon-compte";</script>';
		}
	}
}

function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 16; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

function redirection($url){
	echo '<script>window.location.href = "'.$url.'";</script>';
}