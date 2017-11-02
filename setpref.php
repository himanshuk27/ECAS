<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');  //On or Off
include('php/intialize.php');
try {
   
         $query = "INSERT studpref SET RollNo = :RollNo,          
            Major = :Major";
            $stmt = $con->prepare($query);  
            $stmt->bindParam(':Major', $_GET['type'], PDO::PARAM_STR); 
            $stmt->bindParam(':RollNo', $_GET['roll'], PDO::PARAM_STR);
            $stmt->execute();

         header("Location: index.php");          
           
 
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }


 
    ?>