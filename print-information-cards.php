<?php
	require 'db.php';
	session_start();

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if(isset($_POST['all'])){
			/* $query = "SELECT Faculty FROM professors WHERE (office_hours is NULL OR room is NULL) OR (phone is NULL AND email is NULL)"; */
			/* $result = $con->query($query); */
			/* $rows = $result->num_rows; */
			/* if($rows > 0){ */
			/* 	echo 'Unable to print all professors there are '.$rows.' Professors with missing info'; */
			/* } */
		}else if(isset($_POST['specific'])){
			
		}	
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Print Information Cards</title>
		<link rel='stylesheet'type='text/css' href='styles.css'>
	</head>
	<body>
		<?php include_once('menu-bar.php');?>
		<div class='center'>
			<h1>Print Info Cards</h1>
			<form action='generate.php' method='post'>
				<input type='submit' name='all' value='Print All Professors'>
			</form>
			<form action='print-specific-cards.php'>
				<input type='submit' name='specific' value='Specific Professors'>
			</form>
		</div>
	</body>
</html>
