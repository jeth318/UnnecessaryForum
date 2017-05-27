<?php session_start();

include 'DatabaseClass.php';
$db = new Database;

switch ($var) {
	case 'user':
		$table = "members";
		$where = "username";
		$parameter = $_GET['user'];

		if ($parameter == "admin" || $parameter == "jeth11") {
			echo 'cant delete superusers';
			exit();
		}
		$result = $db->deleteFrom($table, $where, $parameter);
	break;

	case 'topic':
		$table = "forum_topics";
		$where = "topic_id";
		$parameter = $_GET['topic'];

		$result = $db->deleteFrom($table, $where, $parameter);
		
		if(!$result == "success"){

			header('Location: ../admin_topics.php');
		} else {
			echo 'Delete failed';	
		}
	break;

	case 'category':
		$table = "category";
		$where = "id";
		$parameter = $_GET['cat'];

		$result = $db->deleteFrom($table, $where, $parameter);
		
		if(!$result == "success"){

			header('Location: ../admin_categories.php');
		} else {
			echo 'Delete failed';			
		}
	break;

	case 'post':
		$table = "forum_posts";
		$where = "post_id";
		$parameter = $_GET['post'];

		$result = $db->deleteFrom($table, $where, $parameter);
		
		if(!$result == "success"){

			header('Location: ..admin_categories.php');
		} else {
			echo 'Delete failed';			
		}
	break;

	default:
		echo 'Switch didnt work';
	break;
}
?>