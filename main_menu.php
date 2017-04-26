<?php
	require_once 'isloggedin.php';

	$log = isloggedin();
	if($log == 0){
		header('location: index.php');
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
