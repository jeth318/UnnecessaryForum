<?php 
include 'db/db_connect.php';

if($conn){
	echo 'Jadå';
}
else {
	echo 'Nejj';
}

$partialStates = $_POST['partialStates'];

$states = mysqli_query("SELECT * FROM forum_topics WHERE topic_title LIKE '%$partialStates%'");

while($state = mysqli_fetch_array($states)){
	echo "<div>" .$row['topic_title']. "</div>";
}

?>