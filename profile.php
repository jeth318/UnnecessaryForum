<!-- VISAR DEN EGNA PROFILEN -->
<?php
session_start();

if(!isset($_SESSION['username'])){
    header('Location: log_in.php');
    exit();   
}
include 'overall/top.php';
include 'db/DatabaseClass.php';
include 'functions/console.php';

$db = new Database;
$console = new Console;

$username = $_SESSION['username'];

$profileData = $db->getMemberInfo($username);

$username = $profileData['username'];
$email = $profileData['email'];
$first = $profileData['first'];
$last = $profileData['last'];
$reg_time = $profileData['reg_time'];
$membership = $profileData['member_type'];
$avatar = $profileData['avatar_url'];

$console->log($avatar);


//$haj = $console->log($avatar);


?>

<script type="text/javascript">
   
    $(function(){

        /*$('#profile_table_div').animate({
          left: '300'
      });

        $('#avatar_div').animate({
          left: '300'
      }); */

        $("#upload_avatar_form").hide();

        $("#change_avatar_btn").click(function(){

            if($("#change_avatar_btn").html() == "Change picture"){

                $("#upload_avatar_form").toggle();
                $("#change_avatar_btn").html("Cancel");
                $("#upload_button").show();
            } else { 

                $("#upload_avatar_form").toggle();
                $("#change_avatar_btn").html("Change picture");
            }

        });

    });
</script>

<div class="middle_header">
    <h4 class="middle_header_h4">My profile</h4>
</div>

<div class="row"  style="padding: 15px;">
    <div class="col-sm-6" id="profile_table_div">
        <table class="profile_table">
            <tr>
                <td>
                    <label for="username">Username</label>
                </td>
                <td contenteditable="false" id="user_field">
                 <?php echo $username; ?>
             </td>  
         </tr>
         <tr>
            <td>
                <label for="email">E-mail</label>
            </td>
            <td contenteditable="false" class="edit_profile_class">
                <?php echo $email; ?>
            </td>
        </tr>
        <tr>
            <td contenteditable="false" class="edit_profile_class">
                <label for="name">Name</label>
            </td>
            <td contenteditable="false" class="edit_profile_class">
                <?php echo $first; ?>
            </td>
        </tr>
        <tr>
            <td contenteditable="false" class="edit_profile_class">
                <label for="lastname">Lastname</label>
            </td>
            <td contenteditable="false" class="edit_profile_class">
                <?php echo $last; ?>
            </td>            
        </tr>
        <tr>
            <td>
                <label for="registration_time">Member since</label>
            </td contenteditable="false">
            <td>
                <?php echo $reg_time; ?>
            </td>
        </tr>
    </table> 
    </div>

    <div class="col-sm-3" id="avatar_div" style="text-align: center;">
    
        <?php echo '<img class="avatar_profile" src="'.$avatar.'"></img>'?>

        <form class="change_avatar" action="db/avatar_upload.php" method="post" enctype="multipart/form-data" id="upload_avatar_form">  
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input id="upload_button" type="submit" value="Upload Image" name="submit">
        </form>
        <button id="change_avatar_btn" style="margin-top: 10px;">Change picture</button>
    </div>

   <!-- <div class="col-sm-3">
        <select id="colorTheme" onchange="setColorCookie()">
            <option value="Select color theme">Select color theme</option>
            <option value="blue">Blue</option>
            <option value="dark">Dark</option>
        </select>
    </div>
    -->
</div>
<?php include 'overall/bottom.php'; ?>