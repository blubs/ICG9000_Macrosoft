<?php
	$username = $con->escape_string($_POST['username']);
	$result = $con->query("SELECT * FROM users WHERE username='$username'") or die($con->error());
	
	if($result->num_rows == 0){
		header("location: index.php");
	}
	else {
		$user = $result->fetch_assoc();

		if(password_verify($_POST['password'], $user['password'])){
			session_start();
			$_SESSION['username'] = $user['username'];
			$_SESSION['id'] = $user['id'];

			$id = $user['id'];
			$session = $con->escape_string(sha1(rand(0,1000)));
			$_SESSION['session'] = $session;

			$query = "INSERT INTO user_session (id, session) VALUES ('$id', '$session')";
			$result = $con->query($query);
			header("location: main_menu.php");
		}
	}
?>
