<?php 
	$id="";
	$id = $_GET['id'];
	$query = $con->prepare("SELECT SubCode,SubName from electives where Area = '".$id."'");
	$query->execute();
	$row = $query->fetch();
	if ($row > 0) {
		for ($i=0; $row = $result->fetch(); $i++) { 
			echo $row['SubCode'] + $row['SubName'];
		}
	}
?>