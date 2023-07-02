
<?php
	session_start();
	// require "conf.inc.php";
	echo "session started <br>";
	unset($_SESSION['email']);
	unset($_SESSION['login']);
	echo '<script>window.location.href = "index.php";</script>';