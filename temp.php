<?php
	require 'db.php';
	$username = 'root';
	$password = $con->escape_string(password_hash('admin', PASSWORD_BCRYPT));
	$hash = $con->escape_string(sha1(rand(0,1000)));
	$result = $con->query("INSERT INTO users (username, password, hash) VALUES ('$username', '$password', '$hash')") or die($con->error());
?>
