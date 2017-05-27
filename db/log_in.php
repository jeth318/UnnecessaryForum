<?php   
include "DatabaseClass.php";
$db = new Database;

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $valid_Login = $db->Login($username, $password);

    if($valid_Login == true) {
      echo "success";
    }else{
      echo "fail";
    }
}else{
  echo "fail";
}
?>