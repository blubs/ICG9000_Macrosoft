<?php	
	include_once("db.php");

	$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if(!$con){
		die("Connection Failed: " . mysqli_connect_error());
		exit();
	}

	header('Content-type: text/javascript');
	
	$json = array('success'=>false, 'result'=>[]);

	$query = "SELECT Faculty FROM professors";
	$result = mysqli_query($con, $query);	
	if(!$result){
		die('Could not query: ' . mysqli_error());
	}
	while($row = mysqli_fetch_assoc($result)){
		array_push($json['result'], $row['Faculty']);
	}
	$json['success'] = true;
	echo json_encode($json);
?>
