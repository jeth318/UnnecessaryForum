<?php
error_reporting(0);
session_start();

// KONTROLLERAR BEHÖRIGHET. Enbart användare med användarnamnet ADMIN har tillgång till denna sida. 
if(!isset($_SESSION['username']) || $_SESSION['username'] != "admin"){

	header('Location: index.php');
	exit();

}
include ('overall/top.php');
include 'db/DatabaseClass.php';

$db = new Database;
$table = "members";
$members = $db->selectAllFrom($table);

?>
<div class="middle_header">
    <h4 class="middle_header_h4">CRUD-tools</h4>
</div>
<br>
<br>
<ul>
	<li>
		<a href="admin_users.php">Members</a>
	</li>
	<li>
		<a href="admin_topics.php">Topics</a>
	</li>
	<li>
		<a href="admin_posts.php">Posts</a>
	</li>
	<li>
		<a href="admin_categories.php">Categories</a>
	</li>
</ul>

<?php include ('overall/bottom.php') ?>