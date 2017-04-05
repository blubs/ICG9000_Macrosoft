<?php
	/* The connetion information to the mysql server */
	define('DB_HOST', 'athena');
	define('DB_USER', 'macrosoft_user');
	define('DB_PASSWORD', 'macrosoft_db');
	define('DB_NAME', 'macrosoft');
	$con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
?>
