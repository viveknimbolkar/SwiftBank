<?php

require("../backend/connection.php");

if (isset($_POST['contact_btn'])) {
        
    $query = "INSERT INTO `customer_contacts` (`fullname`, `email_address`, `subject`, `message`) VALUES ('$_POST[name]', '$_POST[email]', '$_POST[subject]', '$_POST[message]')";
    
    mysqli_query($conn,$query);
    echo "<script>alert('happy or not');</script>";
    header("location: ../index.php");

    
    
}

?>