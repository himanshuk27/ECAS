<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');  //On or Offs
#   connect to database
    require('connect.php');  //  this file is placed outside of public_html for better security.
#   include classes
    foreach (glob('assets/classes/*.class.php') as $class_filename){
        include($class_filename);
    }
#   include functions
    foreach (glob('assets/functions/*.func.php') as $func_filename){
        include($func_filename);
    }
#   handle sessions


    ?>