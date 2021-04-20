<?php

session_start();
$_SESSION['step_1'] = TRUE;



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link href="../assets/img/favicon.svg" rel="icon">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Reset Password</title>
   <style>

        body{
            background-color: #2d7ae5;
        }
        #mainform{
            background-color: white;
            padding: 40px;
            position: absolute;
            top: 40%;
            left: 35%;
            transform: translateY(-50%);
  
        }

    </style> 
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4" id="mainform">
                <center>
                    <h3>Reset Your Password</h3>
                    <p>Don't worry! We will sent you a OTP</p>
                    <form class="row g-3" method="post" action="verify.php">
                          <input type="email" name="mailaddress" class="form-control" placeholder="Enter your email address...">
                          <br><br><input name="send" type="submit" value="Send OTP" class="btn btn-block btn-primary">
                    </form>    
                </center>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
    

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    
</body>
</html>
