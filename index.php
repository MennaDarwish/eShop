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
	<title>eShop</title>
	<link rel="stylesheet" type="text/css" href="stylesheet/style.css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<!--script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script-->
	<link rel="stylesheet" type="text/css" href="js/fotorama/fotorama.css">
	<script type="text/javascript" src="js/fotorama/fotorama.js"></script>
	<!--link type="text/css" rel="stylesheet" href="js/galleria/themes/classic/galleria.classic.css">
	<script src ="js/galleria/galleria-1.4.2.min.js"></script>
	<script type="text/javascript" src="js/galleria/themes/classic/galleria.classic.min.js"></script-->
	<script type="text/javascript" src="js/script.js"></script>
</head>
<body>
	<div class="main-container">
		<div class="navbar-container">
			<div class="navbar-content">
			<div class="navbar-cart"></div>
			</div>
			<div class="navbar-content">
			<div class="vertical-line"></div>
			</div>
			<div class="navbar-content">
			<!--div class="navbar-register">Register</div-->
			<div class="navbar-content">
				<div class="navbar-name">
					<?php
						echo $userRow['firstName'], $userRow['lastName']
					?>
				</div>
			</div>
			</div>
			<!--div class="navbar-content"><div class="navbar-register">Register</div></div-->
		</div>
		<div class="landing-slider">
			<!--div class="galleria">
				<img src="images/planes.jpg">
				<img src="images/kunai.png">
			</div-->
		</div>
		<div class="product-container">
			<div class="product-title">OUR WEAPONS</div>
		
			<?php

				include_once 'dbconnect.php';
				if (isset($_SESSION['user'])) {
					$user = $_SESSION['user'];
				}
				if (!empty($_GET['id']) AND !isset($_SESSION['user'])) {
					header ("Location: login.php");
				}	
					$product_id = isset($_GET['id']) ? $_GET['id'] : "";
					$cart = mysql_query("SELECT * FROM Cart WHERE product_id='$product_id' AND user_id='$user'");
					$num_of_rows = mysql_num_rows($cart);
					if($num_of_rows == 0 ) {
						mysql_query("INSERT INTO Cart(product_id, user_id) VALUES('$product_id', '$user')");
					}
					else {
						$cart_row = mysql_fetch_array($cart);
						//$inc_quantity = $cart_row[product_quantity]+1;
						//mysql_query("UPDATE Cart SET product_quantity='$inc_quantity' WHERE product_id='$product_id' AND user_id='$userRow'");
					}
				
				//List all products
				$query_products = "SELECT * FROM Product ORDER BY name";
				$products = mysql_query($query_products) or die (mysql_error());
				while($row = mysql_fetch_assoc($products))
				{
					if($row >0){
							
					echo"<div class='product-block-1'> 
									<a href='index.php?id={$row['id']}'>ADD TO CART</a>
									<div class='product-name'>{$row['name']}
										<div class='product-price'> {$row['price']} </div>
										<div class= 'product-image'> 
											<img class='img' src='images/{$row['image']}'>
										</div>
										<div class='product-stock'>{$row['stock']}</div>
										<input type='hidden' name='product_id' value='{$row['id']}'/>
										<input type='submit' value='ADD TO CART' class='add-to-cart-btn'/>
								</div>
								</div>";
				}
					 else 
					{
						echo '<p>no product.</p>';
					}
				}
				mysql_close();
			?>
		</div>

	</div>
</body>
</html>