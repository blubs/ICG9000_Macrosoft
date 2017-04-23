<?php
	require 'isloggedin.php';

	$array = array();
	if(isset($_POST['input'])){
		$array = explode('.', $_POST['input']);	
	}else{
		/* array should be all the professors from the professor list */
		$result = $con->query("SELECT Faculty FROM professors");	
		while($row = $result->fetch_assoc()){
			array_push($array, $row['Faculty']);
		}
	}
?>
<html>
	<head>
		<title>Generate Cards</title>
		<link rel='stylesheet'type='text/css' href='styles.css'>
		<style>body {background-color: white}</style>
	</head>
	<body style='background-color: white'>
		<?php
			foreach($array as $key => $value){
				if($value == ''){
					continue;
				}
				$_POST['Faculty'] = $value;
				$Faculty = $_POST['Faculty'];
				$query = "SELECT Course, Sec, Days, `Start Time`, `End Time`, Room FROM csc WHERE Faculty='$Faculty'";
				$result = $con->query($query) or die("Query failed: ". $con->error);
				if(true){
					echo '<div id="card-center-container" class="break">';
				}else{
					echo '<div id="card-center-container">';
				}
				echo '
					<h2 class="card-title">CALIFORNIA STATE UNIVERSITY, SACRAMENTO</h2>
					<h2 class="card-title">DEPARTMENT OF COMPUTER SCIENCE</h2>
					<h2 class="card-title">FALL 2016</h2>
					<br/>
					<h2 class="card-title">';
				echo $_POST['Faculty'].'</h2>';
				$font = (.75)/$result->num_rows;
				$font = min(max($font,0.175),0.2);
				echo '
					<table id="card-table" style="font-size: '.$font.'in;">
						<tr>
							<th>Course</th>
							<th>Section</th>
							<th>Days</th>
							<th>Time</th>
							<th>Room</th>
						</tr>';
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
				echo '<div id="card-contact-container">';
				$query = "SELECT office_hours, phone, email, room FROM professors WHERE Faculty='$Faculty'";
				$result = $con->query($query) or die("Professors Query failed: ".$con->error);
		$row = $result->fetch_assoc();
		echo "<div id='Email' class='card-title'>Email: ". $row['email']. "</div>"; 
		echo "<div class='card-title'>Office Hours: ". $row['office_hours']. "</div>"; 
		echo "<div id='Office' class='card-title'>Office: ". $row['room']. "</div>"; 
		echo '</div>';
		echo '</div>';
			}
		?>
	</body>
</html>
