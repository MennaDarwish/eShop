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
				<div id="history"> History of Purchases </div>	
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
				<div class='history-purchase'>
					<table class='cart-table' style='width:100%' border='1'>
					  <tr>
					    <th>Product Name</th>
					    <th>Price</th>		
					    <th>Quantity</th>
					  </tr>";
			    $user_id = $userRow['id'];
				$history_query = ("SELECT * FROM History WHERE user_id = '$user_id'");
				$history_rows = mysql_query($history_query) or die (mysql_error());
				while($single_history_row = mysql_fetch_assoc($history_rows)) {
					$history_product_id = $single_history_row['product_id'];
					$name_query = mysql_query("SELECT * FROM Product WHERE id = '$history_product_id'") or die(mysql_error());
					$name_row = mysql_fetch_assoc($name_query);
					$history_product_name = $name_row['name'];
					$history_product_price = $name_row['price'];
					echo "<tr>
							<td>{$history_product_name}</td>
							<td>{$history_product_price}</td>
							<td>{$single_history_row['transaction_quantity']}</td>
						</tr>";
				}

	echo "</table></div></div>";

?>
<script> 
	$(document).ready(function(){
		$('#history').on('click', function(){
			if ( $('#history').hasClass('opened') ){
				console.log("closed");
				$(".history-purchase").fadeOut();
				$("#history").removeClass('opened');
			}
			else {
				$('#history').addClass('opened');
				$(".history-purchase").fadeIn();
			}
		});	
	});


</script>


</body>
</html>

