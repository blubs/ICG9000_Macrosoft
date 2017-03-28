<?php
	/* Tells php that it is working with javascript */
	header('Content-type: text/javascript');
	/* Includes the connection to the sql server */
	include_once("db.php");
	/* $input = json_decode(file_get_contents('php://input')); */
	/* echo 'offset: ' . $_POST[offset]; */
	/* echo 'Faculty: ' . $_POST[Faculty]; */

	/* Attempts to connect to the sql server */
	$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if(!$con){
		die("Connection Failed: " . mysqli_connect_error());
		exit();
	}

	/* The array that will be returned to the ajax call */
	$json = [];

	/* Sets teh scope of the $query variable */
	$query = '';
	
	/* Checks if User wants to see all classes or only for  certain professor */
	if($_POST[Faculty] != 'All'){		
		$query = "SELECT Class_NUMBER, Course, Sec, Course_Title FROM csc WHERE Faculty='$_POST[Faculty]'";
	}else{
		$query = "SELECT Class_NUMBER, Course, Sec, Course_Title FROM csc LIMIT $_POST[offset], $_POST[limit]";
	}

	/* Variable contains all the rows that the query returns */
	$result = mysqli_query($con, $query);	
	/* Checks if result actually contians something */
	if(!$result){
		die('Could not query: ' . mysqli_error());
	}
	/* Goes through results variable row at a tim and pushes entire row into the return variable $json */
	while($row = mysqli_fetch_assoc($result)){
		array_push($json, array($row['Class_NUMBER'], $row['Course'], $row['Sec'], $row['Course_Title']));
	}
	/* Returns the return variable */
	echo json_encode($json);
?>
