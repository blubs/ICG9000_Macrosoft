<?php
	/* Tells php that it is working with javascript */
	header('Content-type: text/javascript');
	/* Includes the connection to the sql server */
	include_once("db.php");

	/* Attempts to connect to the sql server */
	$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if(!$con){
		die("Connection Failed: " . mysqli_connect_error());
		exit();
	}

	$json = [];
	printf("username: %s", $_POST['username']);
	printf("password: %s", $_POST['password']);
	if(!isset($_POST['username'], $_POST['password'])){
		die("Please enter a username and password");
	}

	$query = "SELECT id FROM users WHERE username=? AND password=?";
	$stmt = mysqli_prepare($con, $query);
	if(!$stmt){
		die("Prepare statment failed");
	}

	mysqli_stmt_bind_param($stmt, 'ss', $_POST['username'], $_POST['password']);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $result);
	mysqli_stmt_fetch($stmt);

	if(!$result){
		die("No result");	
	}
	printf("Result: %s", $result);
	array_push($json, $result);
	echo json_encode($json);
	array_push($json, $result);
	mysqli_stmt_close($stmt)		
?>
