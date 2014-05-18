<?php

session_start();

include("includes/config.php");

if(! isset($_SESSION['userId'])) die();
$uid = $_SESSION['userId'];

$timescore = isset($_POST['step']) ? (int) $_POST['step'] : 0;
$statescore = isset($_POST['state']) ? (int) $_POST['state'] : 0;
$transitionscore = isset($_POST['transition']) ? (int) $_POST['transition'] : 0;
$lid = $_POST['lid'];

if($timescore + $statescore + $transitionscore <= 0) {
	echo "Nope";
	die();
}
$uid = mysql_real_escape_string($uid);
$timescore = mysql_real_escape_string($timescore);
$statescore = mysql_real_escape_string($statescore);
$transitionscore = mysql_real_escape_string($transitionscore);

$result = mysql_query("INSERT INTO `Highscore`(`userId`, `levelId`, `timeScore`, `stateScore`, `transitionScore`) VALUES ('$uid', '$lid', $timescore, $statescore, $transitionscore)");