<?php
session_start();
if (! isset($_SESSION['userId'])) {
    header('Location: index.html');
    die();
}
if (!isset($_GET['id'])){
    header('Location: levels.php');
    die();
}
$id=$_GET['id'];
$username=$_SESSION['username'];

require("includes/config.php");

$levels = mysql_query("SELECT * FROM level WHERE '$id'=id");
$level = mysql_fetch_array($levels);
$query = mysql_query("SELECT * 
                    FROM highscore JOIN (user) ON (user.id=highscore.userId)
                    WHERE '$id'=levelId AND '$username'=username");

$scores=mysql_fetch_array($query);
$highscore=$scores['timeScore']+$scores['stateScore']+$scores['transitionScore'];

$level = json_decode($level['level']);
?>
<!DOCTYPE html> 
<HTML> 
<HEAD>
   <TITLE>Mealy Another Adventure - Game</TITLE> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
        <script type="text/javascript" src="js/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.10.4.custom.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/jquery-ui-1.10.4.custom.min.css" />
        <script type="text/javascript" src="js/data.js"></script>
        <script src="js/jquery.jsPlumb-1.4.1-all-min.js"></script>
        <script type="text/javascript" src="js/crafty.js"></script>
        <script type="text/javascript" src="js/game.js"></script>
        <script type="text/javascript" src="js/components.js"></script>
  <script>
    var par = <?php echo json_encode($level->par); ?>;
    var lid = <?php echo $id; ?>;
    Game.level.t = <?php echo json_encode($level->t); ?>;
    window.addEventListener('load', Game.start);
  </script>
</HEAD>
<BODY>
    <div id="game">
      <div id="titles">
        <a href="/levels.php" ><img id="levellist" src="img/Back.png" /></a>
        <span id="title"><?php echo $level->title ?></span>
        <a href="/tutorial.html"><img id="tutorial" src="img/Tutorial.png" /></a>
      </div>
      <div id="cr-stage"></div>
      <span id="alphabet"><?php echo $level->inputstring; ?></span>
      <div id="playbar">
        <span id="leftbuttons">
          <img id="play" src="img/Play.png" />
          <img id="pause" src="img/Pause.png" />
          <img id="stop" src="img/Stop.png" />
        </span>
        <span id="score"><?php echo $highscore ?></span>
        <span id="rightbuttons">
          <img id="new" src="img/New.png"/>
          <img id="delete" src="img/Delete.png"/>
          <img id="sound" src="img/SoundOn.png"/>
        </span>
      </div>
    </div>
    <div id="automatons">
      <div id="area"></div>
      </div>
    </div>
    <div id="actionmenu">
      <img id="chalt" class="crc" src="img/Circle.png" />
      <img id="cleft" class="crc" src="img/Circle.png" />
      <img id="cright" class="crc" src="img/Circle.png" />
      <img id="cjump" class="crc" src="img/Circle.png" />
      <img id="cjumpleft" class="crc" src="img/Circle.png" />
      <img id="cjumpright" class="crc" src="img/Circle.png" />

      <img id="halt" src="img/icons/stopIcon.png" />
      <img id="left" src="img/icons/leftIcon.png" />
      <img id="right" src="img/icons/rightIcon.png" />
      <img id="jump" src="img/icons/jumpIcon.png" />
      <img id="jumpleft" src="img/icons/jumpLeftIcon.png" />
      <img id="jumpright" src="img/icons/jumpRightIcon.png" />
    </div>
</BODY>
</HTML>
