<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */

// EN DATABASCLASS FÖR ATT ANAMMA OOP. Här finns all databasinteraktion för att minimera koden och få ett enklare flow i sjävla programmerandet. Här finns generella funktioner för att stoppa in data i databas, men även för att hämta data. 
class Database {
    private $connection;

    public function __construct() {
        //LOCAL
		$conn = mysqli_connect("localhost", "root", "root", "forumDb");
		// ONLINE
		//$connection = mysqli_connect("10.209.1.98", "219653_ed70525", "Jersep1&", "219653-test");
		if(!$conn){
            echo "Fuuudge, the connection couln't be established.";
		} else {
            return $this->connection = $conn;
		}
    }

	function selectAllFrom ($table){
		$query = "SELECT * FROM " . $table;
		$result = mysqli_query($this->connection, $query);
		return $result;
    }
    
	function searchTopics ($searchTerm){
		$query = 'SELECT * FROM forum_topics WHERE topic_title LIKE "%'.$searchTerm.'%" ';
		$result = mysqli_query($this->connection, $query);
		return $result;
    }
    
	function select ($table){
		$query = "SELECT * FROM " . $table;
		$result = mysqli_query($this->connection, $query);
		return $result;
    }
    
	function selectOneFrom ($table, $tableCol, $checkParameter){
        $query = "SELECT * FROM $table WHERE $tableCol = '$checkParameter'";
        $result = mysqli_query($this->connection, $query);
		if(!$result){
			echo 'ERROR: Bad result';
		} else{
			return $result;
		}		
    }
    
	function insertIntoUsers ($username, $password, $email, $firstname, $lastname){
		$query = "INSERT INTO members (username, password, email, first, last) VALUES('$username', '$password', '$email', '$firstname', '$lastname')";
		if(!$result = mysqli_query($this->connection, $query)){
			return false;
		} else {
			return true;
		}
    }
    
	function updateUsers ($username, $password, $email, $firstname, $lastname){
		$query = "UPDATE members SET password='$password', email='$email', first='$firstname', last='$lastname' WHERE username = '$username'";
		if(!$result = mysqli_query($this->connection, $query)){
			return false;
		} else {
			return true;
		}
    }
    
	function updateAvatar ($username, $avatar_url){
		$query = "UPDATE members SET avatar_url='$avatar_url' WHERE username = '$username'";
		if(!$result = mysqli_query($this->connection, $query)){
			return false;
		} else {
			return true;
		}
    }	
    
	function deleteFrom ($table, $tableCol, $checkParameter){
		$query = "DELETE FROM $table WHERE $tableCol = '$checkParameter'";
		$result = mysqli_query($this->connection, $query);
		if(!$result){
			return false;
		} else {
			return true;
		}   
    }
    
	function getAvatar($username){
		$sql = "SELECT avatar_url from members WHERE username = '$username'";
		$result = mysqli_query($this->connection, $sql);
		$row = mysqli_fetch_assoc($result);
		$avatar = $row['avatar_url'];
		return $avatar;
    }
    
	function getCategories(){
		$sql = "SELECT category_name FROM categories";
		$result = mysqli_query($this->connection, $sql);
		while($row = mysqli_fetch_assoc($result)){
			echo '<option value="'.$row['category_name'].'">'.$row['category_name'].'</option>';
		}
    }
    
	function Login($username, $password){
		$validCheck = false;
		$query = "SELECT * FROM members WHERE username = '$username' AND password = '$password'";
		$result = mysqli_query($this->connection, $query);
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
		$query = "SELECT Count(*) from members where username ='".$username."'";	
		$result = mysqli_query($this->connection, $query); 
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
		$query = "SELECT member_type FROM members WHERE username = '$username'";
		$result = mysqli_query($this->connection, $query);
		$row = mysqli_fetch_array($result);
		$membership = $row['member_type'];
		return $membership;
    }
    
	function getMemberInfo($username){
		$query = "SELECT * FROM members WHERE username = '$username'";
		$result = mysqli_query($this->connection, $query);
		$row = mysqli_fetch_array($result);
		return $row;
    }
    
	function getTopicData($topic_id){
		$sql = "SELECT * FROM members, forum_topics WHERE forum_topics.topic_creator = members.username AND forum_topics.topic_id = '$topic_id'";
		if(!$result = mysqli_query($this->connection, $sql)){
			echo 'q failed<br>';
			echo $sql;
			return 'Bad q';
		} else{	
			$row = mysqli_fetch_assoc($result);
			return $row;
		}		
    }
    
	function getPostCount($username){
		$query = "SELECT * FROM forum_posts WHERE post_creator = '$username' GROUP BY post_id";
		if(!$result = mysqli_query($this->connection, $query)){
			echo 'q failed posts count';
		}
		$row = mysqli_num_rows($result);
		return $row;
    }
    
	function getPosts($topic_id){
		$query = "SELECT * FROM forum_posts WHERE post_topic_id = '$topic_id'";
		if(!$result = mysqli_query($this->connection, $query)){
			echo 'q failed posts<br><br>';
			echo $query;
		}
		return $result;
    }
    
	function Search($search){	
		$sql_topics = 'SELECT * FROM forum_topics WHERE topic_title LIKE "%'.$search.'%" ';
		if(!$result_topics = mysqli_query($this->connection, $sql_topics)){
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
		$query = "INSERT INTO forum_posts (post_creator, post_content, post_topic_id) VALUES ('$username', '$post_content', '$topic_id')";
		$result = mysqli_query($this->connection, $query);
		if($result){
			return true;
		} else {
			return false;
		}
    }
    
	function addTopic($topic_title, $topic_category, $topic_creator, $topic_content){
		$query = "INSERT INTO forum_topics (topic_title, topic_category, topic_creator, topic_content) 
    	VALUES ('$topic_title', '$topic_category', '$topic_creator', '$topic_content')";
		$result = mysqli_query($this->$connection, $query);
		if($result){
			return true;
		} else {
			return false;
		}
	}
}
?>