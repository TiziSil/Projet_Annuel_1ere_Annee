
<?php
	session_start();
	// require "conf.inc.php";
	echo "session started <br>";
	unset($_SESSION['email']);
	unset($_SESSION['login']);
	header("Location: index.php");