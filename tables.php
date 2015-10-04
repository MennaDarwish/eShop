<?php
	mysql_connect('localhost', 'root', '');

	mysql_query("DROP DATABASE eShop");
	mysql_query("CREATE DATABASE eShop;");

	mysql_select_db('eShop');

	mysql_query("DROP TABLE Product;");
	mysql_query(
		"CREATE TABLE Product(
			id int PRIMARY KEY AUTO_INCREMENT,
			name varchar(40),
			price DECIMAL,
			stock int,
			image varchar(255)
		);") or die (mysql_error());

	mysql_query("DROP TABLE User;");
	mysql_query(
		"CREATE TABLE User(
			id int PRIMARY KEY AUTO_INCREMENT,
			email varchar(40),
			firstName varchar(40),
			lastName varchar(40),
			password varchar(40)
		);") or die (mysql_error());
	
	mysql_query("DROP TABLE Cart;");
	mysql_query(
		"CREATE TABLE Cart(
			product_id int FOREIGN KEY REFERENCES Product(id),
			user_id int FOREIGN KEY REFERENCES User(id),
			PRIMARY KEY (product_id, user_id)
			);") or die (mysql_error());
	
	mysql_query("DROP TABLE Cart;");
	mysql_query(
		"CREATE TABLE Cart(
			product_id int FOREIGN KEY REFERENCES Product(id),
			user_id int FOREIGN KEY REFERENCES User(id),
			PRIMARY KEY (product_id, user_id)
		);") or die (mysql_error());
?>