<?php
	session_start();
	include_once 'dbconnect.php';

	if(isset($_SESSION['user'])) {
		$res=mysql_query("SELECT * FROM User WHERE id=".$_SESSION['user']);
		$userRow=mysql_fetch_array($res);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>eShop</title>
	<link rel="stylesheet" type="text/css" href="stylesheet/style.css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="js/fotorama/fotorama.css">
	<script type="text/javascript" src="js/fotorama/fotorama.js"></script>
	<script type="text/javascript">
		$(document).ready(function($){
		$("#navbar-cart").on("click", function() {
			if("<?php echo $_SESSION['user']; ?>" == "" ) {
				window.location.replace("register.php");
			}
			if ( $('#navbar-cart').hasClass('opened') ){
				console.log("closed");
				$(".navbar-cart-open").fadeOut();
				$("#navbar-cart").removeClass('opened');
			}
			else {
				$('#navbar-cart').addClass('opened');
				console.log("opened");
				$(".navbar-cart-open").fadeIn();
			} 
		});
	
});
	</script>
</head>
<body>
	<div class="main-container">
		<div class="navbar-container">
			<div class="navbar-content">
			<div id="navbar-cart">
				<div class="navbar-cart-open" style="display:none;" >
				<?php
					include_once 'dbconnect.php';
					
					$carts_query = ("SELECT * FROM Cart WHERE user_id='$id'");
					$carts = mysql_query($carts_query) or die(mysql_error());
					$carts_row_num = mysql_num_rows($carts);
					if ($carts_row_num == 0) {
						echo 'cart is empty';
					} else {
						while ($cart_row = mysql_fetch_assoc($carts)) {
							if ($cart_row > 0) {

								$cart_product_id = $cart_row['product_id'];
								$cart_products_query = "SELECT * FROM Product WHERE id='$cart_product_id'";
								$cart_products = mysql_query($cart_products_query) or die(mysql_error());
								while($cart_product_row = mysql_fetch_assoc($cart_products)){
									echo "<div class='products-in-cart'>{$cart_product_row['name']} {$cart_row['product_quantity']}</div>";
								}
							}
						}
					}
				?>
			</div>
			<div class="navbar-cart-exit"></div>
			</div>

			<div class="navbar-content">
			<div class="vertical-line"></div>
			</div>
			<div class="navbar-content">
				<a href="logout.php?logout">LOGOUT</a>
			</div>
			<div class="navbar-content">
				<div class="navbar-name">
					<?php
						echo $userRow['firstName'], $userRow['lastName']
					?>
				</div>
			</div>

			
			<!--div class="navbar-content"><div class="navbar-register">Register</div></div-->
		</div>
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
				if(!empty(['id']))
				{
					$product_id = isset($_GET['id']) ? $_GET['id'] : "";
					$cart = mysql_query("SELECT * FROM Cart WHERE product_id='$product_id' AND user_id='$user' AND product_quantity='1'");
					$num_of_rows = mysql_num_rows($cart);
					if($num_of_rows == 0 ) {
						mysql_query("INSERT INTO Cart(product_id, user_id, product_quantity) VALUES('$product_id', '$user', '1')");
					}
					else {
						$cart_row = mysql_fetch_array($cart);
						$inc_quantity = $cart_row['product_quantity']+1;
						mysql_query("UPDATE Cart SET product_quantity='$inc_quantity' WHERE product_id='$product_id' AND user_id='$user'");
					}
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