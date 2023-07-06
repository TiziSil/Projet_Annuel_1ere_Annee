<?php

// Récupère l'adresse IP de l'utilisateur
$ip = $_SERVER['REMOTE_ADDR'];

// Récupère l'URL complète de la page
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

// Formatage de la date
$date = "[" . date("Y-m-d H:i:s") . "]";

// Génération du message à enregistrer dans le fichier de log
$logMessage = $date . " " . $ip . " connected to " . $url . "\n";

// Ouverture du fichier en mode "append" (ajout à la fin du fichier)
$logfile = fopen("log.txt", "a");

// Écriture du message dans le fichier
fwrite($logfile, $logMessage);

// Fermeture du fichier
fclose($logfile);
