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

if (isset($_GET['topic'])) {

	$table = "forum_topics";
	$where = "topic_id";
	$parameter = $_GET['topic'];

	$result = $db->deleteFrom($table, $where, $parameter);
	
	if($result == true){

			echo '<h2 class="delete_success">Topic successfully deleted!</h2>';
		} else {
			echo '<h2 class="delete_fail">Delete failed</h2>';
			
		}
}

$db = new Database;
$table = "forum_topics";
$topics = $db->selectAllFrom($table);

?>
<div class="middle_header">
    <h4 class="middle_header_h4">CRUD-tools TOPICS</h4>
</div>
<br><br>
<a href="post_topic.php">Create new topic</a>
<br>
<hr>

<table border=1 frame=void rules=rows>
	<tr>
		<th>ID</th>
		<th>Title</th>
		<th>Creator</th>
	<tr>
	
<?php

while($row = mysqli_fetch_assoc($topics)){
	$topic_id = $row['topic_id'];
	$topic_title = $row['topic_title'];
	$topic_creator = $row['topic_creator'];

	echo 
		"<tr class='row_hover'>
			<td>$topic_id</td>
			<td>$topic_title</td>
			<td>$topic_creator</td>
			<td><a href='edit.php?topic=$topic_id'>Edit</a></td>
			<td><a href='admin_topics.php?topic=$topic_id'id='delete_user_link'>Delete</a></td>
		<tr>
		";
}
?>

</table>

<?php include ('overall/bottom.php') ?>