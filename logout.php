<?php
	session_start();
	if(!isset($_SEESION['user'])){
		header("Location: index.php");
	}
	else if (isset($_SEESION['user'])!="") {
		header("Location: index.php")
	}
	if(isset($_GET['logout'])) {
		session_destroy();
		unset($_SEESION['user']);
		header("Location: index.php")
	}
?>