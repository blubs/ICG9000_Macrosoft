<?php
	require_once 'isloggedin.php';

	$log = isloggedin();
	if($log == 1){
		header('location: main_menu.php');
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if(isset($_POST['login'])){
			require 'login.php';
		}	
	}
?>
<html>
	<head>
		<title>Login</title>
		<link rel='stylesheet'type='text/css' href='styles.css'>
	</head>
	<body>
		<div id='container'>
		<div id='center-container'>
			<!--<h1 class='main-menu-title'>Login</h1>-->
			<form action='index.php' method='post'>
				<input class='main-menu-item' name='username' type='text' placeholder='Username'><br/>
				<input class='main-menu-item' name='password' type='password' placeholder='Password'><br/>
				<input class='main-menu-item' id='login-button' type='submit' name='login' value='Login'><br/>
			</form>
		</div>
		</div>
	</body>
</html>
