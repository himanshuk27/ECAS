<?php 
session_start();
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');  //On or Off
include('php/intialize.php');

if(!isset($_SESSION["Username"]) && $_SESSION['Password'] != true){
    header("Location: login.php");
    die();
}


$query = $con->prepare("SELECT * FROM `electives`");
$query->execute();
$row = $query->fetch();
?>
<!DOCTYPE html>
<html lang="en">

<head>  

   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="electives capture and assignment system - ECAS">
   <meta name="author" content="Alabhya Vaibhav & Himanshu Kumar">
   <meta name="keyword" content="ECAS,KSOM">
   <link rel="shortcut icon" href="img/favicon.png">

   <title>Electives Capture and Assignment System - ECAS</title>

   <!-- Icons -->
   <link href="css/font-awesome.min.css" rel="stylesheet">
   <link href="css/simple-line-icons.css" rel="stylesheet">

   <!-- Main styles for this application -->
   <link href="css/style.css" rel="stylesheet">    
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">

  <div id="myModal" class="modal modal-success">
      <div class="modal-dialog modal-success">
          <div class="modal-backdrop modal-success"> 
              <div class="modal-content modal-success" style="width: 60% !important; margin: 10% 20%;">
                <span class="close">&times;</span>
                <h2 class="modal-header">sjcjhj</h2>
                <p class="modal-body">Some text in the Modal..</p>
            </div>
        </div>
    </div>
</div> 
 <header class="app-header navbar">
            <button class="navbar-toggler mobile-sidebar-toggler hidden-lg-up" type="button">☰</button>
            <a class="navbar-brand" href="#"></a>
            
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
            <li class="breadcrumb-item"><a href="#">Admin</a>
            </li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>


        <div class="container-fluid">



                            <h2>Subjects offered</h2>
                    <div class="row">

                       <div class="row animated fadeIn" id="SelectedSubjectList">
                            <br />
                            <div class="card-block">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Subject Code</th>
                                            <th>Subject Name</th>
                                            <th>Area</th>
                                            <th>Professor Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                       for($i=0; $row = $query->fetch(); $i++){               
                                        ?>

                                        <tr>
                                            <td><?php echo $row['SubCode'];?></td>
                                            <td><?php echo $row['SubName'];?></td>
                                            <td><?php echo $row['Area'];?></td>
                                            <td><?php echo $row['facName']?></td>
                                        </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                           </div>
                        </form>
                    </div>






                    <!--- >End -->



</div></div>
                </main>

            </div>
<footer class="app-footer">
    <a href="http://kodexlabs.in">kodexlabs</a> © 2017.
</footer>




            <!-- Bootstrap and necessary plugins -->
            <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>



            <!-- Plugins and scripts required by all views -->
            <!--script src="bower_components/chart.js/dist/Chart.min.js"></script -->


            <!-- GenesisUI main scripts -->

            <script src="js/app.js"></script>
            <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="   crossorigin="anonymous"></script>




            <!-- Plugins and scripts required by this views -->

            <!-- Custom scripts required by this view -->
            <script src="js/views/main.js"></script>
        </body>

        </html>