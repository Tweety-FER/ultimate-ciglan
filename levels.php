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
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
    </head>
    <body>
        
        <div class="lista">
                <h1>Lista levela</h1>
                <ul>
                <?php
                $br=0;
                while ($lev=mysql_fetch_array($levels)){
                    $br++;
                    echo "<li><a href='level.php?id=$lev[id]'>Level $br</a></li>";
                        
                } 
                ?>
        </ul>
            </div>
    </body>
</html>