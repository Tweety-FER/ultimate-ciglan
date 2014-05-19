<?php

session_start();

if (! isset($_SESSION['userId'])) {
    header('Location: index.php');
    die();
}

require("includes/config.php");

$levels = mysql_query("SELECT * FROM Level");

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
            <a href="logout.php"><button class="logout">Logout</button></a>
        </div>
        <div class="headerlist">
            <ul>
                <a href="tutorial.html"><li>Tutorial</li></a>
                <?php
                while ($lev=mysql_fetch_array($levels)){
                    $leveldata = json_decode($lev['level']);
                    echo "<a href='level.php?id=$lev[id]'><li>Level $leveldata->title</li></a>";
                        
                } 
                ?>
            </ul>
        </div>
    </body>
</html>