<?php
require 'db.php';
session_start();
	if(!isset($_SESSION['username'], $_SESSION['id'], $_SESSION['session'])){
		header('location: index.php');
	}else{
		$id = $_SESSION['id'];
		$session = $_SESSION['session'];
		$query = "SELECT id FROM user_session WHERE id='$id' AND session='$session'";
		$result = $con->query($query);
		if(!($result->num_rows > 0)){
			session_unset();
			header('location: index.php');
		}else {
			header('main_menu.php');
		}
	}
?>
