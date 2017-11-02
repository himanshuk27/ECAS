<?php 
session_start();
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');  //On or Off
ob_start();
include('php/intialize.php');

if(!isset($_SESSION["Username"]) && $_SESSION['Password'] != true){
    header("Location: login.php");
    die();
}


$query = $con->prepare("SELECT * FROM `studpref` WHERE RollNo = '".$_SESSION["Username"]."'");
$query->execute();
$row = $query->fetch();

if($row>0){
    if($row['Major']!="Double")
        header("Location: index.php");   
}
else{
    header("Location: index.php"); 
}

if(isset($_GET['area'])) {
    $myArray = explode(',', $_GET['area']);
    $query1 = $con->prepare("SELECT * FROM `electives` WHERE Area = '".$myArray[0]."' AND Sem = '".$_GET['sem']."'");
    $query1->execute();
    $query3 = $con->prepare("SELECT * FROM `electives` WHERE Area = '".$myArray[1]."' AND Sem = '".$_GET['sem']."'");
    $query3->execute();
    $query2 = $con->prepare("SELECT * FROM `electives` WHERE Area != '".$myArray[0]."' AND Area != '".$myArray[1]."' AND Sem = '".$_GET['sem']."'");
    $query2->execute();
}


$allow = 0;

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
    <link href="css/docs.min.css" rel="stylesheet">

    <script src="js/jquery.min.js"></script>
    <script type="text/javascript">
       var selectCounter = 0;
       var area = new Array();
       function subjectSelection(ID){
         $("#"+ID).hide();                
         selectCounter++;
         area.push(ID);
         if(selectCounter==2){
            window.location = window.location.href+"&area="+area.toString();                    
        }
    }
</script>
<script type="text/javascript">           

    function submit(){
        var counter = 0;
        var checkboxes = document.getElementsByClassName('checkedsubsMain1');
        var checkboxes2 = document.getElementsByClassName('checkedsubsMain1');
        var checkCount1 = 0;
        var mainSubs1 = new Array();
        for(var i = 0; i < checkboxes.length; i++){
            if(checkboxes[i].checked){
                checkCount1++;
                mainSubs1.push(checkboxes[i].value);
            }
        }
        var checkCount2 = 0;
        var mainSubs2 = new Array();
        for(var i = 0; i < checkboxes2.length; i++){
            if(checkboxes2[i].checked){
                checkCount2++;
                mainSubs2.push(checkboxes2[i].value);
            }
        }       

        var checkedValues = $('input:checkbox:checked').map(function() {
         counter++;
         return this.value;                     
     }).get();                                        
        if(counter!=8){
            alert("Please select 8 subjects");
        }   
        else{
            if(checkCount1+checkCount2>=6){
                var data = new FormData();
                data.append('RollNo', document.getElementById("RollNo").value);
                data.append('subs', checkedValues.toString());
                data.append('PrefArea', document.getElementById("PrefArea").value);
                data.append('sem', document.getElementById("sem").value);
                data.append('type', "Double");
                data.append('mainSubs', mainSubs1.toString() + mainSubs2.toString());
                data.append('mainCounter', checkCount1 + checkCount2);

                $.ajax( {
                  type: 'POST',
                  url: 'php/insert.php',
                  data: data,
                  processData: false,
                  contentType: false,
                  cache: false,
                  success:function(result){                     
                    alert(result);  
                    window.location="index.php"; 

                }
            });
            }
            else{
                alert("Total no of subjects from both selected area should be 6!");
            }

        }
    } 

</script>  
<script type="text/javascript">
        function handleChange(checkbox) {
            var ar1 = new Array("","BM6829","BM68292","BM68293","BM68294","BM68291");
            var ar2 = new Array("","BM6813","BM68131");
            var ar3 =new Array("","BM6607","BM66071");
            if(checkbox.checked == true){                
                    if(ar1.indexOf(checkbox.value)>0){
                       for (var i=0; i<=ar1.length; i++) {
                        if(ar1[i]!=checkbox.value){
                            if (ar1[i]!="") {                               
                                var link = document.getElementById(ar1[i]);
                                link.style.display = 'none';    
                            }
                            
                        }                        
                    }
                }
                else if(ar2.indexOf(checkbox.value)>0){
                       for (var i=0; i<ar2.length; i++) {
                        if(ar2[i]!=checkbox.value){
                            if (ar2[i]!="") {   
                            var link = document.getElementById(ar2[i]);
                            link.style.display = 'none';
                        }
                        }                        
                    }
                }
                else if(ar3.indexOf(checkbox.value)>0){
                       for (var i=0; i<ar3.length; i++) {
                        if(ar3[i]!=checkbox.value){
                            if (ar3[i]!="") {   
                            var link = document.getElementById(ar3[i]);
                            link.style.display = 'none';
                        }
                        }                        
                    }
                }

        }else{            
                if(ar1.indexOf(checkbox.value)>0){
                  for (var i=0; i<ar1.length; i++) {
                    if(ar1[i]!=checkbox.value){
                        if (ar1[i]!="") {   
                                var link = document.getElementById(ar1[i]);
                                link.style.display = '';    
                            }
                    }                        
                }  
            }
            else if(ar2.indexOf(checkbox.value)>0){
                  for (var i=0; i<ar2.length; i++) {
                    if(ar2[i]!=checkbox.value){
                        if (ar2[i]!="") {   
                        var link = document.getElementById(ar2[i]);
                        link.style.display = '';
                    }
                    }                        
                }  
            }
            else if(ar3.indexOf(checkbox.value)>0){
                  for (var i=0; i<ar3.length; i++) {
                    if(ar3[i]!=checkbox.value){
                        if (ar3[i]!="") {   
                        var link = document.getElementById(ar3[i]);
                        link.style.display = '';
                    }
                    }                        
                }  
            }
    }
}
</script>

<!-- Main styles for this application -->
<link href="css/style.css" rel="stylesheet">    
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
        <p>Proceed with the selected subjects?</p>       
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button onclick="submit();" type="button" class="btn btn-primary">Save changes</button>
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

        <?php 

        if(isset($_GET['sem'])){
            if($_GET['sem']==3){
                if($row['Sem3']==1){
                    ?>
                    <h2>You've already chosen subs for sem3</h2>
                    <br>
                    <a href="index.php"><h3>Go Back</h3></a>
                    <?php  
                }
                else
                    $allow = 1;
            }

            else if($_GET['sem']==4){     


                if($row['Sem3']==0){ ?>

                <h2>First choose sem 3 subjects</h2>
                <br>
                <a href="index.php"><h3>Go Back</h3></a>

                <?php }
                else{
                    if($row['Sem4']==1){ ?>
                    <h2>You've already chosen subs for sem4</h2>
                    <br>
                    <a href="index.php"><h3>Go Back</h3></a>
                    <?php   }
                    else{
                        $query4 = $con->prepare("SELECT * FROM studpref WHERE RollNo = '".$_SESSION["Username"]."'");
                        $query4->execute();
                        $row = $query4->fetch(); 
                        $url = $_SERVER['REQUEST_URI']."&area=".$row['PrefArea'];
                        if(!isset($_GET['area']) || $_GET['area']!=$row['PrefArea'])
                            header("Location: $url");
                        else
                            $allow = 1;
                    }
                }
            }
        }


        else{   ?>

        <div class="row" id="sems">

            <div class="col-6 col-lg-4" onclick="location.href='?sem=3';" id="3"  style="cursor:pointer;">
                <div class="card">
                    <div class="card-block p-0 clearfix">
                        <i class="bg-primary p-2 font-2xl mr-1 float-left">3<SUP>rd</SUP></i>
                        <div class="h5 text-primary mb-0 pt-1">Semester</div>
                        <div class="text-muted text-uppercase font-weight-bold font-xs">Select your subjects for 3<sup>rd</sup>Semester</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-4" onclick="location.href='?sem=4';" id="4"  style="cursor:pointer;">
                <div class="card">
                    <div class="card-block p-0 clearfix">
                        <i class="bg-primary p-2 font-2xl mr-1 float-left">4<SUP>th</SUP></i>
                        <div class="h5 text-primary mb-0 pt-1">Semester</div>
                        <div class="text-muted text-uppercase font-weight-bold font-xs">Select your subjects for 4<sup>th</sup>Semester</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php } 

    if($allow==1){

        if(!isset($_GET['area'])){
            ?>



            <div class="animated fadeIn" name="subject" id="subject">

                <div class="row">
                   <?php

                   $areaFetch = $con->prepare("SELECT * FROM `subject`");
                   $areaFetch->execute();

                   for($i=0; $row = $areaFetch->fetch(); $i++){   
                     if($row['ShortSub']=="GM")
                        return;               


                    ?>
                    <!--- >Start from here -->
                    <div class="col-sm-6 col-lg-3" name="subjectCard" id="<?php echo $row['ShortSub'];?>">
                        <div class="card card-inverse card-primary" onclick="subjectSelection(this.id);" id="<?php echo $row['ShortSub'];?>" style="cursor:pointer;">
                            <div class="card-block pb-0">

                                <h2 class="mb-0" id="<?php echo $row['ShortSub'];?>"><?php echo $row['SubjectName'];?></h2>
                                <br />
                                <?php
                                $result2 = $con->prepare("SELECT * FROM `electives` WHERE Area='".$row['ShortSub']."' ");
                                $result2->execute();
                                for($j=0; $row2 = $result2->fetch(); $j++){
                                    ?>
                                    <h6 id="<?php echo $row['ShortSub'];?>"><?php echo $row2['SubName'];?></h6>
                                    <?php } ?>
                                </div>
                                <div id="<?php echo $row['ShortSub'];?>" class="chart-wrapper px-1" style="height:70px;">
                                    <canvas id="card-chart1" class="chart" height="70"></canvas>
                                </div>
                            </div>
                        </div>
                        <?php }  ?>
                    </div>
                </div>    
                <?php 
            }
            else if(isset($_GET['area'])) {
                ?>
                <button type="button" class="btn" onclick="window.history.back();" style="cursor:pointer;">Go Back</button>
                <div class="row animated fadeIn" id="SelectedSubjectList">
                    <h2>Selected Area</h2>
                    <div class="card-block">
                        <table class="table">
                            <thead>                    
                                <tr>
                                    <th>Subject Code</th>
                                    <th>Subject Name</th>
                                    <th>Area</th>
                                    <th>Select</th>
                                </tr>                        
                            </thead>
                            <tbody>                      

                                <?php
                                for($i=0; $row = $query1->fetch(); $i++){               
                                 ?>

                                 <tr id="<?php echo $row['SubCode'];?>">
                                    <td><?php echo $row['SubCode'];?></td>
                                    <td><?php echo $row['SubName'];?></td>
                                    <td><?php echo $row['Area'];?></td>
                                    <td><input class="checkedsubsMain1" onchange="handleChange(this);" type="checkbox" value="<?php echo $row['SubCode'];?>"></td>
                                </tr>

                                <?php } 
                                for($i=0; $row = $query3->fetch(); $i++){ ?>     
                                <tr id="<?php echo $row['SubCode'];?>">
                                    <td><?php echo $row['SubCode'];?></td>
                                    <td><?php echo $row['SubName'];?></td>
                                    <td><?php echo $row['Area'];?></td>
                                    <td><input class="checkedsubsMain2" onchange="handleChange(this);" type="checkbox" value="<?php echo $row['SubCode'];?>"></td>
                                </tr>
                                <?php } ?>                           

                            </tbody>
                        </table>                        
                    </div>

                </div>

                <div class="row animated fadeIn" id="OtherSubjectList">
                    <h2>Other Areas</h2>

                    <div class="card-block">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Subject Code</th>
                                    <th>Subject Name</th>
                                    <th>Area</th>
                                    <th>Select</th>
                                </tr>
                            </thead>
                            <tbody>                        
                               <?php
                               for($i=0; $row = $query2->fetch(); $i++){               
                                 ?>
                                 <tr id="<?php echo $row['SubCode'];?>">
                                    <td><?php echo $row['SubCode'];?></td>
                                    <td><?php echo $row['SubName'];?></td>
                                    <td><?php echo $row['Area'];?></td>
                                    <td><input type="checkbox" onchange="handleChange(this);" class="checkedsubsOther" value="<?php echo $row['SubCode'];?>"></td>
                                </tr>                                

                                <?php } ?>

                            </tbody>
                        </table>                        
                        <center>
                            <input type="hidden" id="RollNo" value="<?php echo $_SESSION["Username"]; ?>">
                            <input type="hidden" id="PrefArea" value="<?php echo $_GET['area']; ?>">
                            <input type="hidden" id="sem" value="<?php echo $_GET['sem']; ?>">
                            <!--input onclick="submit();" type="submit" class="btn btn-primary" name="submit"-->
                            <button onclick="$('#exampleModal').modal('show')" type="button" class="btn btn-primary">
                                Submit
                            </button>

                        </center>

                    </div>                

                </div>




                <!--- >End -->

                <?php }} ?>

            </main>



        </div>
        <footer class="app-footer">
            <a href="http://kodexlabs">kodexlabs</a> © 2017.
        </footer>



        <!-- Bootstrap and necessary plugins -->


        <!--script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script-->
        <!--script src="js/jquery.min.js"></script-->
        <script src="js/tether.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/pace.min.js"></script>
        <script src="js/docs.min.js"></script>


        <!-- Plugins and scripts required by all views -->
        <!--script src="bower_components/chart.js/dist/Chart.min.js"></script -->


        <!-- GenesisUI main scripts -->

        <!--script src="js/app.js"></script--> 

        <!-- Plugins and scripts required by this views -->

        <!-- Custom scripts required by this view -->
        <script src="js/views/main.js"></script>



    </body>

    </html>