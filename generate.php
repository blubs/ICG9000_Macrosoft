<?php
	require 'db.php';
	session_start();
	/* $input = json_decode(file_get_contents('php://input')); */
	/* print_r($array); */
	$array = explode('.', $_POST['input']);	
?>
<html>
	<head>
		<title>Generate Cards</title>
		<link rel='stylesheet'type='text/css' href='styles.css'>
	</head>
	<body>
		<?php
			foreach($array as $key => $value){
				$_POST['Faculty'] = $value;
				echo '
					<h2 class="cardTitle">CALIFORNIA STATE UNIVERSITY, SACRAMENTO</h2>
					<h2 class="cardTitle">DEPARTMENT OF COMPUTER SCIENCE</h2>
					<h2 class="cardTitle">FALL 2016</h2>
					<br/>
					<h2 class="cardTitle">';
				echo $_POST['Faculty'].'</h2>';
				echo ';
					<table>
						<tr>
							<th>Course</th>
							<th>Section</th>
							<th>Days</th>
							<th>Time</th>
							<th>Room</th>
						</tr>';
				$Faculty = $_POST['Faculty'];
				$query = "SELECT Course, Sec, Days, `Start Time`, `End Time`, Room FROM csc WHERE Faculty='$Faculty'";
				$result = $con->query($query) or die("Query failed: ". $con->error);
				while($row = $result->fetch_assoc()){
					echo 
						"<tr>".
							"<td>".$row['Course']."</td>".
							"<td>".$row['Sec']."</td>".
							"<td>".$row['Days']."</td>".
							"<td>".$row['Start Time']."-".$row['End Time']."</td>".
							"<td>".$row['Room']."</td>".
						"</tr>";
				}
				echo '</table><br/>';
				$query = "SELECT office_hours, phone, email, room FROM professors WHERE Faculty='$Faculty'";
				$result = $con->query($query) or die("Professors Query failed: ".$con->error);
		$row = $result->fetch_assoc();
		echo "<h2 class='cardTitle'>Office Hours: ". $row['office_hours']. "</h2>"; 
		echo "<h2 id='Office' class='cardTitle'>Office: ". $row['room']. "</h2>"; 
		echo "<h2 id='Email' class='cardTitle'>Email: ". $row['email']. "</h2>"; 
		echo '<br/>';
		echo '<br/>';
		echo '<br/>';
			}
		?>
	</body>
</html>
