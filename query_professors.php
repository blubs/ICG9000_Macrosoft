<?php	
	/* This file pulls all the professors from the professor table to automatically fill the select field with all the professors names */

	/* Tells php it will be working with javascript inputs */
	header('Content-type: text/javascript');
	/* Includes the connection to the sql server */
	include_once("db.php");

	/* Attempts to connect to the sql server */
	$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if(!$con){
		die("Connection Failed: " . mysqli_connect_error());
		exit();
	}
	
	/* The return variable declaration and partial initialization */
	$json = array('success'=>false, 'result'=>[]);

	/* The query to get all the professors from the professors table */
	$query = "SELECT Faculty FROM professors";

	/* Contains all the rows from the sql query */
	$result = mysqli_query($con, $query);	
	/* Tests if results contains something */
	if(!$result){
		die('Could not query: ' . mysqli_error());
	}
	/* Adds the professor name one at a time to the return variable */
	while($row = mysqli_fetch_assoc($result)){
		array_push($json['result'], $row['Faculty']);
	}
	/* Useless */
	$json['success'] = true;
	/* Returns the return variable */
	echo json_encode($json);
?>
