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

if (isset($_GET['post'])) {

	$table = "forum_posts";
	$where = "post_id";
	$parameter = $_GET['post'];

	$result = $db->deleteFrom($table, $where, $parameter);
	
	if($result == true){

			//echo '<h2 class="delete_success">Post '.$parameter.' successfully deleted!</h2>';
		} else {
			echo '<h2 class="delete_fail">Delete failed</h2>';
			
		}
}

$db = new Database;
$table = "forum_posts";
$posts = $db->selectAllFrom($table);

?>
<div class="middle_header">
    <h4 class="middle_header_h4">CRUD-tools POSTS</h4>
</div>
<br>
<hr>

<table border=1 frame=void rules=rows>
	<tr>
		<th>Post ID</th>
		<th>Creator</th>
	<tr>
	
<?php

while($row = mysqli_fetch_assoc($posts)){
	$post_id = $row['post_id'];
	$post_creator = $row['post_creator'];
	$post_topic_id = $row['post_topic_id'];
	$post_time = $row['post_time'];
	$post_content = $row['post_content'];

	echo 
		"<tr class='row_hover'>
			<td>$post_id</td>
			<td>$post_creator</td>
			<td><a href='details.php?post=$post_id'>Details</a></td>
			<td><a href='edit.php?post=$post_id'>Edit</a></td>
			<td><a href='admin_posts.php?post=$post_id'id='delete_user_link'>Delete</a></td>
		<tr>
		";
}
?>

</table>

<?php include ('overall/bottom.php') ?>