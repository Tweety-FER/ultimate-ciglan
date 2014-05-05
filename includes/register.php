<?php
session_start();

include("config.php");
if (isset($_SESSION['username'])) {
	$error = ['code' => 125, 'description' => 'User is already logged in!'];
	echo json_encode($error);
	die();
}

$username = mysql_real_escape_string($_POST['username']);
$sql = mysql_fetch_array(mysql_query("SELECT * FROM User WHERE username = '$username'"));
if ($sql['username'] != '') {
	$error = ['description' => 'User already exists.'];	
	echo json_encode($error);
	die();
}

$password = sha1(mysql_real_escape_string($_POST['password']));

$sql = mysql_query("INSERT INTO `User`(`username`, `passhash`) VALUES('$username', '$password')");
if ($sql === true) {
	$ok = ['result' => 'ok'];
} else {
	$error = ['code' => mysql_errno(), 'description' => mysql_error()];
	echo json_encode($error);
	die();	
}
?>
