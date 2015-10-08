<?php
	session_start();
	if(isset($_SESSION['user']) != "") {
		header("Location:index.php");
	}
	include_once 'dbconnect.php';
	if(isset($_POST['btn-signup'])){
		$fname = mysql_real_escape_string($_POST['fname']);
		$lname = mysql_real_escape_string($_POST['lname']);
		$email = mysql_real_escape_string($_POST['email']);
		$password = md5(mysql_real_escape_string($_POST['password']));

		if (mysql_query("INSERT INTO User(email, firstName, lastName, password) VALUES ('$email', '$fname', '$lname', '$password')")) {
			?>
				<script> alert('REGISTERATION SUCCESS'); </script>
				<?php
		}
		else {
			?>
			<script> alert('error while Registeration'); </script>
			<?php
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="stylesheet/register.css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>

	<title></title>
</head>
<body>
		<div class="main-container">
		<div class="navbar-container">
			<div class="home">
				<a href="index.php"> HOME </a>
			</div>			
		</div>
		<div class="main-container">
		<div class="register-info-container">
		<div class="container">
		<form  method='post'>
			<div class= "fname">
			<label class="register-fname-label">First Name:</label>
			<input id="register-fname" placeholder="First Name" type="text" name="fname">
			</div>
			<div class='lname'>
			<label class="register-lname-label">Last Name:</label>
			<input id="register-lname" placeholder="Last Name" type="text" name="lname">
			</div>
			<div class='email'>
			<label class="register-email-label">Email:</label>
			<input id="register-email" placeholder="Email" type="text" name="email">
			</div>
			<div class="pass">
			<label class="register-pass-label">Password:</label>
			<input id="register-pass" placeholder="********" type="password" name="password">
			</div>
			<button class="signup-btn" type="submit" name="btn-signup">Register</button>

			<a class="signin-anchor"href="login.php">Sign in here</a>
			<div class="horizontal-line"></div>
		</form>
		</div>
		</div>
		</div>
		</div>
</body>
</html>