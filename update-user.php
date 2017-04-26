<?php
	require_once 'isloggedin.php';

	$log = isloggedin();
	if($log == 0){
		header('location: index.php');
	}

	header("Content-Type: application/json; charset=UTF-8");

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if(isset($_POST['username'], $_POST['password'], $_POST['new-password'])){
			if($_POST['new-password'] != $_POST['new-password-retyped']){
				 die('Passwords do not  match');
			}
			$username = $con->escape_string($_POST['username']);
			$result = $con->query("SELECT * FROM users WHERE username='$username'") or die($con->error());
			
			if($result->num_rows == 0){
				echo json_encode('User does not exist');
			}
			
			$password = $con->escape_string($_POST['password']);
			$newPassword = $con->escape_string($_POST['new-password']);

			$user = $result->fetch_assoc();


			if(password_verify($_POST['password'], $user['password'])){
				$password = $con->escape_string(password_hash($_POST['new-password'], PASSWORD_BCRYPT));
				$query = "UPDATE users SET password='$password' WHERE username='$username'";	
				$result = $con->query($query);
				echo json_encode('Changed password for '.$username);
			}else{
				die('Password of user does not match');
			}
		}else if(isset($_POST['username'], $_POST['password'])){
			$username = $_POST['username'];
			$password = $con->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
			$hash = $con->escape_string(sha1(rand(0,1000)));
			$result = $con->query("INSERT INTO users (username, password, hash) VALUES ('$username', '$password', '$hash')") or die($con->error());
			echo json_encode($username);
		}else if(isset($_POST['username'])){
			$username = $con->escape_string($_POST['username']);
			$query = "DELETE FROM users WHERE username='$username'";
			$result = $con->query($query);
			echo json_encode("Username: ".$username." was removed from database");
		}
	}
?>
