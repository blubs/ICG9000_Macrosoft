<?php
	require_once 'isloggedin.php';

	$log = isloggedin();
	if($log != 1){
		header('location: index.php');
	}

	$id = $_SESSION['id'];
	$query = "SELECT permissions FROM users WHERE id='$id'";
	$result = $con->query($query);
	$row = $result->fetch_assoc();
	$permissions = $row['permissions'];

	if($permissions != 0){
		header('location: main_menu.php');
	}
?>
<html>
	<head>
		<title>Account Management</title>
		<link rel='stylesheet'type='text/css' href='styles.css'>
		<script src="jquery-3.2.0.min.js"></script>	
		<script src='script.js'></script>
	</head>
	<body>
		<div id='container'>		
			<div id='menu-bar'>
				<?php require 'menu-bar.php' ?>
			</div>
			<div id='body-container'>
				<div id='side-bar'>
					<?php
						$query = 'SELECT username FROM users';
						$result = $con->query($query);
						echo "<div class='account-side-bar-item'>";
						echo "<div id='account-user' class='side-bar-item'>".$_SESSION['username']."</div>";
						echo "</div>";
						while($row = $result->fetch_assoc()){
							if($row['username'] == $_SESSION['username']){
								continue;	
							}
							echo "<div class='account-side-bar-item'>";
							echo "<div id='account-user' class='side-bar-item'>".$row['username']."</div>";
							echo "<div class='account-delete'>X</div>";
							echo "</div>";
						}
					?>
				</div>
				<div id='input-field-container'>
					<div class='account-tab-container'>
						<div id='change-password-tab' class='account-tab'>Change Password</div>
						<div id='add-user-tab' class='account-tab'>Add User</div>
					</div>
					<div id='change-password' class='account-tab-section'>
						<input id='change-password-current' class='edit-input' type='password' placeholder='Current Password'>
						<input id='change-password-new' class='edit-input' type='password' placeholder='New Password'>
						<input id='change-password-new-retyped' class='edit-input' type='password' placeholder='Retype New Password'>
						<input id='user-change-password' class='edit-input edit-input-button' type='button' value='Change Password'>
					</div>
					<div id='add-user' class='account-tab-section'>
						<input id='user-username' class='edit-input' type='text' placeholder='Username'>
						<input id='user-password' class='edit-input' type='password' placeholder='Password'>
						<input id='user-retyped-password' class='edit-input' type='password' placeholder='Retype Password'>
						<input class='edit-input edit-input-button' id='create-user-button' type='button' value='Create User'>
					</div>
				<div id='ajax-visual'>
					<div id='success' class='edit-input update-message'>SUCCESS</div>
					<div id='failure' class='edit-input update-message'>FAILURE</div>
				</div>
				</div>
			</div>
		</div>
	</body>
</html>
