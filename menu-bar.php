<?php
	require 'isloggedin.php';
?>
<div id='menu-bar'>
	<div class='menu-bar-item'><a href='main_menu.php'>Main Menu</a></div>
	<div class='menu-bar-item'><a href='edit.php'>Edit</a></div>
	<div class='menu-bar-item'><a href='print-information-cards.php'>Print</a></div>
	<?php
		$id = $_SESSION['id'];
		$query = "SELECT permissions FROM users WHERE id='$id'";
		$result = $con->query($query);
		$row = $result->fetch_assoc();
		$permissions = $row['permissions'];

		if($permissions == 0){
			echo "<div class='menu-bar-item'><a href='account-management.php'>Account Management</a></div>";
		}
	?>
	<div id='logout' class='menu-bar-item'><a href='logout.php'>Logout</a></div>
</div>
