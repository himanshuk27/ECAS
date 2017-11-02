<?php
session_start();
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');  //On or Off
include('php/intialize.php');
$message=NULL;
if (isset($_POST['Username'])){
  $Username=$_POST['Username'];
  $Password=base64_encode($_POST['Password']);
$result = $con->prepare("SELECT * FROM studlist WHERE  RollNo ='".$Username."' AND Password = '".$Password."'");
      $result->execute();
$row = $result->fetch();
if($row>0){
  $_SESSION["Username"] = $row['RollNo'];
  $_SESSION["Password"] = $row['Password'];
  header("location:index.php");
 
}

else {
  echo '<script language="javascript">';
echo 'alert("Invalid Credentials")';
echo '</script>';
 
}

}
?>
<!DOCTYPE html>
<html lang="en">

<head>

 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="electives capture and assignment system - ECAS">
    <meta name="author" content="Alabhya Vaibhav & Himanshu Kumar">
    <meta name="keyword" content="Elective System for students">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Electives Capture and Assignment System - ECAS</title>
    <!-- Icons -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/simple-line-icons.css" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="app flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-group mb-0">
                    <div class="card p-2">
                        <div class="card-block">
                            <h1>Login</h1>
                            <p class="text-muted">Sign In to your account</p>
                            <form name="loginform" id="loginform" action="login.php" method="POST">
                            <div class="input-group mb-1">
                                <span class="input-group-addon"><i class="icon-user"></i>
                                </span>
                                <input type="text" id="Username" name="Username" class="form-control" placeholder="Username">
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-addon"><i class="icon-lock"></i>
                                </span>
                                <input type="password" id="Password" name="Password" class="form-control" placeholder="Password">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <input type="submit" name="submit" id="submit" class="btn btn-primary px-2"></input>
                                </div>                                
                                <div class="col-6 text-right">
                                    <button type="button" class="btn btn-link px-0">Forgot password?</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="card card-inverse card-primary py-3 hidden-md-down" style="width:44%">
                        <div class="card-block text-center">
                            <div>
                                <h2>ECAS</h2>
                                <p>Elective Choice Collections and Assignment System</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap and necessary plugins -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/tether/dist/js/tether.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>



</body>

</html>