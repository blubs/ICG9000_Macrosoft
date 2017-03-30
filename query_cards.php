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

		/* Checks if limit has been selected as All */
		if($_POST[limit] == 'All'){
			/* Limit is set to All */
			$query = "SELECT Class_NUMBER, Course, Sec, Course_Title FROM csc WHERE Faculty=?";
			/* Creates prepare statment */
			$stmt = mysqli_prepare($con, $query);
			if(!$stmt){
				die("Prepare statment failed");
			}

			mysqli_stmt_bind_param($stmt, 's', $_POST[Faculty]);
		}else{
			/* Limit is not set to All */
			$query = "SELECT Class_NUMBER, Course, Sec, Course_Title FROM csc WHERE Faculty=? LIMIT ?, ?";
			/* Creates prepare statment */
			$stmt = mysqli_prepare($con, $query);
			if(!$stmt){
				die("Prepare statment failed");
			}
			mysqli_stmt_bind_param($stmt, 'sss', $_POST[Faculty], $_POST[offset], $_POST[limit]);
		}
	}else{
		/* Faculty was not set to All */
		/* Checks if limit is equal to All */
		if($_POST[limit] == 'All'){
			/* Limit is set to All */
			$query = "SELECT Class_NUMBER, Course, Sec, Course_Title FROM csc";
			/* Creates prepare statment */
			$stmt = mysqli_prepare($con, $query);
			if(!$stmt){
				die("Prepare statment failed");
			}
			mysqli_stmt_bind_param($stmt, '');
		}else{
			/* Limit was not set to All */
			$query = "SELECT Class_NUMBER, Course, Sec, Course_Title FROM csc LIMIT $_POST[offset], $_POST[limit]";
			/* Creates prepare statment */
			$stmt = mysqli_prepare($con, $query);
			if(!$stmt){
				die("Prepare statment failed");
			}
			mysqli_stmt_bind_param($stmt, 'ss', $_POST[offset], $_POST[limit]);
		}
	}
	/* Executes the prepared query */
	mysqli_stmt_execute($stmt);

	/* Variable contains all the rows that the query returns */
	$result = mysqli_stmt_get_result($stmt);	

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
