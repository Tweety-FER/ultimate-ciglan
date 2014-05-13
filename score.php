<?php

session_start();

include("includes/config.php");

if(! isset($_SESSION['userId'])) die();
$uid = $_SESSION['userId'];

$timescore = isset($_GET['step']) ? (int) $_GET['step'] : 0;
$statescore = isset($_GET['state']) ? (int) $_GET['state'] : 0;
$transitionscore = isset($_GET['transition']) ? (int) $_GET['transition'] : 0;
$lid = $_GET['lid'];

if($timescore + $statescore + $transitionscore <= 0) {
	echo "Nope";
	die();
}
$uid = mysql_real_escape_string($uid);
$timescore = mysql_real_escape_string($timescore);
$statescore = mysql_real_escape_string($statescore);
$transitionscore = mysql_real_escape_string($transitionscore);

$result = mysql_query("INSERT INTO `Highscore`(`userId`, `levelId`, `timeScore`, `stateScore`, `transitionScore`) VALUES ('$uid', '$lid', $timescore, $statescore, $transitionscore)");
//if(! $result) echo mysql_error();