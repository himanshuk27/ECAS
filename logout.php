<?php
session_start();
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');  //On or Off
unset($_SESSION["Username"]);
unset($_SESSION["Password"]);
header("Location:login.php");
?>