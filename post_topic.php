<?php
error_reporting(0);
session_start();

if(!isset($_SESSION['username'])){
    header('Location: log_in.php');
    exit();     
}
include ('overall/top.php');
include 'db/DatabaseClass.php';
$db = new Database;
?>

<script type="text/javascript">
    document.title = "New topic";
</script>

<div class="middle_header">
    <h4 class="middle_header_h4">Create new topic</h4>
</div>
<div class="row">
<div class="col-sm-2"></div>
    <div class="col-sm-8 center-block">
        <form action="db/post_topic.php" method="post">
    
    <ul class="post_topic">
        <li>Category ->
            <select name="topic_category[]">
                <?php $db->getCategories(); ?>
            </select>
        </li>
        <br>
        <li>
            <input type="text" name="topic_title" class="post_subject" placeholder="Title">
        </li>
        <li>
            <h4 style="color: black;">Content</h4>
        </li>
        <textarea class="post_textarea" name="topic_content"></textarea>
        <li>
            <input type="submit" name="submit" class="submit_button" style="float: right;">
        </li>
    </ul>   
</form>
    </div>
    <div class="col-sm-2"></div>
</div>


<?php include ('overall/bottom.php') ?>