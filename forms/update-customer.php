<?php

    require("../backend/connection.php");

    if (isset($_GET['updatebtn'])) {
       
        //get the values from form
        
        $query = "UPDATE customerdata SET first_name='$_POST[fname]',father_name='$_POST[fathername]',last_name='$_POST[lname]',mobile_no='$_POST[mobileno]',aadhar_no='$_POST[aadharno]',dob='$_POST[dob]',email_address='$_POST[emailaddr]',account_no='$_POST[accno]',city='$_POST[city]',taluka='$_POST[taluka]',district='$_POST[district]',`state`='$_POST[state]',pincode='$_POST[pincode]',age='$_POST[age]' WHERE account_no='$_POST[accno]'" OR die("query error");

        $result = mysqli_query($conn,$query);

        header("Location: ../manager/manager-dashboard.php");
    }



?>