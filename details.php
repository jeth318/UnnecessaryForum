<?php
error_reporting(0);
session_start();

if(!isset($_SESSION['username']) || $_SESSION['username'] != "admin"){

	header('Location: index.php');
	exit();
}

if (isset($_GET['post'])) {

	include ('overall/top.php');
	include 'db/DatabaseClass.php';

	$db = new Database;

	$table = "forum_posts";
	$where = "post_id";
	$parameter = $_GET['post'];

	$db = new Database;
	$table = "forum_posts";
	$postInfo = $db->selectOneFrom($table, $where, $parameter);
}

?>
<div class="middle_header">
    <h4 class="middle_header_h4">CRUD-tools POSTS (Details)</h4>
</div>
<br><br>
<br>
<hr>

<table border=1 frame=void rules=rows>
	<tr>
		<th >Creator</th>
		<th colspan="3" style="text-align: center;">Content</th>
		<th>Topic ID</th>
		<th>Date posted</th>

	<tr>
	
<?php

while($row = mysqli_fetch_assoc($postInfo)){
	$post_id = $row['post_id'];
	$post_creator = $row['post_creator'];
	$post_topic_id = $row['post_topic_id'];
	$post_time = $row['post_time'];
	$post_content = $row['post_content'];

	echo 
		"<tr class='row_hover'>
			<td>$post_creator</td>
			<td colspan='3'>$post_content</td>
			<td>$post_topic_id</td>
			<td>$post_time</td>
		<tr>
		";
}
?>

</table>

<?php include ('overall/bottom.php') ?>

?>