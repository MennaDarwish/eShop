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
			product_id int,
			user_id int,
			product_quantity int,
			FOREIGN KEY (product_id) REFERENCES Product(id),
			FOREIGN KEY (user_id) REFERENCES User(id),
			PRIMARY KEY (product_id, user_id)
			);") or die (mysql_error());

	mysql_query("DROP TABLE History;");
	mysql_query(
		"CREATE TABLE History(
			product_id int,
			user_id int,
			transaction_quantity int,
			FOREIGN KEY (product_id) REFERENCES Product(id),
			FOREIGN KEY (user_id) REFERENCES User(id),
			PRIMARY KEY (product_id, user_id)
			);") or die (mysql_error());

	mysql_query("INSERT INTO Product (name, price, stock, image) 
		VALUES ('Japanese Kunai', 400, 15, 'kunai.png')");

	mysql_query("INSERT INTO Product (name, price, stock, image) 
		VALUES ('Bruce Lee\'s Scar-H', 250, 5, 'scarh.jpg')");

	mysql_query("INSERT INTO Product (name, price, stock, image) 
		VALUES ('gun', 400, 15, 'Guns_and_Knife.jpg')");

	mysql_query("INSERT INTO Product (name, price, stock, image) 
		VALUES ('Sword of At', 250, 5, 'Katana.png')");

	mysql_query("INSERT INTO User (email, firstName, lastName, password) 
		VALUES ('starzii@gmail.com', 'Salma', 'Eltarzy', 'salma')");

	mysql_query("INSERT INTO User (email, firstName, lastName, password) 
		VALUES ('menna.darwish1@gmail.com', Menna', 'Darwish', 'menna')");

	mysql_query("INSERT INTO User (email, firstName, lastName, password) 
		VALUES ('titomoha@gmail.com', 'Tarek', 'Elbeih', 'tarek')");
?>