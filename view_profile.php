<?php
error_reporting(0);
session_start();

if(!isset($_SESSION['username'])){
    header('Location: log_in.php');
    exit();
}
include 'overall/top.php';
include 'db/DatabaseClass.php';
$db = new Database;
$username = $_GET['member'];

$profileData = $db->getMemberInfo($username);

$username = $profileData['username'];
$email = $profileData['email'];
$first = $profileData['first'];
$last = $profileData['last'];
$reg_time = $profileData['reg_time'];
$membership = $profileData['member_type'];
$avatar = $profileData['avatar_url'];

?>

<style type="text/css">
    .profile_table{
        display: none;
    }
</style>

<script type="text/javascript">
    $(function(){
        $(".profile_table").fadeIn(1000);
    });
    document.title = "View Profile";

</script>

<div class="middle_header">
    <h4 class="middle_header_h4">Viewing profile</h4>
</div>

<div class="row">
    <div class="col-sm-8">
        <table class="profile_table">
            <tr>
                <td>
                    <label for="username">Username</label>
                </td>
                <td>
                 <?php echo $username; ?>
             </td>  
         </tr>
         <tr>
            <td>
                <label for="email">E-mail</label>
            </td>
            <td>
                <?php echo $email; ?>
            </td>
        </tr>
        <tr>
            <td>
                <label for="name">Name</label>
            </td>
            <td>
                <?php echo $first; ?>
            </td>
        </tr>
        <tr>
            <td>
                <label for="lastname">Lastname</label>
            </td>
            <td>
                <?php echo $last; ?>
            </td>

        </tr>
        <tr>
            <td>
                <label for="registration_time">Member since</label>
            </td>
            <td>
                <?php echo $reg_time; ?>
            </td>
        </tr>
        <tr>
            <td>
                <label for="member_type">Membership type</label>
            </td>
            <td>
                <i><?php echo $membership; ?></i>
            </td>
        </tr>
    </table>
</div>
<div class="col-sm-4">
    <?php echo '<img class="avatar_profile" src="'.$avatar.'"></img>'?>
</div>
</div>

<?php include 'overall/bottom.php'; ?>