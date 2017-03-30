<?php
	/* Tells php that it is working with javascript */
	header('Content-type: text/javascript');
	/* Includes the connection to the sql server */
	include_once("db.php");
	
	/* Starts a session for logged in user */
	session_start();

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

	/* Query to get the id of the user */
	$query = "SELECT * FROM users WHERE username=? AND password=?";

	/* The prepare statment declaration */
	$stmt = mysqli_prepare($con, $query);
	if(!$stmt){
		die("Prepare statment failed");
	}

	/* Binds statment variable to the username and password entered in the form */
	mysqli_stmt_bind_param($stmt, 'ss', $_POST['username'], $_POST['password']);
	/* Executes the query using the prepare statment */
	mysqli_stmt_execute($stmt);

	/* gets result of query and puts it into variable result */
	$result =	mysqli_stmt_get_result($stmt);
	/* Gets the row of of result */
	$row = mysqli_fetch_assoc($result);
	
	/* Sets session username and id */  
	$_SESSION['username'] = $row['username']; 
	$_SESSION['id'] = $row['id']; 

	/* Closes statmet and connection */	
	mysqli_stmt_close($stmt)		
?>
