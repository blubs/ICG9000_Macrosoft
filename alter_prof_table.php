<?php
	/* Test if the list has a selected option and if office_hours isn't blank */
	if(isset($_POST['list'], $_POST['office_hours'])){
		/* include the connection information to the mysql server */
		include_once('db.php');
		
		/* connect to the mysql server or die and exit */
		$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if(!$con){
			die("Connection Failed: " . mysqli_connect_error());
			exit();
		}
		
		/* The query which will update the office hours only of the professor selected in the list */
		$query = "UPDATE professors SET office_hours='".$_POST['office_hours']."' WHERE Faculty='".$_POST['list']."'";
		echo '<br/>'.$query.'<br/>';

		/* Test if query went through the connection */
		if(mysqli_query($con, $query)){
			echo 'Successfully added office hours';
		}else{
			echo 'Error adding office hours: ' . mysqli_error($con).'<br/>';
		}
	}
?>
