<?php 
session_start();
include 'DatabaseClass.php';
$db = new Database;

if(!isset($_SESSION['id'])){
    header('Location: ../index.php');
} 
else {
    if(isset($_POST['topic_title']) && isset($_POST['topic_category'])){
        
        foreach ($_POST['topic_category'] as $selectedOption)
            $topic_category = $selectedOption;
            $topic_title = $_POST['topic_title'];
            $topic_content = $_POST['topic_content'];
            $topic_creator = $_SESSION['username'];
        
        $result = $db->addTopic($topic_title, $topic_category, $topic_creator, $topic_content);
        if($result == true){    
            header('Location: ../index.php');
        }
        else{
            header('Location: ../post_topic.php');
        }
    }
}
?>