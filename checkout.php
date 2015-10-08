<?php 
	session_start();
	include_once 'dbconnect.php';

	$logged_in_user = $_SESSION['user'];
	//get all items in cart
	$carts_query = ("SELECT * FROM Cart WHERE user_id='$logged_in_user'");
	$carts = mysql_query($carts_query) or die(mysql_error());
	$carts_row_num = mysql_num_rows($carts);
	if($carts_row_num > 0) {	//if any items in cart
		while($cart_row = mysql_fetch_assoc($carts)) {
			$cart_product_id = $cart_row['product_id'];
			$cart_product_quantity = $cart_row['product_quantity'];
			$cart_user_id = $cart_row['user_id'];
			//get all items in history of the same user and product
			$history_query = ("SELECT * FROM History 
				WHERE user_id='$logged_in_user' AND product_id = '$cart_product_id'");
			$history = mysql_query($history_query) or die(mysql_error());
			$history_row_num = mysql_num_rows($history);

			$product_query = mysql_query("SELECT * FROM Product WHERE id = '$cart_product_id'");
			$product_row = mysql_fetch_assoc($product_query);
			$stock_amount = $product_row['stock'];
			$cart_amount = $cart_row['product_quantity'];
			$wanted_amount = min($cart_amount, $stock_amount);

			if($history_row_num == 0) {
				//if no previous history of the transaction insert it
				$insert_query = ("INSERT INTO History (product_id, user_id, transaction_quantity) 
					VALUES ('$cart_product_id', '$cart_user_id', '$cart_product_quantity')");
				mysql_query($insert_query) or die(mysql_error());
			} else {
				//if previous history of transaction append them together
				$history_row = mysql_fetch_assoc($history);
				$history_amount = $history_row['transaction_quantity'];

				$new_amount = $history_amount + $wanted_amount;
				$update_query = ("UPDATE History SET transaction_quantity = '$new_amount' 
					WHERE user_id = '$cart_user_id' 
					AND product_id = '$cart_product_id'");
				mysql_query($update_query) or die(mysql_error());
			}

			$decreased_amount = $product_row['stock'] - $wanted_amount;
			
			$decrease_query = ("UPDATE Product SET stock = '$decreased_amount' 
								WHERE id = '$cart_product_id'");
			mysql_query($decrease_query) or die (mysql_error());

			$remove_query = ("DELETE FROM Cart WHERE user_id = '$logged_in_user' 
				AND product_id = '$cart_product_id'");
			mysql_query($remove_query) or die(mysql_error());	
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Purchase Complete</title>
	<link rel="stylesheet" type="text/css" href="stylesheet/style.css">
</head>
<body>
	<div class="purchase-done">
			<div class='purchase-done-text'>
				<div class='product-name'><span class='title'>Purchase Confirmed</span></div>
				
				<div class ='confirm-done'><a href='index.php'>Back to Home Page</a></div>
			</div>
		</div>
</body>
</html>