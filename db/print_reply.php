<?php

$posts = $db->getPosts($topic_id);

while($row_posts = mysqli_fetch_assoc($posts)){

	$post_creator = $row_posts['post_creator'];
	$post_time = $row_posts['post_time'];
	$post_content = $row_posts['post_content'];

    $memberInfo = $db->getMemberInfo($post_creator);

    $membership = $memberInfo['member_type'];
    $member_regtime = $memberInfo['reg_time'];
    $member_post_count = $db->getPostCount($post_creator);

    $avatar = $db->getAvatar($topic_creator);
		
	echo '  

    <div class="row" style="margin: 4px;">
        <div class="col-sm-2">
            <br>
            <a href="view_profile.php?member='.$post_creator.'">'.$post_creator.'</a>
            <br>           
            <img class="avatar" src="'.$avatar.'">
            <br>
            '.$membership.'
            <br><p class="small_text"><i>
            '.$member_post_count.' posts</i></p>

        </div>
            
        <div class="col-sm-8 small_text">

            <div class="row">
                <div class="col-xs-12">
                <p><i>Posted on
            '.$post_time.'
            </i></p> 
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 post_content_text">
                '.$post_content.'   
                </div>
            </div>
            
        </div>
        <div class="col-sm-2 post_time_reply_right" style="vertical-align: bottom";>
            
        </div>
    </div>
    <div class="row" style="padding: 0; margin: 0;">
        <div class="col-xs-12 line_between_posts">       
        </div>
        <div class="col-sm-2">

        </div>     
    </div>
        
    <div class="row">  
        <div class="col-sm-2">
        </div>   
    </div>';
	}
?> 