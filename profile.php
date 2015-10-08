<?php 
	session_start();
	include_once('dbconnect.php');
	
	if(isset($_SESSION['user'])) {
		$res=mysql_query("SELECT * FROM User WHERE id=".$_SESSION['user']);
		$user=mysql_fetch_array($res);
	}

	echo $user['firstName'];
	echo $user['lastName'];
	echo $user['email'];
?>