<?php
	if(isset($_POST['prof_name'], $_POST['office_hours'])){
		include_once('db.php');
		$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if(!$con){
			die("Connection Failed: " . mysqli_connect_error());
			exit();
		}
		
		$query = "INSERT INTO professors (name, office_hours) ";
		$query .= "VALUES ('".$_POST['prof_name']."', '";
		$query .= $_POST['office_hours']."')";
		echo '<br/>'.$query.'<br/>';
		if(mysqli_query($con, $query)){
			echo 'Successfully added office hours';
		}else{
			echo 'Error adding office hours: ' . mysqli_error($con).'<br/>';
		}
	}
?>