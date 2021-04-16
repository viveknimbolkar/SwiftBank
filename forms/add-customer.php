<?php

    require("../backend/helpme.php");
    checkLogin();
    
    require("../backend/connection.php");

    #customer added by employee
    if (isset($_POST['addcustomer'])) {

        $timestamp = date("Y-m-d");
        echo $timestamp;
        
        $query = "INSERT INTO `customerdata` (`first_name`, `father_name`, `last_name`, `email_address`, `mobile_no`, `account_no`, `aadhar_no`, `address`, `city`, `taluka`, `district`, `state`, `dob`, `balance`, `pincode`, `customer_img`, `gender`, `timestamp`) VALUES ('$_POST[firstname]', '$_POST[fathername]', '$_POST[lastname]', '$_POST[emailaddress]', '$_POST[mobileno]', '$_POST[accountno]', '$_POST[aadharno]', '$_POST[address]', '$_POST[city]', '$_POST[taluka]', '$_POST[district]', '$_POST[state]', '$_POST[dob]', '$_POST[balance]', '$_POST[pincode]', '','$_POST[flexRadioDefault]','$timestamp')";
        
       $result = mysqli_query($conn,$query);

       echo mysqli_error($conn);

        if ($result) {

            /*if ($_SESSION['empfname']) {
                redirect to employee dashboard
                header("Location: ../employee/employee-dashboard.php");
            }
            if ($_SESSION['managername']) {
                //redirect to manager dashboard
                header("Location: ../manager/manager-dashboard.php");
             }*/

             ?>
               <!--html is here -->
               <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer ID Card</title>
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.css">
    <style>

        #main-id{
            width: 500px;
            height: 300px;
            margin-top: 15%;
            border: 2px dashed black;
        }
        #photo{
            border: 1px solid black;
            width: 140px;
            height: 170px;
            margin-left: 5%;
            margin-top: 5%;
        }
        #info{
            height: 200px;
        }
        #options{
            margin-top: 5%;
        }
    </style>
</head>
<body>
    
    <div class="container" id="printID">
        <div class="row" >
            <div class="col-sm-3"></div>
            <!------Main column-->
            <div id="main-id" class="col-sm-5">
                <div class="mt-3" id="heading">
                    <center>
                        <h4><b>Swift Bank ID Card</b></h4>
                    </center>
                </div>
                
                <div class="row">
                    <!-------Photo-->
                    <div id="photo" class="col-sm-4">
                        <center class="m-3">Photo</center>
                    </div>
                    <!------Information--->
                    <div class="col-sm-8 " id="info"><br>
                        <b>Name&nbsp;&nbsp;:</b>&nbsp;<?php echo $_POST['firstname']." ".$_POST['fathername']." ".$_POST['lastname']; ?><br>
                        <b>Account No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>&nbsp;&nbsp;&nbsp;<?php echo $_POST['accountno']; ?><br>
                        <b>DOB&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>&nbsp;&nbsp;&nbsp;<?php echo $_POST['dob']; ?><br>
                        <b>Mobile No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>&nbsp;&nbsp;&nbsp;<?php echo $_POST['mobileno']; ?><br>
                        <b>Pincode&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>&nbsp;&nbsp;&nbsp;<?php echo $_POST['pincode']; ?><br>
                        <b>Date of Issue&nbsp;:&nbsp;&nbsp;&nbsp;</b><?php echo date('d/m/Y'); ?>
                    </div>
                    <!---signature-->
                    <div class="col-sm-8"></div>
                    <div class="col-sm-4" id="signature">
                        Signature
                    </div>
                </div>

            </div>
            <div class="col-sm-3"></div>
        </div>
        
    </div>
    <!----Options for user--->
    <center id="options">
            <button class="btn btn-primary" onclick="printDiv()">Print</button>

            <?php
            if (isset($_SESSION['empfname'])) {
                echo "<a href='../employee/employee-dashboard.php' class='btn btn-outline-primary'>Home</a>";
                
            }
            

            if (isset($_SESSION['managername'])) {
                echo "<a href='../manager/manager-dashboard.php' class='btn btn-outline-primary'>Home</a>";
             }
           ?>
    </center>

    <script src="../assets/vendor/bootstrap/js/bootstrap.js"></script>

    <!--Print the id function----->
    <script>
        function printDiv(printID) {
            var printContents = document.getElementById("printID").innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
          }
    </script>
</body>
</html>



               
             <?php
            
        }else{

            echo "Record is not Added!";

        }#end of success query completion


    }#end of addcustomer submit


    /*
#customer adding by manager
   if (isset($_POST['manageraddcustomer'])) {
        
        $query = "INSERT INTO `customerdata` (`first_name`, `father_name`, `last_name`, `mobile_no`, `aadhar_no`, `dob`, `email_address`, `account_no`, `city`, `taluka`, `district`, `state`, `address`, `pincode`) VALUES ('$_POST[firstname]', '$_POST[fathername]', '$_POST[lastname]', '$_POST[mobileno]', '$_POST[aadharno]', '$_POST[dob]', '$_POST[emailaddress]', '$_POST[accountno]', '$_POST[city]', '$_POST[taluka]', '$_POST[district]', '$_POST[state]', '$_POST[address]', '$_POST[pincode]')" OR die("Query 2 error");
        
        $result = mysqli_query($conn,$query) or die("result 2 error");

        if ($result) {
            header("Location: ../employee/employee-dashboard.php");
        }else{
            echo "Can't add!";
        }
    
    }*/





?>