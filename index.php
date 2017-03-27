<html>
	<head>
		<title>ICG</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="script.js" type="text/javascript"></script>
	</head>
	<body>
		<form action='insert.php' method='post' enctype='multipart/form-data'>
			<input name='csvfile' type="file" value"FILE">
			<input type="submit" value="submit" name='submit'>
		</form>
		<button type="button">Generate Informtion Cards</button>
		<form action='alter_prof_table.php' method='post' enctype='multipart/form-data'>
			<select name='list' id='list'>

			</select>
			<input name='office_hours' placeholder='Office Hours' type='text'>
			<input type='submit' value='submit office hours'>
		</form>
	</body>
</html>
