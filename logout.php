<?php
	require 'isloggedin.php';
	
	$id = $_SESSION['id'];
	$session = $_SESSION['session'];
	$query = "DELETE FROM user_session WHERE id='$id' AND session='$session'";
	$result = $con->query($query);
	session_unset();
	header('location: index.php');
?>
