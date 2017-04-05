<?php
	require 'db.php';
	session_start();
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
	</head>
	<body>	
		<div id='generate'>
			<form action='edit.php' method='post'>
				<select name='Faculty'>
					<?php
						$result = $con->query("SELECT Faculty FROM professors");
						
						while($row = $result->fetch_assoc()){
							echo "<option>".$row['Faculty']."</option>";
						}
						echo "</select>";
					?>
				</select><br/>
				<input name='office_hours' placeholder='Office Hours'>
				<input name='phone' placeholder='Phone'>
				<input name='email' placeholder='Email'>
				<input name='room' placeholder='Room'>
				<button name='update'>Update Professor</button>
			</form>
		</div>
	</body>
</html>
