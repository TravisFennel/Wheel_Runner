<?php

//(Host,Username,Password,Database_Name)
    $db = mysqli_connect('localhost', 'username', 'password', 'hedgehogRunner') or die('Error connecting to MySQL server.');
//Wheel Circumference is in US Inches
    $wheel_circumference = 40;

$page_title = 'Chip\'s Running Tracker';
$tab_title = 'Chip Chip The Spiny Ploof';
date_default_timezone_set('America/Chicago');
?>