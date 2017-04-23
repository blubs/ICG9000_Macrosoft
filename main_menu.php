<?php
	require 'isloggedin.php';

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
<html>
	<head>
		<title>Card Generator</title>
		<link rel='stylesheet'type='text/css' href='styles.css'>
	</head>
	<body>
		<div id='container'>
		<?php include_once('menu-bar.php');?>
		<div id='center-container'>
			<h1 class='main-menu-title'>Main Menu</h1>
			<form action='print-information-cards.php'>
				<input class='main-menu-item' name='print-information-cards' value='Print Information Cards' type='submit'>
			</form>
			<form action='edit.php'>
				<input class='main-menu-item' name='edit-professor-information' value='Edit Professor Information' type='submit'>
			</form>
			<form action='select-file-upload.php'>
				<input class='main-menu-item' name='upload' value="CSV Upload" type='submit'>
			</form>
		</div>
		</div>
	</body>
</html>
