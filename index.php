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
			<div class="navbar-register">Register</div>
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
				mysql_connect("localhost", "root", "") or die (mysql_error());
				mysql_select_db('eShop') or die (mysql_error());

				$query_products = "SELECT * FROM Product ORDER BY name";
				$products = mysql_query($query_products) or die (mysql_error());
				while($row = mysql_fetch_assoc($products))
				{
					if($row >0){

					echo "<div class='product-block-1'>{$row['name']} {$row['price']} 
					<img class='img' src='images/{$row['image']}'>
					</div>";
				

					} else 
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