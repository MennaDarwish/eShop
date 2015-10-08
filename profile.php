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
	<link rel="stylesheet" type="text/css" href="stylesheet/profile.css">
		<script type="text/javascript" src="js/jquery.min.js"></script>
	<title></title>
</head>
<body>
	<div class="main-container">
	<div class="navbar-container">
			<div class="register">
				<a href="index.php"> HOME </a>

			</div>	
			<div class="history">
				<a id="history" href="profile.php?history"> History of Purchases </a>	
			</div>	
				</div>
	</div>
<?php
	echo "<div class='profile-container'>
				<div class='info'>
				<div class= 'firstn'>
				<div class='fname-title'>First Name:</div>
				<div class='fname'>{$userRow['firstName']}</div>
				</div> 
				<div class='lastn'>
				<div class='lname-title'>Last Name:</div>
					<div class ='lname'>{$userRow['lastName']}</div>
				</div>
				<div class='mail'>
				<div class='email-title'>Email:</div><div class='user-email'>{$userRow['email']}</div>
				</div>
				</div>
				<div class='history-purchase'></div>
				 </div>";

?>
<script> 
	$(document).ready(function(){
		<?php if ($_GET['history']){
				echo "$('#history').on('click', function(){console.log('sj,dsjdn')$('.history-purchase').fadeIn();";
		}?>
});


</script>


</body>
</html>

