<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('extension=php_mysql.dll', 1);

include_once('config.php');

//on page load add entry to table - $db specified in config file

        $runner = "INSERT INTO runner (PrimKey, Revolutions) VALUES ((SELECT MAX(PrimKey) + 1 from runner var), 1)";
        if ($result = mysqli_query($db, $runner))
        {
            echo "Successful";
            //mysqli_free_result($result);
        }

    ?>


