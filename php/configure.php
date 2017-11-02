<?php
include 'connect.php';
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');  //On or Off

date_default_timezone_set('Asia/Kolkata');
$Date = date('Y-m-d');
$Date2 = date('d M Y');
$Date3 = date('d-m-Y');



$rec_events = $con->prepare("SELECT * FROM event 
                            WHERE datediff(now(), Date) > 0 
                            AND Visibility = 1              
                            ORDER BY id DESC LIMIT 4" );   //for displaying recent events in footer(it only display events which passed)
		         $rec_events->execute();    







?>