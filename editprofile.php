<?php
	session_start();
	
	include_once 'dbconnect.php';
	$res=mysql_query("SELECT * FROM User WHERE id=".$_SESSION['user']);
	$userRow=mysql_fetch_array($res);

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
	 
	if(isset($_POST['btn-signup'])){
		$fname = mysql_real_escape_string($_POST['fname']);
		$lname = mysql_real_escape_string($_POST['lname']);
		$email = mysql_real_escape_string($_POST['email']);
		$password = md5(mysql_real_escape_string($_POST['password']));
		$content = "";
		if($_FILES['userfile']['size'] > 0) {
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

		}

$user_id = $userRow['id'];
$update_query = ("UPDATE User SET email = '$email', firstName = '$fname',
		 lastName = '$lname', 
		 password = '$password', 
		 avatar = '$content'
		  WHERE id = '$user_id' ");
			mysql_query($update_query) or die(mysql_error());
		
	
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
			<input id="register-fname" value="<?php echo $userRow['firstName']?>" type="text" name="fname">
			</div>
			<div class='lname'>
			<label class="register-lname-label">Last Name:</label>
			<input id="register-lname" value='<?php echo $userRow['lastName']?>' type="text" name="lname">
			</div>
			<div class='email'>
			<label class="register-email-label">Email:</label>
			<input id="register-email" value='<?php echo $userRow['email']?>' type="text" name="email">
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
							

			<button class="signup-btn" type="submit" name="btn-signup">Update</button>

			<div class="horizontal-line"></div>
		</form>
		</div>
		</div>
		</div>
		</div>
</body>
</html>