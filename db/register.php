<?php
include 'DatabaseClass.php';

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];

$db = new Database;
if($db->insertIntoUsers($username, $password, $email, $firstname, $lastname)){

    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['username'] = $username;
    echo 'success';
} else {
    echo 'fail';
}
?>