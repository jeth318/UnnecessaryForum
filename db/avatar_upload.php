<?php
session_start();
include 'db_connect.php';
include '../functions/console.php';
include 'DatabaseClass.php';
$console = new Console;

error_reporting(E_ALL);
ini_set('display_errors', 1);
/*ONLINE */
//$target_dir = "../img/avatars/";

/*OFFLINE*/
$target_dir = "../img/avatars/";
$rand = rand(1000*10000, 1000*20000);
$target_file = $target_dir . $rand . basename($_FILES["fileToUpload"]["name"]);

/* MIN KOD FÖR ATT TA UT EN URL FÖR AVATAREN */
//$target_directory = "../img/avatars/";
/*OFFLINE*/
$target_directory = "img/avatars/";
$avatar_dir = $target_directory . $rand . basename($_FILES["fileToUpload"]["name"]); 

/*SLUT PÅ MIN KOD */


$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
      // echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
     echo "File is not an image.";
     $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
   
  echo "File already exists.";
  $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 10000000) {
 echo "Sorry, your file is too large.";
 $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// If everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

    
        //header('Location: ../profile.php');
        //echo 'File uploaded';

        /* MIN KOD nedan - UPDATE USER AVATAR URL IN DATABASE 
        
        Alla användare har img/avatars/default.png som standardbild. Detta ändrar standardbilden mot den nyligen uppladdade bilden. */

        $username = $_SESSION['username'];  
        $id = $_SESSION['id'];
        $sql = "UPDATE members SET avatar_url='$avatar_dir' WHERE id='$id'";
        $db = new Database;

        $result = $db->updateAvatar($username, $avatar_dir);
        if(!$result = mysqli_query($conn, $sql)){
            echo 'Update failed';
            //echo $avatar_dir;
        }
        else
            header('Location: ../profile.php');
        
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

?>