<?php
	session_start();
	if(isset($_SESSION['user']) != "") {
		header("Location:index.php");
	}
	include_once 'dbconnect.php';

	// if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0)
	// 	{
	// 		$fileName = $_FILES['userfile']['name'];
	// 		$tmpName  = $_FILES['userfile']['tmp_name'];
	// 		$fileSize = $_FILES['userfile']['size'];
	// 		$fileType = $_FILES['userfile']['type'];
	// 		$fp      = fopen($tmpName, 'r');
	// 		$content = fread($fp, filesize($tmpName));
	// 		$content = addslashes($content);
	// 		fclose($fp);
	// 		if(!get_magic_quotes_gpc())
	// 		{
	// 		    $fileName = addslashes($fileName);
	// 		}
	// }
	 
	if(isset($_POST['btn-signup']) && $_FILES['userfile']['size'] > 0){
		$fname = mysql_real_escape_string($_POST['fname']);
		$lname = mysql_real_escape_string($_POST['lname']);
		$email = mysql_real_escape_string($_POST['email']);
		$password = md5(mysql_real_escape_string($_POST['password']));
				$fileName = $_FILES['userfile']['name'];
				$tmpName  = $_FILES['userfile']['tmp_name'];
				$fileSize = $_FILES['userfile']['size'];
				$fileType = $_FILES['userfile']['type'];
				$fp      = fopen($tmpName, 'r');
				$content = fread($fp, filesize($tmpName));
				$content = addslashes($content);
				fclose($fp);
				if(!get_magic_quotes_gpc())
				{
				    $fileName = addslashes($fileName);
				}
		

			if (mysql_query("INSERT INTO User(email, firstName, lastName, password, avatar) VALUES ('$email', '$fname', '$lname', '$password','$content'
'$content')")) {
			?>
				<script> window.location.replace('login.php'); </script>
				<?php
		}
		else {
			?>
			<script> alert('error while Registeration'); </script>
			<?php
		}
		
	
}
	
		// $query = "INSERT INTO User(avatar) ".
		// "VALUES ('$content')";
		//mysql_query("INSERT INTO User(avatar) VALUES ('$content')") or die('Error, query failed'); }

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
		
		<form method='post' enctype="multipart/form-data">
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


			<!-- <form method="post" enctype="multipart/form-data"> -->
				<table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
				<tr> 
				<td width="246">
				<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
				<input name="userfile" type="file" id="userfile"> 
				</td>
				<!-- <td width="80"><input name="upload" type="submit" class="box" id="upload" value=" Upload "></td> -->
				</tr>
				</table>
				<!-- </form> -->
							

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