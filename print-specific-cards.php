<?php
require 'isloggedin.php';
	
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(isset($_POST['input'])){
		if(!($_POST['input'] == '')){
			require 'generate.php';
		}
	}
}
?>
<html>
	<head>
		<title>Print Specific</title>
		<link rel='stylesheet'type='text/css' href='styles.css'>
		<script src="jquery-3.2.0.min.js"></script>	
		<script src='script.js'></script>
	</head>
	<body>
		<div id='container'>
		<?php include_once('menu-bar.php');?>
		<div id='center-container'>
			<h1 class='main-menu-title'>Pick Professors To Print</h1>
			<div id='pickit-list-container'>
				<div class='pickit-list-separate-container'>
					<h2 class='pickit-list-title'>Pick to Print</h2>
				<div class='pickit-list' id='unpicked'>
					<?php
						$result = $con->query("SELECT Faculty FROM professors");	
						while($row = $result->fetch_assoc()){
							$query = "SELECT Faculty FROM professors WHERE Faculty='".$row['Faculty']."' AND ((office_hours is NULL OR room is NULL) OR (phone is NULL AND email is NULL))";
							$missing = $con->query($query);
							$pink = $missing->num_rows;
							if($pink > 0){
								echo "<div class='pickit-list-item missing-info'>".$row['Faculty']."</div>";
							}else{
								echo "<div class='pickit-list-item'>".$row['Faculty']."</div>";
							}
						}
					?>
				</div>
				</div>
				<div id='pickit-list-button-container'>
					<form class='pickit-list-button'>
						<input type='button' id='add' class='pickit-list-form-button' value='Add'>
					</form>
					<form class='pickit-list-button'>
					 	<input type='button' id='remove' class='pickit-list-form-button' value='Remove'>
					</form>
					<form class='pickit-list-button'>
						<input type='button' id='add_all' class='pickit-list-form-button' value='Add All'>
					</form>
					<form class='pickit-list-button'>
						<input type='button' id='remove_all' class='pickit-list-form-button' value='Remove All'>
					</form>
					<form action='generate.php' class='pickit-list-button' id='print' method='post'>
						<input type='text' style='display: none;' name='input' id='inputData'>
						<input type='submit' class='pickit-list-form-button' value='Print'>
					</form>
				</div>
				<div class='pickit-list-separate-container'>
					<h2 class='pickit-list-title'>Print</h2>
					<div class='pickit-list' id='picked'>

					</div>
				</div>
			</div>
		</div>
		</div>
	</body>
</html>
