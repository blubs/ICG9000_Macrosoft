<?php
	require_once 'isloggedin.php';

	$log = isloggedin();
	if($log == 0){
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
		<div id='container'>
		<?php require_once 'menu-bar.php'; ?>
		<div id='center-container'>
				<h1 class='main-menu-title'>Select File</h1>
				<form action='insert.php' method='POST' enctype='multipart/form-data'>
					<input class='main-menu-item' name='file' value='upload' type='file'>
					<input class='main-menu-item' type='submit' value='submit'>
				</form>
			</div>
		</div>
	</body>
</html>
