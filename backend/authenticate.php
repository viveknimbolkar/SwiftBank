<?php

require_once("connection.php");

#authenticate manager
if (isset($_POST['managerlogin'])) {

      //verify the bot or not by using google captcha
      $secret = '6LdJ7KsaAAAAAAmsa2JFRrUcwFLp91SyucVvxzB3';

      $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
      
      $responseData = json_decode($verifyResponse);

      //if user is not a robot
      if($responseData->success){

        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);

        $query = "SELECT * FROM `manager` WHERE email='$email' LIMIT 1";
        $result = mysqli_query($conn,$query) or die("fatal error");

        //if connection success
        if ($result) {
        
          $fetch_manager_result = mysqli_fetch_assoc($result);
  
          //check email
          if ($email == $fetch_manager_result['email']) {

            #if password is matched then check for the password hash
            if ($password == $fetch_manager_result['pass']) {
              #on password match login the respected user

              session_start();
              $_SESSION['managername'] = $fetch_manager_result['name'];
              
              header("Location: ../manager/manager-dashboard.php");
  
            }else 
              echo "<script> alert('Wrong Credentials!'); window.location.href='../forms/manager-login.php';</script>";
  
          }else 
            echo "<script> alert('Wrong Credentials!'); window.location.href='../forms/manager-login.php';</script>"; 
  
        }#end of connection check
      }else{
        //if user is a robot
        echo "<script> alert('You are robot. Stop doing this!'); </script>";
      }
}


  #authenticate employee
if (isset($_POST['emplogin'])) {
  
    //verify the bot using google captcha
    $secret = '6LdJ7KsaAAAAAAmsa2JFRrUcwFLp91SyucVvxzB3';
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
    $responseData = json_decode($verifyResponse);
   
    if($responseData->success){
    
      //if user is not a bot

      $email = mysqli_real_escape_string($conn,$_POST['email']);
      $password = mysqli_real_escape_string($conn,$_POST['pwd']);

      $query = "SELECT * FROM `employeedata` WHERE email_address='$email' LIMIT 1";
      $result = mysqli_query($conn,$query);

      //if the query executed succefuly
      if ($result) {
        
        $fetch_employee_result = mysqli_fetch_assoc($result);

        //check email
        if ($email == $fetch_employee_result['email_address']) {
          #if password is matched then check for the password hash

          $check_password_hash = password_verify($password,$fetch_employee_result['pass']);

          if ($check_password_hash) {
            #on password match login the respected user
            session_start();
            
            $_SESSION['empfname'] = $fetch_employee_result['first_name'];
            
            $_SESSION['emplname'] = $fetch_employee_result['last_name'];
            
            header("Location: ../employee/employee-dashboard.php");

          }else 
            echo "<script> alert('Wrong Credentials!'); window.location.href='../forms/employee-login.php';</script>";

        }else 
          echo "<script> alert('Wrong Credentials!'); window.location.href='../forms/employee-login.php';</script>"; 

      }#end of connection check
    }else
      //if user is a robot
      echo "<script> alert('You are robot. Stop doing this!'); window.location.href='../forms/employee-login.php'; </script>";
    
}


?>