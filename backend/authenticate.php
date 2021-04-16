<?php

require("connection.php");

#authenticate manager
if (isset($_POST['managerlogin'])) {

      //verify the bot or not
      $secret = '6LdJ7KsaAAAAAAmsa2JFRrUcwFLp91SyucVvxzB3';

      $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
      
        $responseData = json_decode($verifyResponse);

      //if user is not a robot
      if($responseData->success){

        $query = "SELECT * FROM `manager` WHERE email='$_POST[email]'" or die("error");
       
        $result = mysqli_query($conn,$query) or die("fatal error");

        while($row = mysqli_fetch_assoc($result)){

          if ($row['email'] == $_POST['email']) {
            
            if ($row['pass'] == $_POST['password']) {

              session_start();

              $_SESSION['managername'] = $row['name'];

              header("Location: ../manager/manager-dashboard.php");

            }else{
              
              header("Location: ../forms/manager-login.php");
            }
          }
        }
      }else{
        //if user is a robot
        echo "<script> alert('You are robot. Stop doing this!'); </script>";
      }
}


  #authenticate employee
if (isset($_POST['emplogin'])) {
  
    //verify the bot
    $secret = '6LdJ7KsaAAAAAAmsa2JFRrUcwFLp91SyucVvxzB3';
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
    $responseData = json_decode($verifyResponse);
    if($responseData->success){
    
      //if user is not a bot

      $query = "SELECT * FROM `employeedata` WHERE email_address='$_POST[email]'" or die("error");
      $result = mysqli_query($conn,$query) or die("fatal error");

      while($row = mysqli_fetch_assoc($result)){

        if ($row['email_address'] == $_POST['email']) {
          
          if ($row['pass'] == $_POST['pwd']) {

            session_start();
            
            $_SESSION['empfname'] = $row['first_name'];
            
            $_SESSION['emplname'] = $row['last_name'];
            
            header("Location: ../employee/employee-dashboard.php");

          }else{

            header("Location: ../forms/employee-login.php");
          }
        }
      } 
    }else{
      //if user is a robot
      echo "<script> alert('You are robot. Stop doing this!'); </script>";
    }
}


?>