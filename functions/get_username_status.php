<?php
include "../db/DatabaseClass.php";

if(!empty($_POST["user"])) {

	$db = new Database;
	$username = $_POST['user'];

	$res = $db->checkUsername($username);

	if($res == true) {
		echo "<span class='status-not-available'> Username Not Available.</span>";
	}
	else {
		echo "<span class='status-available'> Username Available.</span>";
	}
}

?>