<?php 
session_start();
if (isset($_SESSION['userId'])) {
    header('Location: levels.php');
    die();
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Mealy Another Adventure - Index</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
        <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="js/basic.js"></script>
	</head>
	<body>
			<div class="headertitle">MEALY ANOTHER ADVENTURE</div>
		<div id="login">
			<form id="form" method="POST" action="">
				<div id="error"></div>
				<label for="username">Username:</label>
				<input type="text" name="username" id="username" />
				<br/><br/>
				<label for="password">Password:</label> 
				<input type="password" name="password" id="password" />
				<br/>
				<button id="loginbtn" class="button buttonlogin">
					LOGIN
				</button>
				<button id="registerbtn" class="button buttonregister">
					REGISTER
				</button>
			</form>
		</div>
	</body>
</html>