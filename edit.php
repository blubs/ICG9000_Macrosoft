<?php
	require 'db.php';
	session_start();
	if(!isset($_SESSION['username'])){
		header('location: index.php');
	}
?>
<html>
	<head>
		<title>Edit</title>
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
							$result = $con->query("SELECT Faculty FROM professors");	
							while($row = $result->fetch_assoc()){
								$query = "SELECT Faculty FROM professors WHERE Faculty='".$row['Faculty']."' AND ((office_hours is NULL OR room is NULL) OR (phone is NULL AND email is NULL))";
								$missing = $con->query($query);
								$pink = $missing->num_rows;
								if($pink > 0){
									echo "<div class='side-bar-item missing-info'>".$row['Faculty']."</div>";
								}else{
									echo "<div class='side-bar-item'>".$row['Faculty']."</div>";
								}
							}
					?>
				</div>
				<div id='input-field-container'>
					<input class='edit-input' id='edit-office-hours' type='text' placeholder='Office Hours'>
					<input class='edit-input' id='edit-phone' type='text' placeholder='Phone Number'>
					<input class='edit-input' id='edit-email' type='text' placeholder='Email'>
					<input class='edit-input' id='edit-room' type='text' placeholder='Office Room'>
					<input class='edit-input' id='update-button' type='button' value='UPDATE'>
					<div id='success' class='edit-input update-message'>SUCCESS</div>
					<div id='failure' class='edit-input update-message'>FAILURE</div>
				</div>
			</div>
		</div>
	</body>
</html>
