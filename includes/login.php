<?php
session_start();

include("config.php");
if (isset($_SESSION['username'])) {
	$error = ['code' => 125, 'description' => 'User is already logged in!'];
	echo json_encode($error);
	die();
}

$username = mysql_real_escape_string($_POST['username']);
$password = sha1(mysql_real_escape_string($_POST['password']));

$sql = mysql_query("SELECT * FROM User WHERE username = '$username' AND passhash = '$password'");
$result = mysql_fetch_array($sql);

if ($result['username'] !== $username) {
	$error = ['description' => 'User entered wrong login info!'];
	echo json_encode($error);
	die();
} else {
	$_SESSION['username'] = $username;
	//$_SESSION['user_id'] = $result['id'];

	$ok = ['result' => 'ok'];
	echo json_encode($ok);
}

/*
/// Add validation for fields in both login and register pages
<script>
$('#form').validate(
	rules : {
		username: {
			minlength: 2,
			maxlength: 32
		},
		password: {
			minlength: 4
		}
	},

	messages : {
		username: {
			minlength: "Please enter at least 2 characters.",
			maxlength: "Maximum number of characters exceeded."
		},
		password: {
			minlength: "Please enter stronger password."
		}
	}
)
</script>
*/

?>
