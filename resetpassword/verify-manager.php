<?php

session_start();

if (!isset($_SESSION['step_1'])) {

    header("location: ../index.php");
}

require("../backend/connection.php");

if (isset($_POST['send'])) {
   
    $user_mail = mysqli_real_escape_string($conn,$_POST['mailaddress']);

    //check if manager's email exists
    $sql = "SELECT email FROM `manager` WHERE email='$user_mail' LIMIT 1";
    
    $find_manager = mysqli_query($conn,$sql);

    //if upper two query are successfully executed then switch to the respected user
    if ($find_manager) {

         #echo mysqli_error($conn);
        $result = mysqli_fetch_assoc($find_manager);

        //if manager's email found then send him/her a mail otp
        if ($result['email'] == $user_mail) {
            #echo "email found";
           
            $find_already = "DELETE FROM user_otp WHERE email_address='$user_mail'";
            $run = mysqli_query($conn,$find_already);

            //create a random 4 digit otp
            $OTP = rand(1000,9999);
            #echo "<br>".$OTP." is your otp";
            
            //Now let's encrypt the OTP
            $OTP_hash = password_hash($OTP,PASSWORD_BCRYPT);
            
            //get time in bytes
            $current_time = time();
            #echo $current_time;
            $otp_expire_time = $current_time + 300; #expire after 1min
            
           
            //add this hash to the database
            $sql = "INSERT INTO `user_otp` (`email_address`, `otp`,`otp_expire_time`) VALUES ('$user_mail', '$OTP_hash','$otp_expire_time')";
            $add_hash = mysqli_query($conn,$sql);

            #echo mysqli_error($conn);
            if ($add_hash) {
                #echo "added to the db";

                $_SESSION['otp_of_manager'] = $user_mail;
                
            }else{

                echo "<script>alert('Something Went Wrong.Please try again later!'); window.location.href='reset-manager-password.php'; </script>";
            }
            
            //Now send mail to the respected user
            $to = $user_mail;
            $subject = "Password Reset Request For SWIFT BANK Account";
            $message = $OTP." is your OTP. Don't share this OTP with anyone. We have received your password reset request.[  $OTP ] Enter this OTP and reset your password. Thank you! Team Swift Bank.";
            $header = "From: viveknimbolkar.educationhost.cloud";

            //now send a mail
            $send_mail_check = mail($to,$subject,$message,$header);

            if ($send_mail_check) {
                echo "<script>alert('Check you email address for OTP!'); window.location.href = 'verify.php'</script>";
            }else{
                "<script>alert('Something went wrong! Please try again.');window.location.href='reset-manager-password.php'; </script>";
            }

        }else{
            #if email is not found in both of the database then alert user
            echo "<script>alert('Email Not Found! Please enter correct email.'); </script>";
        }
    }else{
        #if there was a problem in connection
       echo "<script>alert('Something Went Wrong.Please try again later!'); window.location.href='reset-manager-password.php';  </script>";
    }
   
    
}#end of send isset

if (isset($_POST['verifyOTP'])) {

    $userotp = $_POST['enteredotp'];

    //SELECT THE EMAIL ADDRESS AND OTP
    $sql = "SELECT * FROM user_otp WHERE email_address='$_SESSION[otp_of_manager]' LIMIT 1";
    $find_otp = mysqli_query($conn,$sql);
    $otp_result = mysqli_fetch_assoc($find_otp);

    //if email is found
    if ($otp_result['email_address'] == $_SESSION['otp_of_manager']) {
        #echo "address found";

        $cur_time = time();
        #echo $cur_time;
        //if otp is expired after 1min
        if ($otp_result['otp_expire_time'] < $cur_time ) {

            echo "<script>alert('This OTP is expired!'); </script>";

        }else{
                //if otp is not expired check the otp hash
            $check_otp = password_verify($userotp,$otp_result['otp']);

            if ($check_otp) {
                //if otp is match
                #echo "password matched";
                header("location: confirm-manager-password.php");

            }else{
                //if otp is not match
                echo "<script>alert('Incorrect OTP!'); </script>";
            }
        }

    }else{
        echo "<script>alert('Please enter correct email address!'); </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="../assets/img/favicon.svg" rel="icon">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.css">
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
<?php


?>
    <div class="container">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4" id="mainform">
                <center>
                    <h3>Reset Your Password</h3>
                    <p>Please enter the otp sent on your registered mobile number.</p>
                    <form class="row g-3" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                          <input type="text" name="enteredotp" class="form-control" placeholder="Enter OTP">
                          <input type="submit" name="verifyOTP" value="Reset Password" class="btn btn-primary">
                    </form>    
                </center>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
    

    <script src="../assets/vendor/bootstrap/js/bootstrap.js"></script>
</body>
</html>