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
			if ("<?php echo $_SESSION['user'];?>" == ""){
				window.location.replace('register.php')
			}
			if ( $('#navbar-cart').hasClass('opened') ){
				console.log("closed");
				$(".navbar-cart-open").fadeOut();
				$("#navbar-cart").removeClass('opened');
			}
			else {
				$('#navbar-cart').addClass('opened');
				<?php include_once 'dbconnect.php' ?>
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
				<div id="cart-items" class="navbar-cart-open" style="display:none;" >
				<?php
					include_once 'dbconnect.php';
					$id = $userRow['id'];

					$carts_query = ("SELECT * FROM Cart WHERE user_id='$id'");
					$carts = mysql_query($carts_query) or die(mysql_error());
					$carts_row_num = mysql_num_rows($carts);
					if ($carts_row_num == 0) {
						echo 'Your Cart IS Empty';
					} else {
						$overall_sum = 0;echo 
						"<table class='cart-table' style='width:100%' border='1'>
											  <tr>
											    <th>Product Name</th>
											    <th>Price</th>		
											    <th>Quantity</th>
											    <th>Cancel</th>
											    <th>Total</th>
											  </tr> ";
						while ($cart_row = mysql_fetch_assoc($carts)) {
							if ($cart_row > 0) {
								$sum_prices = 0;
								$cart_product_id = $cart_row['product_id'];
								$cart_products_query = "SELECT * FROM Product WHERE id='$cart_product_id'";
								$cart_products = mysql_query($cart_products_query) or die(mysql_error());
								
								while($cart_product_row = mysql_fetch_assoc($cart_products)){
									$sum_prices = $sum_prices + $cart_row['product_quantity'] * $cart_product_row['price'];
									echo "	<tr style='text-align: center'>
												<td>{$cart_product_row['name']}</td>
												<td>\${$cart_product_row['price']}</td>
												<td>{$cart_row['product_quantity']}</td>
												<td> <a class='remove-anchor' href = 'index.php?removeid={$cart_product_id}'> X </a> </td> 
											";
								}
								echo "<th> \$$sum_prices </th></tr>";
								
								$overall_sum = $overall_sum + $sum_prices;
							}
						}
						echo "</table>";
						echo "<br>";
						echo "<br>";
						echo "<div class='total-price'>Total Price: \$$overall_sum</div>"; 
						echo "<br>";
						echo "<br>";
						echo "<a class='checkout-anchor'href = 'checkout.php'> Checkout </a>";
					}
				?>
			</div>
			<div class="navbar-cart-exit"></div>
			</div>

			<div class="navbar-content">
			<div class="vertical-line"></div>
			</div>
			<div class="logout">
				<a href="logout.php?logout">Sign Out</a>
			</div>
			<div class="navbar-content">
				<div class="navbar-name">
					<?php
						echo"<div class= 'username'>
							<a href='profile.php'> {$userRow['firstName']}{$userRow['lastName']}</a>
								</div>";
					?>
				</div>
			</div>

		</div>
		</div>
		<div class="landing-slider">
			<div class="galleria"></div>
		</div>
		<div class="product-container">
			<div class="product-title">Products</div>
		
			<?php

				include_once 'dbconnect.php';
				if (isset($_SESSION['user'])) {
					$user = $_SESSION['user'];
				}
				if (!empty($_GET['removeid']) AND !empty($_GET['addid']) AND !isset($_SESSION['user'])) {
					header ("Location: register.php");
				}	
				if(!empty($_GET['addid']))
				{
					$product_id = isset($_GET['addid']) ? $_GET['addid'] : "";
					$cart = mysql_query("SELECT * FROM Cart WHERE product_id='$product_id' AND user_id='$user'");
					$num_of_rows = mysql_num_rows($cart);
					if($num_of_rows == 0 ) {
						mysql_query("INSERT INTO Cart(product_id, user_id, product_quantity) VALUES('$product_id', '$user', '1')");
					}
					else {
						$cart_row = mysql_fetch_array($cart);
						$inc_quantity = $cart_row['product_quantity'] + 1;
						mysql_query("UPDATE Cart SET product_quantity='$inc_quantity' WHERE product_id='$product_id' AND user_id='$user'");
					}
					header("Location: index.php");
				}
				if(!empty($_GET['removeid']))
				{
					$product_id_remove = isset($_GET['removeid']) ? $_GET['removeid'] : "";
					mysql_query("DELETE FROM Cart WHERE product_id = '$product_id_remove' AND user_id = '$user' ");
					header("Location: index.php");
				}
				
				//List all products
				$query_products = "SELECT * FROM Product ORDER BY name";
				$products = mysql_query($query_products) or die (mysql_error());
				while($row = mysql_fetch_assoc($products))
				{
					if($row >0){
							
					echo"<div class='product-block-1'> 
									<div class ='add-to-cart-href'>
										<a href='index.php?addid={$row['id']}'>ADD TO CART</a>
									</div>
										<div class= 'product-image'> 
											<img class='img' src='images/{$row['image']}'>
										</div>
										<div class='product-info'>
										<div class='product-name'><span class='title'>Title:</span>  {$row['name']}</div>
										<div class='product-price'><span class='price'> Price: </span>  {$row['price']} $ </div>
										<div class='product-stock'><span class= 'available'>Available:</span>  {$row['stock']} left</div>
										</div>
										<input type='hidden' name='product_id' value='{$row['id']}'/>

								
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