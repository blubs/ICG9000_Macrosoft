<?php
	$username = $con->escape_string($_POST['username']);
	$result = $con->query("SELECT * FROM users WHERE username='$username'") or die($con->error());
	
	if($result->num_rows == 0){
		$_SESSION['message'] = "User doesn't exist";
		header("location: error.php");
	}
else {
	$user = $result->fetch_assoc();

	if(password_verify($_POST['password'], $user['password'])){
		$_SESSION['username'] = $user['username'];
		$_SESSION['logged_in'] = true;
		header("location: edit.php");
	}
}
?>
