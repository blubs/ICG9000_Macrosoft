<div id='menu-bar'>
	<a href='main_menu.php'><div class='menu-bar-item'>Main Menu</div></a>
	<a href='edit.php'><div class='menu-bar-item'>Edit</div></a>
	<a href='print-information-cards.php'><div class='menu-bar-item'>Print</div></a>
	<?php
		/* $id = $_SESSION['id']; */
		/* $query = "SELECT permissions FROM users WHERE id='$id'"; */
		/* $result = $con->query($query); */
		/* $row = $result->fetch_assoc(); */
		/* $permissions = $row['permissions']; */

		/* if($permissions == 0){ */
		/* 	echo "<div class='menu-bar-item'><a href='account-management.php'>Account Management</a></div>"; */
		/* } */
	?>
	<a href='account-management.php'><div class='menu-bar-item'>Account Management</div></a>
	<a id='logout' href='logout.php'><div class='menu-bar-item'>Logout</div></a>
</div>
