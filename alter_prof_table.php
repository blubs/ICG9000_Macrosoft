<?php
	/* Test if the list has a selected option and if office_hours isn't blank */
	if(isset($_POST['list']) && !empty($_POST['list']) && $_POST['list'] != 'All'){
		/* include the connection information to the mysql server */
		include_once('db.php');
		
		/* connect to the mysql server or die and exit */
		$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if(!$con){
			die("Connection Failed: " . mysqli_connect_error());
			exit();
		}

		$Faculty = mysqli_real_escape_string($con, $_POST['list']);

		/* Goes through each input of the forum and updates the field one at at time */
		foreach($_POST as $key=>$value){
			if($key != 'list'){
				if(empty($value)){
					continue;
				}
				$col = mysqli_real_escape_string($con, $key);
				$query = "UPDATE professors SET ".$col."=? WHERE Faculty=?";
				echo '<br/>'.$query.'<br/>';
				$stmt = mysqli_prepare($con, $query);
				if(!$stmt){
					die('Prepare statment failed'.mysqli_error($con));
				}
				mysqli_stmt_bind_param($stmt, 'ss', $value, $Faculty);
				mysqli_execute($stmt);
				mysqli_stmt_close($stmt);
			}
		}
	}
?>
