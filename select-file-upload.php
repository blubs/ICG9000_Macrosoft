<?php
require 'db.php';
session_start();
	if(!isset($_SESSION['username'])){
		header('location: index.php');
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Card Generator</title>
		<link rel='stylesheet'type='text/css' href='styles.css'>
	</head>
	<body>
		<?php include_once('menu-bar.php'); ?>
		<div class='center'>
			<h1>Select File</h1>
			<form action='insert.php' method='POST' enctype='multipart/form-data'>
				<input name='file' value='upload' type='file'>
				<input type='submit' value='submit'>
			</form>
		</div>
	</body>
</html>
