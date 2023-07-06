<?php

//récupère la date en format [Y-m-d H:i:s]
$date = "[".date("Y-m-d H:i:s")."]";

$url = $_SERVER['REMOTE_ADDR'].' conect to ' .$_SERVER['SERVER_NAME'] .$_SERVER['PHP_SELF'];

echo $date." ".$url."\n";

$files = fopen("log.txt", "a+");
fputs($files, $date." ".$url."\n");
fclose($files);
