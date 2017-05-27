<?php
/*
if (isset($_POST['q'])){
	
	include 'db/DatabaseClass.php';
	$searchTerm = $_POST['q'];
	$db = new Database;
	$result = $db->searchTopics($searchTerm);

	while($row = mysqli_fetch_assoc($result)){

		$topic_title_search = $row['topic_title'];	
			$topic_id_search = $row['topic_id'];

			echo '
			<ul style="list-style-type: none;">
				<li>
					<a href="view_topic.php?id='.$topic_id_search.'">'.$topic_title_search.'</a>
				</li>
			</ul>
			'; 
	}
} 
 ?>