<html>
	<head>
		<title>ICG</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="script.js" type="text/javascript"></script>
		<link rel='stylesheet'type='text/css' href='styles.css'>
	</head>
	<body>
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
		<!-- A simple next-page button that will call to retreive data from the mysql server again, but change the offset and limit-->
		<button name='next-page' id='next-page' type='button'>Next-Page</button>
		<!-- The table that is filled with the class data -->
		<table id='result' name='result'>

		</table>
	</body>
</html>
