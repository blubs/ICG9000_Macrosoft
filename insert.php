<?php
	require_once 'isloggedin.php';

	$log = isloggedin();
	if($log == 1){
		header('location: main_menu.php');
	}

	$fname = $_FILES['file']['name'];
	$chk_ext = explode('.', $fname);
	
	if(strtolower(end($chk_ext)) == 'csv'){
		$filename = $_FILES['file']['tmp_name'];
		$handle = fopen($filename, 'r');
		$headers = [];

		for($line = 1; ($data = fgetcsv($handle, 1000, ',')) !== FALSE; $line++){
			if($line < 6){
				continue;
			}elseif($line == 6){
				foreach($data as $key=>$value){
					$insert = $con->escape_string($value);
					array_push($headers, $insert);
				}	
				deleteTable('csc');
				createTable($headers, 50);
			}elseif($line > 6){
				if(intval($data[0])==0){
					continue;
				}
				insertIntoTable($headers, $data);	
			}
		}
	}
	header('location: main_menu.php');
function createTable($headers, $varchar){
	global $con;
	$query = "CREATE TABLE csc (";
	foreach($headers as $key=>$value){
		$query .= '`'.$value.'` VARCHAR(' . $varchar . '), ';	
	}
	$query .= "FOREIGN KEY (Faculty) REFERENCES professors(Faculty))";
	$con->query($query) or die("Query failed: ".$con->error());
}
function insertIntoTable($headers, $data){
	global $con;
	$query = "INSERT INTO csc (";	
	foreach($headers as $key=>$value){
		$query .= '`'.$value.'`, ';	
		if($value == 'Faculty'){
			professor($data[$key]);
		}
	}
	$query = rtrim($query, ', ');
	$query .= ') VALUES (';
	foreach($data as $key=>$value){
		$insert = $con->escape_string($value);
		$query .= "'" . $insert . "', ";	
	}
	$query = rtrim($query, ', ');
	$query .= ')'; 
	$con->query($query) or die("Inserting into table failed".$con->error());

}
function professor($name){
	global $con;
	$query = "INSERT INTO professors (Faculty) VALUES ('".$name."')";	
	$con->query($query);
}
function deleteTable($table){
	global $con;
	$query = "DROP TABLE IF EXISTS ".$table;
	$con->query($query);
}
?>
