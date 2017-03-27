<?php
	if(isset($_POST['submit'])){
		$fname = $_FILES['csvfile']['name'];
		$chk_ext = explode('.', $fname);
		
		if(strtolower(end($chk_ext)) == 'csv'){
			$filename = $_FILES['csvfile']['tmp_name'];
			$handle = fopen($filename, 'r');
			$headers = [];

			for($line = 1; ($data = fgetcsv($handle, 1000, ',')) !== FALSE; $line++){
				if($line < 6){
					continue;
				}else if($line == 6){

					for($i = 0; $i < sizeof($data); $i++){
						array_push($headers, trim($data[$i]));
					}

					include_once('db.php');
					$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
					if(!$con){
						die("Connection Failed: " . mysqli_connect_error());
						exit();
					}
					if(mysqli_query($con, 'DROP TABLE IF EXISTS csc')){
						echo "Table deleted";
					}else{
						echo "Error removing table: " . mysqli_error($con) . '<br/>';
					}
					$query = createTable($headers, 50);
						echo '<br>'.$query.'<br/>';
					if(mysqli_query($con, $query)){
						echo "Table created";
					}else{
						echo "Error creating table: " . mysqli_error($con) . '<br/>';
						}
				}else if($line > 6){
					if(intval($data[0])!=0){
						$query = createQuery($headers, $data);	
						echo '<br/>' . $query . '<br/>';
						if (mysqli_query($con, $query)) {
					    echo "New record created successfully";
						} else {
		   				 echo "Error: " . mysqli_error($con) . '<br/>';
							 echo "<br/> headers: " . sizeof($headers);
							 echo '<br/> data: ' . sizeof($data) . '<br/>';
						}
					}
				}
			}
			mysqli_close($con);
			fclose($handle);

		}else{
			echo 'file is not csv format';
		}
	}
	function createTable($array, $varchar){
		$query = "CREATE TABLE csc (";
		foreach($array as $key=>$value){
			$query .= $value . ' VARCHAR(' . $varchar . ')';	
			if($key != sizeof($array)-1){
				$query .= ', ';
			}
		}
		$query .= ")";
		return $query;
	}
	function createQuery($array, $data){
		$query = "INSERT INTO csc (";	
		foreach($array as $key=>$value){
			$query .= $value ;	
			if($key != sizeof($array)-1){
				$query .= ', ';
			}
		}
		$query .= ') VALUES (';	
		foreach($data as $key=>$value){
			if(empty($value)){
				$query .= 'NULL';
			}else{
				$query .= "'" . $value . "'";	
			}
			if($key != sizeof($data)-1){
				$query .= ', ';
			}
		}
		$query .= ')'; 
		return $query;
	}
?>
