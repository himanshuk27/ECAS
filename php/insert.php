<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');  //On or Off
include('connect.php');
try {

    $sql = null;

    if($_POST['type']=="Single"){
         $query = "INSERT `".$_POST['PrefArea']."` SET RollNo = :RollNo,          
            SubCode = :SubCode";
            $stmt = $con->prepare($query);  
            $stmt->bindParam(':SubCode', $_POST['mainSubs'], PDO::PARAM_STR); 
            $stmt->bindParam(':RollNo', $_POST['RollNo'], PDO::PARAM_STR);
            $stmt->execute();  


            if($_POST['sem']==3){
            $sql = "UPDATE studpref SET Sem3Subs = :SubCode,           
            Sem3 = 1,    
            Sem3Counter = :Sem3Counter,
            PrefArea = :PrefArea        
            WHERE RollNo = :RollNo";
            $stmt = $con->prepare($sql);            
            $stmt->bindParam(':SubCode', $_POST['subs'], PDO::PARAM_STR); 
            $stmt->bindParam(':PrefArea', $_POST['PrefArea'], PDO::PARAM_STR);
            $stmt->bindParam(':RollNo', $_POST['RollNo'], PDO::PARAM_STR);
            $stmt->bindParam(':Sem3Counter', $_POST['mainCounter'], PDO::PARAM_STR);
            $stmt->execute();  
            echo "Subjects Addded Succesfully";
    }
    else if($_POST['sem']==4){

            $query2 = $con->prepare("SELECT * FROM studpref WHERE RollNo = '".$_POST['RollNo']."'");
            $query2->execute();
            $row = $query2->fetch();            
            $prefAreaSubsCount = $row['Sem3Counter']+$_POST['mainCounter'];
            if($prefAreaSubsCount>=6){
                 $sql = "UPDATE studpref SET Sem4Subs = :SubCode,           
                        Sem4 = 1,    
                        Sem4Counter = :Sem4Counter,
                        PrefArea = :PrefArea        
                        WHERE RollNo = :RollNo";
            $stmt = $con->prepare($sql);
            
            $stmt->bindParam(':SubCode', $_POST['subs'], PDO::PARAM_STR); 
            $stmt->bindParam(':PrefArea', $_POST['PrefArea'], PDO::PARAM_STR);
            $stmt->bindParam(':RollNo', $_POST['RollNo'], PDO::PARAM_STR);
            $stmt->bindParam(':Sem4Counter', $_POST['mainCounter'], PDO::PARAM_STR);
            $stmt->execute(); 
            echo "Subjects Addded Succesfully";

            }   
            else{
                $rem = 6-$row['Sem3Counter'];
                echo "Please select ".$rem." subject from preferred area.";
            }        
    }    
    }

    else if($_POST['type']=="Double"){
        $myArray = explode(',', $_POST['PrefArea']);

        $query = "INSERT `".$myArray[0]."` SET RollNo = :RollNo,          
            SubCode = :SubCode";
            $stmt = $con->prepare($query);  
            $stmt->bindParam(':SubCode', $_POST['mainSubs'], PDO::PARAM_STR); 
            $stmt->bindParam(':RollNo', $_POST['RollNo'], PDO::PARAM_STR);
            $stmt->execute();  

             $query = "INSERT `".$myArray[1]."` SET RollNo = :RollNo,          
            SubCode = :SubCode";
            $stmt = $con->prepare($query);  
            $stmt->bindParam(':SubCode', $_POST['mainSubs'], PDO::PARAM_STR); 
            $stmt->bindParam(':RollNo', $_POST['RollNo'], PDO::PARAM_STR);
            $stmt->execute(); 


            if($_POST['sem']==3){
            $sql = "UPDATE studpref SET Sem3Subs = :SubCode,           
            Sem3 = 1,    
            Sem3Counter = :Sem3Counter,
            PrefArea = :PrefArea        
            WHERE RollNo = :RollNo";
            $stmt = $con->prepare($sql);  
            $stmt->bindParam(':SubCode', $_POST['subs'], PDO::PARAM_STR); 
            $stmt->bindParam(':PrefArea', $_POST['PrefArea'], PDO::PARAM_STR);
            $stmt->bindParam(':RollNo', $_POST['RollNo'], PDO::PARAM_STR);
            $stmt->bindParam(':Sem3Counter', $_POST['mainCounter'], PDO::PARAM_STR);
            $stmt->execute();  
            echo "Subjects Addded Succesfully";
    }
    else if($_POST['sem']==4){

            $query2 = $con->prepare("SELECT * FROM studpref WHERE RollNo = '".$_POST['RollNo']."'");
            $query2->execute();
            $row = $query2->fetch();            
            $prefAreaSubsCount = $row['Sem3Counter']+$_POST['mainCounter'];
            if($prefAreaSubsCount>=6){
                 $sql = "UPDATE studpref SET Sem4Subs = :SubCode,           
                        Sem4 = 1,    
                        Sem4Counter = :Sem4Counter,
                        PrefArea = :PrefArea        
                        WHERE RollNo = :RollNo";
            $stmt = $con->prepare($sql);  
            $stmt->bindParam(':SubCode', $_POST['subs'], PDO::PARAM_STR); 
            $stmt->bindParam(':PrefArea', $_POST['PrefArea'], PDO::PARAM_STR);
            $stmt->bindParam(':RollNo', $_POST['RollNo'], PDO::PARAM_STR);
            $stmt->bindParam(':Sem4Counter', $_POST['mainCounter'], PDO::PARAM_STR);
            $stmt->execute(); 
            echo "Subjects Addded Succesfully";

            }   
            else{
                $rem = 6-$row['Sem3Counter'];
                echo "Please select ".$rem." subject from preferred area.";
            }        
    }    

    }

     
 
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }


 
    ?>