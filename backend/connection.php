<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "swiftbank";

    $conn = mysqli_connect($servername,$username,$password,$db);

    if (!$conn) {
        die("Connection Error!");
    }





?>