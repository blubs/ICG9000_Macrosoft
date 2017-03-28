<?php
	/* include the connection info to the mysql server */	
	include_once('db.php');

	/* connect to the mysql server or die and exit */
	$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if(!$con){
		die("Connection Failed: " . mysqli_connect_error());
		exit();
	}

	/* Only continue if the submit button was pressed, not sure if this is needed actually */
	if(isset($_POST['submit'])){
		/* Gets the name of the file that was submitted */
		$fname = $_FILES['csvfile']['name'];
		/* Breaks the name appart to see if the extension is csv */
		$chk_ext = explode('.', $fname);
		
		/* Where the actual checking if file is csv or not happens */
		if(strtolower(end($chk_ext)) == 'csv'){
			/* Gets the path name to the file to open it */
			$filename = $_FILES['csvfile']['tmp_name'];
			/* Opens the actual file based on path name */
			$handle = fopen($filename, 'r');
			/* Array that will store the headers. This is going to be used to input data into the appropriate columns when doing the sql query */
			$headers = [];

			/* This goes through every line of the csv document, but will only read up to 1000 characters just in case */
			for($line = 1; ($data = fgetcsv($handle, 1000, ',')) !== FALSE; $line++){
				/* if the currect line is before the headers just ignore and continue */
				if($line < 6){
					continue;
				}
				/* if it is the 6th line then start reading the headers */
				else if($line == 6){

					/* Input all the values into the headers array */
					for($i = 0; $i < sizeof($data); $i++){
						array_push($headers, trim(str_replace(')', '_', str_replace('(', '_', str_replace('#', 'NUMBER', str_replace(' ', '_', $data[$i]))))));
					}
					/* Throw away the old csc table if it exists, otherwise continue */
					if(mysqli_query($con, 'DROP TABLE IF EXISTS csc')){
						echo "<br/> Table deleted <br/>";
					}else{
						echo "<br/> Error removing table: " . mysqli_error($con) . '<br/>';
					}

					/* Call the function that creates the right string to create a table with all the appropriate columns */	
					$query = createTable($headers, 50);
					echo '<br>'.$query.'<br/>';
					
					/* Attempt to do query */
					if(mysqli_query($con, $query)){
						echo "<br/> Table created <br/>";
					}else{
						echo "<br/> Error creating table: " . mysqli_error($con) . '<br/>';
					}
				}
				/* Check we have passed the headers line */	
				else if($line > 6){
					/* Since the first column contains class #, test if the first column contains a number, if it doesn't then ignore it */
					if(intval($data[0])!=0){
						/* call the function that creates the appropriate query string to insert csv row into the mysql server */
						$query = createQuery($headers, $data);	
						echo '<br/>' . $query . '<br/>';
						
						/* Test if query goes through or not */
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
			/* Close the sql connection and the file */
			mysqli_close($con);
			fclose($handle);

		}
		/* The original file submitted wasn't a csv file so nothing happens */
		else{
			echo 'file is not csv format';
		}
	}
	/* The table that creates the string query to create the csc table with all the headers */
	function createTable($array, $varchar){
		$query = "CREATE TABLE csc (";
		foreach($array as $key=>$value){
			$query .= $value . ' VARCHAR(' . $varchar . '), ';	
		}
		/* Sets the Faculty as a FOREIGN KEY that will reference the professors table */ 
		$query .= "FOREIGN KEY (Faculty) REFERENCES professors(Faculty))";
		return $query;
	}
	/* Creates the stirng query that will input all the data into the sql server, and returns that string */
	function createQuery($array, $data){
		/* Prepares the first part of the string that contains all the columns that will be inputed */
		$query = "INSERT INTO csc (";	
		foreach($array as $key=>$value){
			$query .= $value ;	
			if($key != sizeof($array)-1){
				$query .= ', ';
			}
			/* if the column is under the Faculty header input that professor under the professors table */
			if($value == 'Faculty'){
				insertProfessorNameIntoSeparateTable($data[$key]);
			}
		}
		/* Prepares teh second part of the string that contains all the actual values that will be put */
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
	/* Inputs the professors name under the professors table */ 
	function insertProfessorNameIntoSeparateTable($name){
		/* This function not only creates the string, but also does the sql query, not sure if good or bad thing */
		global $con;
		$query = "INSERT INTO professors (Faculty, office_hours) VALUES ('".$name."', '')";	
		/* Attempts to do the query */
		if(mysqli_query($con, $query)){
			echo "<br/> Professor table updated <br/>";
		}else{
			echo "<br/> Error updating Professor table: " . mysqli_error($con) . '<br/>';
		}
	}
?>
