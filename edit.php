<?php
error_reporting(0);
session_start();
include 'overall/top.php';
include 'db/DatabaseClass.php';

$db = new Database;
$user = $_GET['user'];

$memberInfo = $db->getMemberInfo($user);

$id = $memberInfo['id'];
$username = $memberInfo['username'];
$password = $memberInfo['password'];
$email = $memberInfo['email'];
$first = $memberInfo['first'];
$last = $memberInfo['last'];
$regtime = $memberInfo['reg_time'];

if (isset($_POST['password']) || isset($_POST['email']) || isset($_POST['first']) || isset($_POST['last'])) {
	
	$new_password = $_POST['password'];
	$new_email = $_POST['email'];
	$new_firstname = $_POST['first'];
	$new_lastname = $_POST['last'];

/*KOLLAR VILKA FÄLT SOM ANVÄNDAREN LÄMNAR OFÖRÄNDRADE. DESSA ERSÄTTS MER ORIGINAL-VÄRDET FÖR ATT BIBEHÅLLA SAMMA INFORMATION SOM REDAN FANNS I DATABASEN */
	if(empty($_POST['password'])){
		$new_password = $password;
	}
	if(empty($_POST['password'])){
		$new_email = $email;
	}
	if(empty($_POST['first'])){
		$new_firstname = $first;
	}
	if(empty($_POST['last'])){
		$new_lastname = $last;
	}

	$result = $db->updateUsers($username, $new_password, $new_email, $new_firstname, $new_lastname);

	if($result == true){
		//header('Location: edit.php?user=$username');
		echo 'SUCCESSFUL UPDATE. REFRESH PAGE TO SEE NEW INFO';
		
	} else {
		echo 'Update failed';
	}
}
?>

<div class="middle_header">
	<h4 class="middle_header_h4">Edit user</h4>
</div>
<br><br>
<form action="" method="post">
	<div class="row">
		<div class="col-sm-10">

			<table class="jej">

				<tr>
					<th>ID</th>
					<td><?php echo $id ?></td>
				</tr>
				<tr>
					<th>Username</th>
					<td><?php echo $username ?></td>
				</tr>
				<tr>
					<th>Password</th>
					<td><input type="text" name="password" placeholder="<?php echo $password ?>"></input></td>
				</tr>
				<tr>
					<th>Email</th>
					<td><input type="text" name="email" placeholder="<?php echo $email ?>"></input></td>
				</tr>
				<tr>
					<th>First name</th>
					<td><input type="text" name="first" placeholder="<?php echo $first ?>"></input></td>
				</tr>
				<tr>
					<th>Last name</th>
					<td><input type="text" name="last" placeholder="<?php echo $last ?>"></input></td>
				</tr>
				<tr>
					<th>Reg time</th>
					<td><?php echo $regtime ?></td>
				</tr>

			</table>
			<input type="submit" name="submit" value="Update"></input>
		</form>
	</div>
</div>
<?php include 'overall/bottom.php'; ?>