<?php
	session_start();
?>
<html>
	<head>
		<title>ICG</title>
		<script type='text/javascript' src="jquery-3.2.0.min.js"></script>
		<script src="script.js" type="text/javascript"></script>
		<link rel='stylesheet'type='text/css' href='styles.css'>
	</head>
	<body>
		<!-- show logged in user-->
		<h1>Logged in as: 
			<?php
				echo $_SESSION['username'];
			?>
			and id as: 
			<?php
				echo $_SESSION['id'];
			?>
		</h1>
		<!-- Login in form -->
		<form action='login.php' method='post' enctype='multipart/form-data'>
			Username:<input name='username' id='username'><br/>
			Password:<input name='password' id='password'><br/>
			<input type='submit' value='login'>
		</form>
		<!-- The form to insert a csv file to the mysql server-->
		<form action='insert.php' method='post' enctype='multipart/form-data'>
			<input name='csvfile' type="file" value"FILE">
			<input type="submit" value="submit" name='submit'>
		</form>
		<!-- Button that calls to retreive data from mysql server and put it into the table at the end of this file-->
		<button name='generate' id='generate' type="button">Generate Informtion Cards</button>
		<!-- The form to edit the office hours of a professor selected-->
		<form action='alter_prof_table.php' method='post' enctype='multipart/form-data'>
		<!-- Holds all the professor's names-->
			<select name='list' id='list'>
				<option selected>All</option>
			</select>
			<input name='office_hours' placeholder='Office Hours' type='text'>
			<input type='submit' value='submit office hours'>
		</form>
		<!-- Change limit -->
		<select name='limit' id='limit'>
			<option selected>10</option>
			<option >25</option>
			<option >50</option>
			<option >All</option>
		</select>
		<!-- A simple next-page button that will call to retreive data from the mysql server again, but change the offset and limit-->
		<button name='next-page' id='next-page' type='button'>Next-Page</button>
		<!-- The table that is filled with the class data -->
		<table id='result' name='result'>

		</table>
	</body>
</html>
