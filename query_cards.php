<?php
	header('Content-type: text/javascript');
	include_once("db.php");
	/* $input = json_decode(file_get_contents('php://input')); */
	/* echo 'offset: ' . $_POST[offset]; */
	/* echo 'Faculty: ' . $_POST[Faculty]; */

	$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if(!$con){
		die("Connection Failed: " . mysqli_connect_error());
		exit();
	}

	$json = [];
	$query = '';
	if($_POST[Faculty] != 'All'){		
		$query = "SELECT Class_NUMBER, Course, Sec, Course_Title FROM csc WHERE Faculty='$_POST[Faculty]'";
	}else{
		$query = "SELECT Class_NUMBER, Course, Sec, Course_Title FROM csc LIMIT $_POST[offset], $_POST[limit]";
	}
	$result = mysqli_query($con, $query);	
	if(!$result){
		die('Could not query: ' . mysqli_error());
	}
	while($row = mysqli_fetch_assoc($result)){
		array_push($json, array($row['Class_NUMBER'], $row['Course'], $row['Sec'], $row['Course_Title']));
	}
	echo json_encode($json);
?>
