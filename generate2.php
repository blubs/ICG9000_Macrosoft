<?php
	require 'db.php';
	$input = json_decode(file_get_contents('php://input'));
	$Faculty = $input->Faculty;
	$json = array();
	foreach($Faculty as $key => $value){
		array_push($json, $value.' LOL');
	}
	return json_encode($json);
?>
