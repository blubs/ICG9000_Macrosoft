<?php
require 'db.php';
session_start();
	if(!isset($_SESSION['username'])){
		header('location: index.php');
	}
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if(isset($_POST['edit-professor-information'])){
			header('location: edit.php');
		}elseif(isset($_POST['upload'])){
			/* require 'insert.php'; */
		}elseif(isset($_POST['logout'])){
			header('location: logout.php');
		}elseif(isset($_POST['edit'])){
			header('location: edit.php');
		}

	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Card Generator</title>
		<link rel='stylesheet'type='text/css' href='styles.css'>
	</head>
	<body>
		<?php include_once('menu-bar.php');?>
		<div class='center'>
			<h1>Main Menu</h1>
			<form action='print-information-cards.php'>
				<input name='print-information-cards' value='Print Information Cards' type='submit'>
			</form>
			<form action='edit.php'>
				<input name='edit-professor-information' value='Edit Professor Information' type='submit'>
			</form>
			<form action='select-file-upload.php'>
				<input name='upload' value="CSV Upload" type='submit'>
			</form>
		</div>
	</body>
</html>
