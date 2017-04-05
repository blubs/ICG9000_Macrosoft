<?php
require 'db.php';
	session_start();
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if(isset($_POST['login'])){
			require 'login.php';
		}elseif(isset($_POST['upload'])){
			require 'insert.php';
		}elseif(isset($_POST['logout'])){
			header('location: logout.php');
		}elseif(isset($_POST['edit'])){
			header('location: edit.php');
		}

	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Card Generator</title>
		<link rel='stylesheet'type='text/css' href='styles.css'>
	</head>
	<body>
		<div id='login'>
			<form action='index.php' method='post'>
			<?php
				if(isset($_SESSION['username'])){
					echo "Welcome: ".$_SESSION['username'];		
				}else{
					echo "		
							<label>Username:</label>
							<input name='username' type='text'>
							<label>Password:</label>
							<input name='password' type='password'>
							<button name='login'>Login</button>
						";
				}
			?>
				<button id='edit' name='edit'>Edit</button> 
				<button id='logout' name='logout'>Logout</button> 
			</form>
		</div>
		<div id='generate'>
			<form action='generate.php' method='post'>
				<select name='Faculty'>
<?php
	$result = $con->query("SELECT Faculty FROM professors");

	while($row = $result->fetch_assoc()){
		echo "<option>". $row['Faculty']."</option>";
	}
	echo "</select>";
?>
				</select><br/>
				<button name='generate'>Generate Cards</button>
			</form>
		</div>
		<div id='uploadForm'>
			<form action='index.php' method='post' enctype='multipart/form-data'>
			<input name='csvfile' type="file" value"FILE">
			<button name='upload'>UPLOAD</button>
		</form>
		</div>
	</body>
</html>
