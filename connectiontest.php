<?php
include "conf.inc.php";
// Constantes de connexion à la base de données

try {
    // Connexion à la base de données
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_DATABASE.";port=".DB_PORT,DB_USER, DB_PWD);

    // Configuration des options de PDO
    echo "connecté";
    // Exécuter des requêtes sur la base de données ici...
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    exit;
}

?>
