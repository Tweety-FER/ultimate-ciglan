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
        <title>List of Levels</title>
        <link rel="stylesheet" type="text/css" href="/css/style.css"/>
    </head>
    <body>
        
        <div class="lista">
                <h1>Lista levela</h1>
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