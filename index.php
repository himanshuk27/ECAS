<?php 
session_start();
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');  //On or Off
include('php/intialize.php');

if(!isset($_SESSION["Username"]) && $_SESSION['Password'] != true){
    header("Location: login.php");
    die();
}



$query = $con->prepare("SELECT * FROM `studpref` WHERE RollNo = '".$_SESSION["Username"]."'");
$query->execute();
$row = $query->fetch();

if($row>0){
    if($row['Major']=="Single")
        header("Location: singlepref.php");
    else if($row['Major']=="Double")
        header("Location: doublepref.php"); 
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
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,AngularJS,Angular,Angular2,jQuery,CSS,HTML,RWD,Dashboard">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Electives Capture and Assignment System - ECAS</title>

    <!-- Icons -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/simple-line-icons.css" rel="stylesheet">
    <link href="css/docs.min.css" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="css/style.css" rel="stylesheet">  
    <script src="js/jquery.min.js"></script>    
    <script src="js/bootstrap.min.js"></script>  
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">


<div id="exampleModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">    
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLiveLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure? You wont be able to change it.</p>       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="setpref.php?type=Single&roll=<?php echo $_SESSION["Username"]; ?>" ><button type="button" class="btn btn-primary">Save changes</button></a>
      </div>

    </div>
  </div>
</div>
<div id="exampleModal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">    
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLiveLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure? You wont be able to change it.</p>       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="setpref.php?type=Double&roll=<?php echo $_SESSION["Username"]; ?>" ><button type="button" class="btn btn-primary">Save changes</button></a>
      </div>

    </div>
  </div>
</div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<header class="app-header navbar">
    <button class="navbar-toggler mobile-sidebar-toggler hidden-lg-up" type="button">☰</button>
    <a class="navbar-brand" href="#"></a>
    <ul class="nav navbar-nav hidden-md-down">
        <li class="nav-item">
            <a class="nav-link navbar-toggler sidebar-toggler" href="#">☰</a>
        </li>

        <li class="nav-item px-1">
            <a class="nav-link" href="#">Dashboard</a>
        </li>
    </ul>
</header>  

<div class="app-body">
    <div class="sidebar">
        <nav class="sidebar-nav">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="subject.php"><i class="icon-puzzle"></i>Subjects</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pref.php"><i class="icon-puzzle"></i>My Preferences </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php"><i class="icon-puzzle"></i>Logout</a>
                </li>

            </ul>
        </li>
    </ul>
</nav>
</div>

<!-- Main content -->
<main class="main">

    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>


    <div class="container-fluid">
       <center>
           <div class="row" id="majortype">
            <div class="col-6 col-lg-4" style="cursor:pointer;" onclick="$('#exampleModal').modal('show')">

                <div class="card">
                    <div class="card-block p-0 clearfix">
                        <i id="single" name="single" class="bg-primary p-2 font-2xl mr-1 float-left">1</i>
                        <div class="h5 text-primary mb-0 pt-1">Single Major</div>
                        <div class="text-muted text-uppercase font-weight-bold font-xs">Select 1 area of interest</div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-4"  style="cursor:pointer;" onclick="$('#exampleModal2').modal('show')">
                <div class="card">
                    <div class="card-block p-0 clearfix">
                        <i class="bg-primary p-2 font-2xl mr-1 float-left">2</i>
                        <div class="h5 text-primary mb-0 pt-1">Dual Major</div>
                        <div class="text-muted text-uppercase font-weight-bold font-xs">Select 2 areas of interest</div>
                    </div>
                </div>
            </div>


        </div>

    </center>
   

    </main>



</div>
<footer class="app-footer">
    <a href="http://kodexlabs.in">kodexlabs</a> © 2017.
</footer>





<!-- Bootstrap and necessary plugins -->
    <script src="js/tether.min.js"></script>
    <script src="js/pace.min.js"></script>
    <script src="js/docs.min.js"></script>

        
        <script src="js/views/main.js"></script>  
        <script type="text/javascript">
            function setPref(pref, roll) {
                if(pref==1){
                    window.Location="setpref.php?pref=Single&roll="+roll;
                }
                else if(pref==2){
                    window.Location="setpref.php?pref=Double&roll="+roll;
                }
            }
        </script>     

</body>

</html>