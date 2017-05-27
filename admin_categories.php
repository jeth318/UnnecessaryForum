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

if (isset($_GET['cat'])) {

	$table = "category";
		$where = "id";
		$parameter = $_GET['cat'];

		$result = $db->deleteFrom($table, $where, $parameter);
		
		if($result == true){

			echo '<h2 class="delete_success">Category successfully deleted!</h2>';
		} else {
			echo '<h2 class="delete_fail">Delete failed</h2>';
			
		}
}


$db = new Database;
$table = "categories";
$categories = $db->selectAllFrom($table);

?>
<div class="middle_header">
    <h4 class="middle_header_h4">CRUD-tools CATEGORIES</h4>
</div>
<br><br>

<table border=1 frame=void rules=rows>
	<tr>
		<th>ID</th>
		<th>Title</th>
	<tr>
	
<?php

while($row = mysqli_fetch_assoc($categories)){
	$cat_id = $row['id'];
	$cat_name = $row['category_name'];

	echo 
		"<tr class='row_hover'>
			<td>$cat_id</td>
			<td>$cat_name</td>
			<td><a href='edit.php?cat=$cat_id'>Edit</a></td>
			<td><a href='db/delete.php?cat=$cat_id'id='delete_user_link'>Delete</a></td>
		<tr>
		";
}
?>

</table>

<?php include ('overall/bottom.php') ?>