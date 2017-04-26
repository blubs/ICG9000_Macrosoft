<?php
	require_once 'isloggedin.php';

	$log = isloggedin();
	if($log != 1){
		header('location: index.php');
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if(isset($_POST['all'])){
			$query = "SELECT Faculty FROM professors WHERE (office_hours is NULL OR room is NULL) OR (phone is NULL AND email is NULL)";
			$result = $con->query($query);
			$rows = $result->num_rows;
			if($rows == 0){
				echo 'Unable to print all professors there are '.$rows.' Professors with missing info';
			}else{
				require 'generate.php';
			}
		}
	}
?>
<html>
	<head>
		<title>Print Information Cards</title>
		<link rel='stylesheet'type='text/css' href='styles.css'>
	</head>
	<body>
		<div id='container'>
		<?php include_once('menu-bar.php');?>
		<div id='center-container'>
			<h1 class='main-menu-title'>Print Info Cards</h1>
			<form action='' method='post'>
				<input class='main-menu-item' type='submit' name='all' value='Print All Professors'>
			</form>
			<form action='print-specific-cards.php'>
				<input class='main-menu-item' type='submit' name='specific' value='Specific Professors'>
			</form>
		</div>
		</div>
	</body>
</html>
