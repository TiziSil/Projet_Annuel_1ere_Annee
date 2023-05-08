<?php

function cleanFirstname($firstName){
	return ucwords(strtolower(trim($firstName)));
}

function cleanLastname($lastName){
	return strtoupper(trim($lastName));
}

function cleanEmail($email){
	return strtolower(trim($email));
}


function connectDB(){
    try {
        $connection = new PDO("mysql:host=".DB_HOST.";dbname=".DB_DATABASE.";port=".DB_PORT, DB_USER, DB_PWD);
        return $connection;
    } catch (Exception $e) {
        error_log("Erreur SQL : " .$e->getMessage());
        return false;
    }
}


function isConnected(){
	if(!empty($_SESSION['email']) && !empty($_SESSION['login'])){

		$connection = connectDB();
		$queryPrepared = $connection->prepare("SELECT id FROM ".DB_PREFIX."utilisateur where email=:email");
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
        //rediriger vers la modale pas le lien pour l'instant redirect vers page accueil
        header("Location: /Projet_Annuel_1ere_Annee/");
		//header("Location: ../pages/modale-connexion.php");
	}
}

