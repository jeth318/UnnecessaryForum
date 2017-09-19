<?php
include ('overall/top.php');
include ('db/DatabaseClass.php');
include ('functions/console.php');
$console = new console;

if(!isset($_GET['id'])){

    header('Location: index.php'); 
    } else {
        
        $topic_id = $_GET['id'];
        // Bara för att kunna grabba tag i topic_id från JS-filen. Kom inte på något vettigare sätt, men detta funkar. 
        echo '<input type="hidden" id="topic_id_holder" value="'.$topic_id.'"/>';
}

// Hämtar topic-data från databasen som matchar topic_id
$db = new Database;
$topic = $db->getTopicData($topic_id);

$topic_id = $topic['topic_id'];
$topic_title = $topic['topic_title'];
$topic_content = $topic['topic_content'];
$topic_creator = $topic['topic_creator'];
$topic_membertype = $topic['member_type'];
$topic_time = $topic['topic_time'];

// TS = Thread starter
// Hämtar antalet inlägg som TS skrivit
$post_count = $db->getPostCount($topic_creator);

// Hämtar användartypen för TS
$membertype = $db->getMemberStatus($topic_creator);

 // Hämtar in avatar för TS.
$avatar = $db->getAvatar($topic_creator);

$console->log($avatar);

?>
<div class="middle_header">
    <h4 class="middle_header_h4"></h4>
</div>
<div class="row" style="padding: 15px;">
    <div class="col-sm-2">
        <b>Topic starter</b>
        <br>
        <?php 
        echo
        '<a href="view_profile.php?member='.$topic_creator.'">'.$topic_creator.'</a>';
        ?>
        <br>

        <?php
        echo 
        '<img class="avatar" src="'.$avatar.'">
        <br>
        '.$topic_membertype.'

        <br><p style="color: grey; font-size: 11px;"><i>
        '.$post_count.' posts</i></p>
        '
        ?>
    </div>
    <div class="col-sm-8">
        <h3><?php echo $topic_title ?></h3>
        <p><i>Posted <?php echo $topic_time; ?></i></p>
    </div>
    <div class="col-sm-2">
    </div>
</div>
<div class="row" style="margin: 0; padding: 5px;">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8" style="border-radius: 2px; padding: 15px; background-color: rgba(0,0,0,0.3);">
        <?php echo $topic_content; ?>    
    </div>
    <div class="col-sm-2" style="";>
    </div>
</div>
<div class="row" style="padding: 0; margin: 0; margin-top: 5px;">
    <div class="col-xs-12" style="border-bottom: 1px solid rgba(0,0,0,0.2); margin-top: 25px;">
    </div>
</div>

<!-- PRINT POSTS / REPLIES -->
<?php 

/* PULLING ALL POSTS FROM DATABASE, RELATED TO THE TOPIC-ID */
$posts = $db->getPosts($topic_id);

while($row_posts = mysqli_fetch_assoc($posts)){

    $post_creator = $row_posts['post_creator'];
    $post_time = $row_posts['post_time'];
    $post_content = $row_posts['post_content'];

    $memberInfo = $db->getMemberInfo($post_creator);
    $membership = $memberInfo['member_type'];
    $member_regtime = $memberInfo['reg_time'];
    $member_post_count = $db->getPostCount($post_creator);

    $avatar = $db->getAvatar($post_creator);
        
    echo '  

    <div class="row" style="margin: 4px;">
        <div class="col-sm-2">
            <br>
            <a href="view_profile.php?member='.$post_creator.'">'.$post_creator.'</a>
            <br>           
            <img class="avatar" src="'.$avatar.'">
            <br>
            '.$membership.'
            <br><p style="color: grey; font-size: 11px;"><i>
            '.$member_post_count.' posts</i></p>

        </div>
            
        <div class="col-sm-8">

            <div class="row">
                <div class="col-xs-12">
                <p style="color: grey; font-size: 9pt;"><i>Posted on
            '.$post_time.'
            </i></p> 
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12" style="border-radius: 2px; padding: 10px; background-color: rgba(0,0,0,0.1);">
                '.$post_content.'   
                </div>
            </div>
            
        </div>
        <div class="col-sm-2 post_time_reply_right" style="vertical-align: bottom";>
            
        </div>
    </div>
    <div class="row" style="padding: 0; margin: 0;">
        <div class="col-xs-12" style="border-bottom: 1px solid rgba(0,0,0,0.1); margin-top: 5px;">       
        </div>
        <div class="col-sm-2">

        </div>     
    </div>
        
    <div class="row">  
        <div class="col-sm-2">
        </div>   
    </div>';
    }

/* CHECK IF USER IS LOGGED IN. IF NOT, USER WONT BE ABLE TO SEE REPLY-AREA */
if(!isset($_SESSION['username'])){

    echo '
        <div class"row">
            <div class="col-xs-12" style="text-align: center; padding: 20px;">
                <a href="log_in.php">Log in to reply</a>
            </div>
        </div>';
        exit();
}
?> 

<!-- START REPLY-AERA -->
<div class="row" style="background-color: rgba(0,0,0,0.1); padding: 15px; margin: 0; ">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8" id="textarea_col">
        <b>Your reply</b>
        <form action="db/send_reply.php" method="post">
            <textarea class="reply_textarea" name="reply_content"></textarea>
            <input class="sendReply_small" type="submit" name="submit"></input>
            <input type="hidden" name="var" value="<?php echo $topic_id; ?>"/>
        </form> 
    </div>
    <div class="col-sm-2">
    </div>
</div>

<?php include ('overall/bottom.php') ?>