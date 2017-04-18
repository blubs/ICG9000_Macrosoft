<?php
require 'db.php';
session_start();
	
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(isset($_POST['input'])){
		if(!($_POST['input'] == '')){
			require 'generate.php';
		}
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Print Specific</title>
		<link rel='stylesheet'type='text/css' href='styles.css'>
		<script src="jquery-3.2.0.min.js"></script>	
		<script src='script.js'></script>
	</head>
	<body>
		<?php include_once('menu-bar.php');?>
		<div class='center' id='pickit-list-container'>
			<h1>Pick Professors To Print</h1>
			<ul class='pickit-list' id='unpicked'>
				<?php
					$result = $con->query("SELECT Faculty FROM professors");	
					while($row = $result->fetch_assoc()){
						$query = "SELECT Faculty FROM professors WHERE Faculty='".$row['Faculty']."' AND ((office_hours is NULL OR room is NULL) OR (phone is NULL AND email is NULL))";
						$missing = $con->query($query);
						$pink = $missing->num_rows;
						if($pink > 0){
							echo "<li class='pickit-list-item missing-info'>".$row['Faculty']."</li>";
						}else{
							echo "<li class='pickit-list-item'>".$row['Faculty']."</li>";
						}
					}
				?>
			</ul>
			<div class='pickit-list-button-container'>
				<button class='pickit-list-button' id='add'>Add</button>
				<button class='pickit-list-button' id='remove'>Remove</button>
				<button class='pickit-list-button' id='add_all'>Add All</button>
				<button class='pickit-list-button' id='remove_all'>Remove All</button>
				<form action='' id='print' method='post'>
					<input type='text' style='display: none;' name='input' id='inputData'>
					<input type='submit' class='pickit-list-button' value='Print'>
				</form>
			</div>
			<ul class='pickit-list' id='picked'>

			</ul>
		</div>
	</body>
</html>
