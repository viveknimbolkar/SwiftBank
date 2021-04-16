<?php

    session_start();
     
    if (!isset($_SESSION['managername'])) {
        header("Location: ../index.php");
    }

    require("../backend/connection.php");

    if (isset($_POST['addemp'])) {
        
        $query = "INSERT INTO `employeedata` (`first_name`, `father_name`, `last_name`, `email_address`, `mobile_no`, `emp_id`, `dob`, `aadhar_no`, `qualification`, `address`, `city`, `taluka`, `district`, `state`,`pass`) VALUES ('$_POST[firstname]', '$_POST[fathername]', '$_POST[lastname]', '$_POST[emailaddr]', '$_POST[mobileno]', '$_POST[empid]', '$_POST[dob]', '$_POST[aadharno]', '$_POST[qualification]', '$_POST[address]', '$_POST[city]', '$_POST[taluka]', '$_POST[district]', '$_POST[state]','$_POST[pwd2]')";
        
        $result = mysqli_query($conn,$query);

        if ($result) {
           
           ?>
           
             <!--html is here -->
             <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee ID Card</title>
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
                        <h4><b>Swift Bank Employee ID </b></h4>
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
                        <b>Employee ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>&nbsp;&nbsp;&nbsp;<b><?php echo $_POST['empid']; ?></b><br>
                        <b>DOB&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>&nbsp;&nbsp;&nbsp;<?php echo $_POST['dob']; ?><br>
                        <b>Mobile No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>&nbsp;&nbsp;&nbsp;<?php echo $_POST['mobileno']; ?><br>
                        <b>Qualification&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>&nbsp;&nbsp;&nbsp;<?php echo $_POST['qualification']; ?><br>
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
            <a href="../manager/manager-dashboard.php" class="btn btn-primary">Home</a>
            
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
            echo "Something Went Wrong! Please Try Again.";
        }
    
    }








?>