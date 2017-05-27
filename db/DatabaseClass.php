<?php
// EN DATABASCLASS FÖR ATT ANAMMA OOP. Här finns all databasinteraktion för att minimera koden och få ett enklare flow i sjävla programmerandet. Här finns generella funktioner för att stoppa in data i databas, men även för att hämta data. 
class Database {

	function connect(){
		//LOCAL
		//$conn = mysqli_connect("localhost", "root", "root", "219653-test");
		// ONLINE
		$conn = mysqli_connect("10.209.1.98", "219653_ed70525", "Jersep1&", "219653-test");

		if(!$conn){
			echo "Fuuudge, the connection couln't be established.";
		} else {
			return $conn;
		}
	}

	function selectAllFrom ($table){
		$db = new Database;
		$conn = $db->connect();
		$query = "SELECT * FROM " . $table;
		$result = mysqli_query($conn, $query);
		
		return $result;
	}
	function searchTopics ($searchTerm){
		$db = new Database;
		$conn = $db->connect();
		$query = 'SELECT * FROM forum_topics WHERE topic_title LIKE "%'.$searchTerm.'%" ';
		$result = mysqli_query($conn, $query);
		
		return $result;
	}
	function select ($table){
		$db = new Database;
		$conn = $db->connect();
		$query = "SELECT * FROM " . $table;
		$result = mysqli_query($conn, $query);
		
		return $result;
	}

	function selectOneFrom ($table, $tableCol, $checkParameter){
		$db = new Database;
		$conn = $db->connect();
		$query = "SELECT * FROM $table WHERE $tableCol = '$checkParameter'";

		if(!$result = mysqli_query($conn, $query)){
			echo 'ERROR: Bad result';
		} else{
			return $result;
		}		
	} 

	function insertIntoUsers ($username, $password, $email, $firstname, $lastname){
		$db = new Database;
		$conn = $db->connect();
		$query = "INSERT INTO members (username, password, email, first, last) VALUES('$username', '$password', '$email', '$firstname', '$lastname')";

		if(!$result = mysqli_query($conn, $query)){

			return false;
		} else {
			return true;
		}
	}

	function updateUsers ($username, $password, $email, $firstname, $lastname){
		$db = new Database;
		$conn = $db->connect();
		$query = "UPDATE members SET password='$password', email='$email', first='$firstname', last='$lastname' WHERE username = '$username'";

		if(!$result = mysqli_query($conn, $query)){

			return false;
		} else {
			return true;
		}
	}
	function updateAvatar ($username, $avatar_url){
		$db = new Database;
		$conn = $db->connect();
		$query = "UPDATE members SET avatar_url='$avatar_url' WHERE username = '$username'";

		if(!$result = mysqli_query($conn, $query)){
			return false;
		} else {
			return true;
		}
	}	

	function deleteFrom ($table, $tableCol, $checkParameter){
		$db = new Database;
		$conn = $db->connect();
		$query = "DELETE FROM $table WHERE $tableCol = '$checkParameter'";

		$result = mysqli_query($conn, $query);

		if(!$result){
			return false;
		} else {
			return true;
		}   
	}

	function getAvatar($username){
		$db = new Database;
		$conn = $db->connect();
		$sql = "SELECT avatar_url from members WHERE username = '$username'";

		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$avatar = $row['avatar_url'];

		return $avatar;
	}

	function getCategories(){
		$db = new Database;
		$conn = $db->connect();

		$sql = "SELECT category_name FROM categories";
		$result = mysqli_query($conn, $sql);

		while($row = mysqli_fetch_assoc($result)){
			echo '<option value="'.$row['category_name'].'">'.$row['category_name'].'</option>';
		}
	}

	function Login($username, $password){
		$db = new Database;
		$conn = $db->connect();
		$validCheck = false;

		$query = "SELECT * FROM members WHERE username = '$username' AND password = '$password'";
		$result = mysqli_query($conn, $query);

		$row = mysqli_num_rows($result);

		if ($row == 1) {  

			$db_data = mysqli_fetch_array($result);
			$id = $db_data['id'];
			$user = $db_data['username'];
			
			session_start();
			$_SESSION['id'] = $id;
			$_SESSION['username'] = $user;

			$validCheck = true;
		}

		return $validCheck;
	}
	function LoginCheck(){

		$username = $_POST['username'];
		$username = $_POST['password'];

		$db = new Database;
		$valid_Login = $db->checkLogin($username, $password);

		if(!$valid_Login) {
			echo "<span class='status-not-available'> Wrong username or password.</span>";
		}else{

			echo "<span class='status-not-available'> EYY.</span>";
		}
	}

	function checkUsername($username){
		$db = new Database;
		$conn = $db->connect();

		$query = "SELECT Count(*) from members where username ='".$username."'";
		
		$result = mysqli_query($conn, $query); 
		$row = mysqli_fetch_array($result);
		if(!$row[0]){
		//item exists
			return false;
		}else{
		//item doesnt exist
			return true;
		}
	}

	function getMemberStatus($username){
		$db = new Database;
		$conn = $db->connect();
		$query = "SELECT member_type FROM members WHERE username = '$username'";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_array($result);
		$membership = $row['member_type'];

		return $membership;
	}
	function getMemberInfo($username){
		$db = new Database;
		$conn = $db->connect();
		$query = "SELECT * FROM members WHERE username = '$username'";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_array($result);
	
		return $row;
	}

	function getTopicData($topic_id){
		$db = new Database;
		$conn = $db->connect();
		$sql = "SELECT * FROM members, forum_topics WHERE forum_topics.topic_creator = members.username AND forum_topics.topic_id = '$topic_id'";

		if(!$result = mysqli_query($conn, $sql)){
			echo 'q failed<br>';
			echo $sql;

			return 'Bad q';
		} else{	

			$row = mysqli_fetch_assoc($result);

			return $row;
		}		
	}

	function getPostCount($username){
		$db = new Database;
		$conn = $db->connect();
		$query = "SELECT * FROM forum_posts WHERE post_creator = '$username' GROUP BY post_id";

		if(!$result = mysqli_query($conn, $query)){
			echo 'q failed posts count';
		}
		$row = mysqli_num_rows($result);

		return $row;
	}

	function getPosts($topic_id){
		$db = new Database;
		$conn = $db->connect();
		$query = "SELECT * FROM forum_posts WHERE post_topic_id = '$topic_id'";

		if(!$result = mysqli_query($conn, $query)){
			echo 'q failed posts<br><br>';
			echo $query;
		}
		return $result;
	}

	function Search($search){
		$db = new Database;
		$conn = $db->connect();

		$sql_topics = 'SELECT * FROM forum_topics WHERE topic_title LIKE "%'.$search.'%" ';

		if(!$result_topics = mysqli_query($conn, $sql_topics)){
			echo 'Q failed';
		}
		
		if ($row_topics = mysqli_num_rows($result_topics) == 0) {
			echo 'No topics matched';
		}
		else{		
			echo '<b>Topics found: '. mysqli_num_rows($result_topics).'</b><br>';
		}
			echo '<br>';
		while ($row_topics = mysqli_fetch_assoc($result_topics)) {

			$topic_title_search = $row_topics['topic_title'];	
			$topic_id_search = $row_topics['topic_id'];

			echo '
			<ul style="list-style-type: none;">
				<li>
					<a href="view_topic.php?id='.$topic_id_search.'">'.$topic_title_search.'</a>
				</li>
			</ul>
			'; 
		}
	}

	function insertIntoPosts($username, $post_content, $topic_id){
		$db = new Database;
		$conn = $db->connect();

		$query = "INSERT INTO forum_posts (post_creator, post_content, post_topic_id) VALUES ('$username', '$post_content', '$topic_id')";

		$result = mysqli_query($conn, $query);

		if($result){
			return true;
		} else {
			return false;
		}
	}
	function addTopic($topic_title, $topic_category, $topic_creator, $topic_content){
		$db = new Database;
		$conn = $db->connect();

		$query = "INSERT INTO forum_topics (topic_title, topic_category, topic_creator, topic_content) 
    	VALUES ('$topic_title', '$topic_category', '$topic_creator', '$topic_content')";

		$result = mysqli_query($conn, $query);

		if($result){
			return true;
		} else {
			return false;
		}
	}
}

?>