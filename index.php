<?php
	require 'db.php';
	session_start();

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if(isset($_POST['login'])){
			require 'login.php';
		}	
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<link rel='stylesheet'type='text/css' href='styles.css'>
	</head>
	<body>
		<div class='center'>
			<h1>Login</h1>
			<form action='index.php' method='post'>
					<input name='username' type='text' placeholder='Username'>
					<br/>
					<input name='password' type='password' placeholder='Password'>
					<br/>
					<button id='login-button' name='login'>Login</button>
			</form>
		</div>
	</body>
</html>
