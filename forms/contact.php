<?php

require_once("../backend/connection.php");

if (isset($_POST['contact_btn'])) {

    //secure the special charactors
    $fullname = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $subject = mysqli_real_escape_string($conn,$_POST['subject']);
    $message = mysqli_real_escape_string($conn,$_POST['message']);
    
        
    $query = "INSERT INTO `customer_contacts` (`fullname`, `email_address`, `subject`, `message`) VALUES ('$fullname', '$email', '$subject', '$message')";
    
    mysqli_query($conn,$query);
    
    #echo "<script>alert('happy or not');</script>";
    
    header("location: ../index.php");

    
    
}

?>