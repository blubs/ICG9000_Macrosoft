<?php
	require 'db.php';
	$result = $con->query('DROP TABLE IF EXISTS csc');
	$result = $con->query('DROP TABLE IF EXISTS professors');
	$result = $con->query('DROP TABLE IF EXISTS users');
	$result = $con->query('DROP TABLE IF EXISTS user_session');

	/* $con->query('CREATE TABLE professors (Faculty varchar(50) PRIMARY KEY NOT NULL, office_hours varchar(120), phone varchar(20), email varchar(80), room varchar(20))'); */
	/* $con->query('CREATE TABLE users (id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, username varchar(50) NOT NULL UNIQUE, password varchar(100) NOT NULL, hash varchar(100) NOT NULL, permissions INT DEFAULT 0)'); */
	/* $con->query('CREATE TABLE user_session (id INT NOT NULL, session varchar(100) NOT NULL, FOREIGN KEY (id) REFERENCES users(id))'); */
?>
