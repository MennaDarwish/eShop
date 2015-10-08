<?php
	session_start();
	include_once 'dbconnect.php';

	if(!isset($_SESSION['user'])) {
		header("Location:login.php");
	}
	$res=mysql_query("SELECT * FROM User WHERE id=".$_SESSION['user']);
	$userRow=mysql_fetch_array($res);
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
	echo $userRow['firstName']; 
	echo $userRow['lastName'];
	echo $userRow['email'];
?>

</body>
</html>