<?php
error_reporting(0);
session_start();

if(!isset($_SESSION['username']) || $_SESSION['username'] != "admin"){

	header('Location: index.php');
	exit();
}

include ('overall/top.php');
include 'db/DatabaseClass.php';

$db = new Database;

if (isset($_GET['user'])) {
	$table = "members";
	$where = "username";
	$parameter = $_GET['user'];

	if ($parameter == "admin" || $parameter == "jeth11") {
		echo 'Cant delete superusers';
		exit();
	}

	$result = $db->deleteFrom($table, $where, $parameter);
	
	
	if($result == true){

			echo '<h2 class="delete_success">User successfully deleted!</h2>';
		} else {
			echo '<h2 class="delete_fail">Delete failed</h2>';
			
		}
}

$db = new Database;
$table = "members";
$members = $db->selectAllFrom($table);

?>
<div class="middle_header">
    <h4 class="middle_header_h4">CRUD-tools MEMBERS</h4>
</div>
<br><br>
<a href="register.php">Create new member</a>
<br>
<hr>
<table border=1 frame=void rules=rows>
	<tr>
		<th>ID</th>
		<th>Username</th>
		<th>Email</th>

	<tr>
<?php

while($row = mysqli_fetch_assoc($members)){
	$user_id = $row['id'];
	$username = $row['username'];
	$email = $row['email'];

	echo 
		"<tr class='row_hover'>
			<td>$user_id</td>
			<td>$username</td>
			<td>$email</td>
			<td><a href='edit.php?user=$username'>Edit</a></td>
			<td><a href='admin_users.php?user=$username'id='delete_user_link'>Delete</a></td>
		<tr>
		";
}
?>

</table>

<?php include ('overall/bottom.php') ?>