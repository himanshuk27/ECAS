<?php
include('php/intialize.php');

$query = $con->prepare("SELECT * FROM `studlist`");
$query->execute();
$row = $query->fetch();
for($i=0; $row = $query->fetch(); $i++){ 
	$pass = "ecas_".$row['RollNo'];
	//echo $row['RollNo'];
	echo $pass;
	echo "<br />";
}
?>