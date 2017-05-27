<?php session_start();

include 'DatabaseClass.php';
$db = new Database;

if(isset($_POST['submit']) && isset($_POST['reply_content']) && isset($_POST['var'])){

	$username = $_SESSION['username'];
	$post_content = $_POST['reply_content'];
	$topic_id = $_POST['var'];

	$result = $db->insertIntoPosts($username, $post_content, $topic_id);

		if($result == true){		
			header('Location: ../view_topic.php?id=' . $topic_id);
		}
		else {
			echo 'insert failed';
		}
	} else {
		echo 'Not all fields were set';
	}
?>