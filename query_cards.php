<?php
	include_once("db.php");

	$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if(!$con){
		die("Connection Failed: " . mysqli_connect_error());
		exit();
	}

	header('Content-type: text/javascript');
	
	$json = [];

	$query = "SELECT Class_NUMBER, Course, Sec, Course_Title FROM csc LIMIT 10";
	$result = mysqli_query($con, $query);	
	if(!$result){
		die('Could not query: ' . mysqli_error());
	}
	while($row = mysqli_fetch_assoc($result)){
		array_push($json, array($row['Class_NUMBER'], $row['Course'], $row['Sec'], $row['Course_Title']));
	}
	echo json_encode($json);
?>
