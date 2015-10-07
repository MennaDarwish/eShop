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
	<title></title>
</head>
<body>
	<form action="" method='post'>
		<label class="email-label"> Email:</label>
		<input id='email' name='email' placeholder="Email" type='text'>
		
		<label class="password-label"> Password:</label>
		<input id='password' name='upass' placeholder="**********" type="password" required>
		
		<button class="login-btn" name='btn-login' type='submit'>LOGIN</button>
		<a href="register.php"> Register Here</a>
	</form>
</body>
</html>