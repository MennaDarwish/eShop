<?php
	session_start();
	include_once 'dbconnect.php';

	$logged_in_user = $_SESSION['user'];

	$product_id = $_GET['addid'];
	$product_query = mysql_query("SELECT * FROM Product WHERE id = '$product_id'");
	$product_row = mysql_fetch_assoc($product_query);
	$prodcut_name = $product_row['name'];
	$prodcut_price = $product_row['price'];
	$image_link = $product_row['image'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add to Cart</title>
	<link rel="stylesheet" type="text/css" href="stylesheet/style.css">
</head>
<body>
		<div class="invoice-div">
			<div class="product-image">
				<img class="img-invoice" src="images/<?php echo $image_link ?>">
			</div>

			<div class='product-info-invoice'>
				<div class='product-name'><span class='title'>Title:</span> <?php echo $prodcut_name ?> </div>
				<div class='product-price'><span class='price'> Price: </span>  $<?php echo $prodcut_price ?> </div>
			</div>

			<?php echo "<div class ='confirm-add'><a href='index.php?addid={$product_id}'>Confirm Add To Cart</a></div>" ?>
		</div>
</body>
</html>