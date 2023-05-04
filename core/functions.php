<?

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
