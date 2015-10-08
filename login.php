<?php
	session_start();
	include_once'dbconnect.php';

	if (isset($_SESSION['user'])!="")
	{
		header("Location:index.php");
	}
	if (isset($_POST['btn-login'])) {
		$email = mysql_real_escape_string($_POST['email']);
		$password = mysql_real_escape_string($_POST['upass']);
		$res = mysql_query("SELECT * FROM User WHERE email='$email'");
		if ($res === False){
			die(mysql_error());
		}
		$rows = mysql_fetch_array($res);
		echo md5($password);
		echo "<br>";
		echo $rows['password'];
		if ($rows['password']==md5($password)) 
		{

			$_SESSION['user'] = $rows['id'];
			echo 'success'.$_SESSION['user'];
			header("Location: index.php");

		}
		else {
			echo $rows['email'];
			echo $rows['password']
			?>
			<script>alert('wrong details')</script>
			<?php
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
		<link rel="stylesheet" type="text/css" href="stylesheet/login.css">
	<title></title>
</head>
<body>
	<div class="main-container">
	<div class="navbar-container">
			<div class="register">
				<a href="register.php"> REGISTER </a>
			</div>			
				</div>
	<div class="login-info-container">
	<div class= "container">
	<form action="" method='post'>
		<div class="email-block">
		<label class="email-label"> Email:</label>
		<input id='email' name='email' placeholder="Email" type='text'>
		</div>
		<div class="pass-block">
		<label class="password-label"> Password:</label>
		<input id='password' name='upass' placeholder="**********" type="password" required>
		</div>
		<button class="login-btn" name='btn-login' type='submit'>LOGIN</button>
		<a class="register-anchor"href="register.php"> Register Here</a>
			<div class="horizontal-line"></div>

	</form>
	</div>
	</div>
	</div>
</body>
</html>