<?php

require("../backend/connection.php");

if (isset($_POST['subscribe_btn'])) {

    $subscriber_email = $_POST['subsc_email'];    

    $current_date = date("Y-m-d");

    $add_subscriber = "INSERT INTO `subscribers` (`subscriber_email`, `timestamp`) VALUES ('$subscriber_email ', '$current_date')";
   
    $res = mysqli_query($conn,$add_subscriber);

 if ($res) {
    header("Location: ../index.php");
 }
   

}


?>