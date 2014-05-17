<?php

session_start();

if (! isset($_SESSION['userId'])) {
    header('Location: index.html');
    die();
}

require("includes/config.php");

$levels = mysql_query("SELECT * FROM level");

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Level Selection</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="/css/style.css"/>
    </head>
    <body>
        <div class="headertitle">
            Level Selection
        </div>
        <div class="headerlist">
            <ul>
                <a href="tutorial.html"><li>Tutorial</li></a>
                <a href="logout.php"><li>Log Out</li></a>
            </ul>
        </div>
        <div class="lista">
                <ul>
                <?php
                while ($lev=mysql_fetch_array($levels)){
                    $leveldata = json_decode($lev['level']);
                    echo "<li><a href='level.php?id=$lev[id]'>Level $leveldata->title</a></li>";
                        
                } 
                ?>
        </ul>
            </div>
    </body>
</html>