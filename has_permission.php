<?php
	require 'isloggedin.php';
	
	$id = $_SESSION['id'];
	$query = "SELECT permissions FROM users WHERE id='$id'";
	$result = $con->query($query);
	$row = $result->fetch_assoc();
	$permission = $row['permissions'];

	if($permission == 0){
		
	}
?>
