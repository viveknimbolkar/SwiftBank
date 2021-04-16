<?php

require("../backend/connection.php");

if (isset($_POST['send'])) {
   
    $useremail = mysqli_real_escape_string($conn,$_POST['mailaddress']);
    $GLOBALS['useremail'] = $useremail;
    //check if employee's email exists
    $sql = "SELECT email_address FROM `employeedata` WHERE email_address='$useremail' LIMIT 1";
    $find_employee = mysqli_query($conn,$sql);

    $sql2 = "SELECT email FROM `manager` WHERE email='$useremail' LIMIT 1";
    $find_manager = mysqli_query($conn,$sql2);



    //if upper two query are successfully executed then switch to the respected user
    if ($find_employee && $find_manager) {

         #echo mysqli_error($conn);
        $result = mysqli_fetch_assoc($find_employee);

        $manager_result = mysqli_fetch_assoc($find_manager);

        //if employee's email found then send him/her a mail otp
        if ($result['email_address'] == $useremail) {
            #echo "email found";
            $GLOBALS['select_table'] = "employee_table";
            $find_already = "DELETE FROM user_otp WHERE email_address='$useremail'";
            $run = mysqli_query($conn,$find_already);

            //create a random 4 digit otp
            $OTP = rand(1000,9999);
            echo "<br>".$OTP." is your otp";
            
            //Now let's encrypt the OTP
            $OTP_hash = password_hash($OTP,PASSWORD_BCRYPT);
            
            //get time in bytes
            $current_time = time();
            echo $current_time;
            $otp_expire_time = $current_time + 60; #expire after 1min
            #echo "<br>".$otp_expire_time;
            //add this hash to the database
            $sql = "INSERT INTO `user_otp` (`email_address`, `otp`,`otp_expire_time`) VALUES ('$useremail', '$OTP_hash','$otp_expire_time')";
            $add_hash = mysqli_query($conn,$sql);

            #echo mysqli_error($conn);
            if ($add_hash) {
                echo "added to the db";
                session_start();
                $_SESSION['otp_of_employee'] = $useremail;
                
            }else{
                echo "failed";
            }
            /*
            //Now send mail to the respected user
            $to = $useremail;
            $subject = "Password Reset Request For SWIFT BANK Account";
            $message = $OTP." is your OTP. Don't share this OTP with anyone. We have received your password reset request.[  $OTP ] Enter this OTP and reset your password. Thank you! Team Swift Bank.";
            $header = "From: viveknimbolkar.educationhost.cloud";

            //now send a mail
            $send_mail_check = mail($to,$subject,$message,$header);

            if ($send_mail_check) {
                echo "<script>alert('Check you email address for OTP!'); window.location.href = 'verify.php'</script>";
            }else{
                "<script>alert('Something went wrong! Please try again.') </script>";
            }
*/
        }elseif($manager_result['email'] == $useremail){
            //if the email address is found in manager table then reset the manager database
            $GLOBALS['select_table'] = "manager_table";

            $find_already2 = "DELETE FROM user_otp WHERE email_address='$useremail'";
            $run2 = mysqli_query($conn,$find_already2);

            //create a random 4 digit otp
            $OTP = rand(1000,9999);
            echo "<br>".$OTP." is your otp";
            
            //Now let's encrypt the OTP
            $OTP_hash = password_hash($OTP,PASSWORD_BCRYPT);
            
            //get time in bytes
            $current_time = time();
            echo $current_time;
            $otp_expire_time = $current_time + 60; #expire after 1min
            #echo "<br>".$otp_expire_time;
            //add this hash to the database
            $sql = "INSERT INTO `user_otp` (`email_address`, `otp`,`otp_expire_time`) VALUES ('$useremail', '$OTP_hash','$otp_expire_time')";
            $add_hash = mysqli_query($conn,$sql);

            #echo mysqli_error($conn);
            if ($add_hash) {
                echo "added to the db";
                session_start();
                $_SESSION['otp_of_manager'] = $useremail;
                
            }else{
                echo "failed execution.";
            }
            /*
            //Now send mail to the respected user
            $to = $useremail;
            $subject = "Password Reset Request For SWIFT BANK Account";
            $message = $OTP." is your OTP. Don't share this OTP with anyone. We have received your password reset request.[  $OTP ] Enter this OTP and reset your password. Thank you! Team Swift Bank.";
            $header = "From: viveknimbolkar.educationhost.cloud";

            //now send a mail
            $send_mail_check = mail($to,$subject,$message,$header);

            if ($send_mail_check) {
                echo "<script>alert('Check you email address for OTP!'); window.location.href = 'verify.php'</script>";
            }else{
                "<script>alert('Something went wrong! Please try again.') </script>";
            }
*/

        }else{
            #if email is not found in both of the database then alert user
            echo "<script>alert('Email Not Found! Please enter correct email.'); </script>";
        }
    }else{
        #if there was a problem in connection
       echo "<script>alert('Something Went Wrong.Please try again later!'); </script>";
    }
   
    
}#end of send isset

if (isset($_POST['verifyOTP'])) {

    $userotp = $_POST['enteredotp'];
    session_start();

    //SELECT THE EMAIL ADDRESS AND OTP
    $sql = "SELECT * FROM user_otp WHERE email_address='$useremail' LIMIT 1";
    $find_otp = mysqli_query($conn,$sql);
    $otp_result = mysqli_fetch_assoc($find_otp);

    //if email is found
    if ($otp_result['email_address'] == $GLOBALS['useremail']) {
        echo "address found";

        $cur_time = time();
        #echo $cur_time;
        //if otp is expired after 1min
        if ($otp_result['otp_expire_time'] < $cur_time ) {

            echo "This otp is expired!";

        }else{
                //if otp is not expired
                //check the otp hash
            $check_otp = password_verify($userotp,$otp_result['otp']);

            if ($check_otp) {
                //if otp is match
                #echo "password matched";
                header("location: confirm-password.php");

            }else{
                //if otp is not match
                echo "Incorrect OTP!";
            }
        }

    }else{
        echo "address not found";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
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