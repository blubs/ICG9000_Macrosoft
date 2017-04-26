<?php
require_once 'db.php';
session_start();

function isloggedin(){
	global $con;
	if(!isset($_SESSION['username'], $_SESSION['id'], $_SESSION['session'])){
		return 0;
	}else{
		$id = $_SESSION['id'];
		$session = $_SESSION['session'];
		$query = "SELECT id FROM user_session WHERE id='$id' AND session='$session'";
		$result = $con->query($query);
		if($result->num_rows > 0){
			return 1;
		}else {
			return 0;
		}
	}
}
?>
