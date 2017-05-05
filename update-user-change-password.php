<?php 
	require_once 'isloggedin.php';
	
	$log = isloggedin();
	if($log == 0){
		header('location: index.php');
	}

	header("Content-Type: application/json; charset=UTF-8");

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$json = array();
		$password = $_POST['password'];
		if(!isset($_POST['username'], $_POST['password'])){
			$json["error"] = 'Username or Password is not set';
			die(json_encode($json));
		}
		if(strlen($password) < 8){
			$json["error"] = 'Password is less than 8 characters long';
			die(json_encode($json));
		}
		if(strpos($password, ';') == true){
			$json['error'] = 'Password has semi-colon';
			die(json_encode($json));
		}
		if(!preg_match('/[A-Z]+[a-z]+[0-9]+/', $password)){
			$json['error'] = 'Password must contain one upper-case letter, one lower-case letter and one digit';
			die(json_encode($json));
		}

		$username = $con->escape_string($_POST['username']);
		$result = $con->query("SELECT * FROM users WHERE username='$username'");
		
		if($result->num_rows == 0){
			$json['error'] = 'User does not exist';
			die(json_encode($json));
		}
		
		$password = $con->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));

		$query = "UPDATE users SET password='$password' WHERE username='$username'";	
		$con->query($query);

		die(json_encode('Changed password for '.$username));
	}
?>
