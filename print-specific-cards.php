<?php
require 'db.php';
session_start();
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
						echo "<li class='pickit-list-item'>".$row['Faculty']."</li>";
					}
				?>
			</ul>
			<div class='pickit-list-button-container'>
				<button class='pickit-list-button' id='add'>Add</button>
				<button class='pickit-list-button' id='remove'>Remove</button>
				<button class='pickit-list-button' id='add_all'>Add All</button>
				<button class='pickit-list-button' id='remove_all'>Remove All</button>
				<button class='pickit-list-button' id='print'>Print</button>
			</div>
			<ul class='pickit-list' id='picked'>
				<li>Heyy</li>
			</ul>
		</div>
	</body>
</html>
