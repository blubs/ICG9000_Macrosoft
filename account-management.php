<?php
	require 'db.php';
	session_start();

	if(!isset($_SESSION['username'])){
		header('location: index.php');
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
			<div id='center-container'>
				<div class='main-menu-title'>User Accounts</div>
				<div id='account-table-container'>
					<div id='account-table'>
					<?php
						$query = "SELECT username FROM users";
						$result = $con->query($query);
						while($row = $result->fetch_assoc()){
							echo "<div id='account-table-row'>";
							echo '<div class="account-table-row-item" id="account-user">'.$row['username'].'</div>';
							echo "
								<div class='account-table-row-item' id='account-table-delete'>
									DELETE
								</div>
								</div>";
						}
					?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
