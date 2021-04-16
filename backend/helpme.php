<?php

//use to redirect respective page
function redirectPage(){
    
    //added extra
    session_start();
    
    if (isset($_SESSION['empfname'])) {

        echo "<script> window.location.href='../employee/employee-dashboard.php'; </script>";
        
    }elseif (isset($_SESSION['managername'])) {

        echo "<script> window.location.href='../manager/manager-dashboard.php'; </script>";
    }
}


//check if already logged in or not
function checkLogin(){

    session_start();

    if (!(isset($_SESSION['managername']) OR isset($_SESSION['empfname']))) {

        header("Location: ../index.php");
    }
}


?>