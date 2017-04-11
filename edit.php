<?php
	require 'db.php';
	session_start();
	if(!isset($_SESSION['username'])){
		header('location: index.php');
	}
	if(isset($_POST['update'], $_POST['Faculty'])){
		$Faculty = $con->escape_string($_POST['Faculty']);
		foreach($_POST as $key=>$value){
			if($key=='Faculty' || $key=='update'){
				continue;	
			}else{
				$col = $con->escape_string($key);
				$val = $con->escape_string($value);
				$query = "UPDATE professors SET $col='$val' WHERE Faculty='$Faculty'";
				$con->query($query);
			}
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Edit</title>
		<link rel='stylesheet'type='text/css' href='styles.css'>
	</head>
	<body>	
		<?php include_once('menu-bar.php'); ?>
		<ul class='side-menu-container'>
			<?php 
				$result = $con->query("SELECT Faculty FROM professors");	

				while($row = $result->fetch_assoc()){
					echo "<li class='side-menu-item'>".$row['Faculty']."</li>";
				}
			?>
		</ul>
		<div id='generate'>
			<form action='edit.php' method='post'>
				<input name='office_hours' placeholder='Office Hours'>
				<input name='phone' placeholder='Phone'>
				<input name='email' placeholder='Email'>
				<input name='room' placeholder='Room'>
				<button name='update'>Update Professor</button>
			</form>
		</div>
	</body>
</html>
