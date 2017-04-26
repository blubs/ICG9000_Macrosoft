<?php
	require_once 'isloggedin.php';

	$log = isloggedin();
	if($log == 0){
		header('location: index.php');
	}

	header("Content-Type: application/json; charset=UTF-8");
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if(isset($_POST['user'])){

		}else{
			$faculty = $con->escape_string($_POST['faculty']);
			foreach($_POST as $key=>$value){
				if($key == 'faculty'){
					continue;
				}
				$input = $con->escape_string($value);
				if($input != ''){
					$query = "UPDATE professors SET `$key`='$input' WHERE Faculty='$faculty'";
					$result = $con->query($query);
				}else{
					$query = "UPDATE professors SET `$key`=NULL WHERE Faculty='$faculty'";
					$result = $con->query($query);
			}
		}
		
		$json = array('Success');
		echo json_encode($json);
		}
	}else{
		$faculty = $con->escape_string($_GET['faculty']);
		$query = "SELECT * FROM professors WHERE Faculty='$faculty'";
		$result = $con->query($query);
		$row = $result->fetch_assoc();
		echo json_encode($row);
	}	
?>
