<html>
	<head>
		<title>ICG</title>
	</head>
	<body>
		<form action='insert.php' method='post' enctype='multipart/form-data'>
			<input name='csvfile' type="file" value"FILE">
			<input type="submit" value="submit" name='submit'>
		</form>
		<select id='list'>

		</select>
		<button type="button">Generate Informtion Cards</button>
		<form action='alter_table.php' method='post' enctype='multipart/form-data'>
			<input name='prof_name' placeholder='Name' type='text'>
			<input name='office_hours' placeholder='Office Hours' type='text'>
			<input type='submit' value='submit office hours'>
		</form>
	</body>
</html>