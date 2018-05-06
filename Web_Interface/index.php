<?php include_once('config.php'); ?>


<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0" />

    <title><?php echo $tab_title; ?></title>

    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 90%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        .column {
            float: left;
            width: 25%;
        }

        .statsRow {

            width: 60%;
            margin: 0 auto;
        }

        .statsRow:after {
            content: "";
            display: table;
            clear: both;
        }

        .tableColumn {
            float: left;
            width: 33.33%;
            margin: 0 auto;
            display: inline-block;

        }

        .tableRow {

            width: 80%;
            margin: 0 auto;
        }

        .tableRow:after {
            content: "";
            display: table;
            clear: both;
        }
        @media (max-width: 1200px) {
            .tableColumn {
                clear: both !important;
            }
            .column {
                clear: both !important;
                text-align: center;
            }
        }
    </style>
    </head>
<body>

<?php

$sessionBegin = date ( 'Y-m-d 00:00:00');
$sessionEnd = date ( 'Y-m-d 23:59:59');
$in_to_mile = 0.000015783;

//Get total revolutions
    $runner = "SELECT SUM(Revolutions) FROM runner";
    if ($result = mysqli_query($db, $runner))
    {
        while ($row = mysqli_fetch_assoc($result))
        {
            $totalRevolutions = $row['SUM(Revolutions)'];
        }
        mysqli_free_result($result);
    }

//Get Today's Revolutions
    $runner = "SELECT SUM(Revolutions) FROM runner WHERE Time BETWEEN '" . $sessionBegin ."' AND '" . $sessionEnd ."'";
    if ($result = mysqli_query($db, $runner))
    {
        while ($row = mysqli_fetch_assoc($result))
        {
            $todaysRevolutions = $row['SUM(Revolutions)'];
        }
        mysqli_free_result($result);
    }


//Get Today's Inches $runner = "SELECT SUM(Revolutions) FROM runner WHERE Time BETWEEN '" . $sessionBegin ."' AND '" . $sessionEnd ."'";
    if ($result = mysqli_query($db, $runner))
    {
        while ($row = mysqli_fetch_assoc($result))
        {
            $todaysInches = $row['SUM(Revolutions)'] * $wheel_circumference;
        }
        mysqli_free_result($result);
    }


//Get Today's Miles
$runner = "SELECT SUM(Revolutions) FROM runner WHERE Time BETWEEN '" . $sessionBegin ."' AND '" . $sessionEnd ."'";
    if ($result = mysqli_query($db, $runner))
    {
        while ($row = mysqli_fetch_assoc($result))
        {
            $todaysMiles = $row['SUM(Revolutions)'] * $wheel_circumference * $in_to_mile;
        }
        mysqli_free_result($result);
    }

//All the tables are below
function running_history_by_hour($wheel_circumference, $in_to_mile)
{
    $db = mysqli_connect('localhost', 'denchief_hedgie', 'e79f2d56-2004-11e8-b467-0ed5f89f718b', 'denchief_hedgehog') or die('Error connecting to MySQL server.');
    $runner = "SELECT * FROM (SELECT Time, SUM(`Revolutions`) as Revolutions FROM runner GROUP BY date_format( `Time`, '%Y-%m-%d-%H')) var ORDER BY Time DESC LIMIT 24";
    if ($result = mysqli_query($db, $runner))
    {
        echo "<center><br><br><table>";
        echo "<tr><th>Time</th><th>Wheel</th><th>Inches</th><th>Miles</th></tr>";
        while ($row = mysqli_fetch_assoc($result))
        {
            echo "<tr>";
            echo "<td>";
            //print_r($row['Time']);
            echo date('h:00 A', strtotime($row['Time']));


            echo "<td>" ;
            print_r($row['Revolutions']);
            echo "</td>";


            echo "<td>" . $row['Revolutions'] * $wheel_circumference . "</td>";
            echo "<td>" . $row['Revolutions'] * $wheel_circumference * $in_to_mile . "</td>";
            echo "</tr>";
        }
        echo "</table></center>";
        mysqli_free_result($result);
    }
}

function running_history_by_day($wheel_circumference, $in_to_mile)
{
    $db = mysqli_connect('localhost', 'denchief_hedgie', 'e79f2d56-2004-11e8-b467-0ed5f89f718b', 'denchief_hedgehog') or die('Error connecting to MySQL server.');
    //$runner = "select date_format(Time, '%b %d') as Time, Revolutions from runner group by Time";
    $runner = "SELECT * FROM (SELECT Time, SUM(`Revolutions`) as Revolutions FROM runner GROUP BY date_format( `Time`, '%Y-%m-%d')) var ORDER BY Time DESC LIMIT 30 ";
    if ($result = mysqli_query($db, $runner))
    {
        echo "<center><br><br><table>";
        echo "<tr><th>Time</th><th>Wheel</th><th>Inches</th><th>Miles</th></tr>";
        while ($row = mysqli_fetch_assoc($result))
        {
            echo "<tr>";
            echo "<td>";
            echo date('m/d/y', strtotime($row['Time']));
            //print_r($row['Time']);

            echo "<td>" ;
            print_r($row['Revolutions']);
            echo "</td>";


            echo "<td>" . $row['Revolutions'] * $wheel_circumference . "</td>";
            echo "<td>" . $row['Revolutions'] * $wheel_circumference * $in_to_mile . "</td>";
            echo "</tr>";
        }
        echo "</table></center>";
        mysqli_free_result($result);
    }
}

function running_history_by_month($wheel_circumference, $in_to_mile)
{
    $db = mysqli_connect('localhost', 'denchief_hedgie', 'e79f2d56-2004-11e8-b467-0ed5f89f718b', 'denchief_hedgehog') or die('Error connecting to MySQL server.');
    //$runner = "select date_format(Time, '%b %d') as Time, Revolutions from runner group by Time";
    $runner = "SELECT * FROM (SELECT Time, SUM(`Revolutions`) as Revolutions FROM runner GROUP BY date_format( `Time`, '%Y-%m')) var ORDER BY Time DESC";
    if ($result = mysqli_query($db, $runner))
    {
        echo "<center><br><br><table>";
        echo "<tr><th>Time</th><th>Wheel</th><th>Inches</th><th>Miles</th></tr>";
        while ($row = mysqli_fetch_assoc($result))
        {
            echo "<tr>";
            echo "<td>";
            echo date('M Y', strtotime($row['Time']));
            //print_r($row['Time']);

            echo "<td>" ;
            print_r($row['Revolutions']);
            echo "</td>";


            echo "<td>" . $row['Revolutions'] * $wheel_circumference . "</td>";
            echo "<td>" . $row['Revolutions'] * $wheel_circumference * $in_to_mile . "</td>";
            echo "</tr>";
        }
        echo "</table></center>";
        mysqli_free_result($result);
    }
}

?>

<center>
    <h1><?php echo $page_title; ?></h1>
    <br>
    <div class="statsRow">
        <div class="column"><p><h2><?php echo $totalRevolutions; ?></h2></p> <p>Total Revolutions</p></div>
        <div class="column"><p><h2><?php echo $todaysRevolutions; ?></h2></p> <p>Revolutions today</p></div>
        <div class="column"><p><h2><?php echo $todaysInches; ?></h2></p> <p>Inches Today</p></div>
        <div class="column"><p><h2><?php echo $todaysMiles; ?></h2></p> <p>Miles Today</p></div>
    </div>
    <br>
    <br>
    <br>
    <div class="tableRow">
        <div class="tableColumn"><p>Monthly Stats</p><?php running_history_by_month($wheel_circumference, $in_to_mile) ?></div>
        <div class="tableColumn"><p>Daily Stats (Last 30)</p><?php running_history_by_day($wheel_circumference, $in_to_mile) ?></div>
        <div class="tableColumn"><p>Hourly Stats (Last 24)</p><?php running_history_by_hour($wheel_circumference, $in_to_mile) ?> </div>
    </div>
</center>

</body></html>

