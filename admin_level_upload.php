<?php
	// Ultra secret password to access upload
	$password = "123123";

	if ($_SERVER['QUERY_STRING'] != $password) {
		echo "No access.";
		die();
	}

	function printDefault() {
		$level = ['title' => 'title', 'inputstring' => 'abcabc'];
		$border = [];
		$middle = [];
		$tileset = [];

		for($i = 0; $i < 24; $i++) $border[] = 1;
		$middle[] = 1;
		for($i = 0; $i < 22; $i++) $middle[] = 0;
		$middle[] = 1;

		$tileset[] = $border;
		for($i = 0; $i < 13; $i++) $tileset[] = $middle;
		$tileset[] = $border;

		$level['t'] = $tileset;

		echo str_replace(['",', '],', '{', '}'], ["\",\n\t", "],\n\t", "{\n\t", "}\n"], json_encode($level));
	}
?>

<html>
<head>Admin Level Upload</head>
<body>
	<form method="POST">
		<label>JSON code for level</label></br>
		<textarea cols='100' rows='20' name="level">
			<?php echo printDefault(); ?>
		</textarea></br>
		<input type="submit">
	</form>
</body>
</html>

<?php
$level = $_POST['level'];
if ($level != null) {
	include('includes/config.php');
	var_dump("INSERT INTO `Level`(`level`) VALUES ('$level');");
	$sql = mysql_query("INSERT INTO `Level`(`level`) VALUES ('$level');");

	if (true === $sql) {
		echo '<script>alert("Success!");</script>';
	}
}
?>
