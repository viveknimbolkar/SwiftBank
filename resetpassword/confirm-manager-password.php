<?php

session_start();
//check if he is directly accessing this page or not
if (!(isset($_SESSION['otp_of_manager']))) {
    
    header("location: ../index.php");
}

require("../backend/connection.php");

if (isset($_POST['submit'])) {
   
    $pwd1 = mysqli_real_escape_string($conn,$_POST['pwd1']);
    $pwd2 = mysqli_real_escape_string($conn,$_POST['pwd2']);

    $check_pwd = strcmp($pwd1,$pwd2);

    if ($check_pwd == 0) {
        //if password match
        #echo $select_table;
        $manager_mail = $_SESSION['otp_of_manager'];
        #echo $emp_mail;
        
        $sql = "UPDATE manager SET pass='$pwd2' WHERE email='$manager_mail' LIMIT 1";
        $change_pwd = mysqli_query($conn,$sql);

        if ($change_pwd) {
            // if pwd change successfully.
            echo "<script>alert('Password Has Been Changed Successfuly!'); </script>";
            
            session_destroy();
            header("location: ../forms/manager-login.php");
        }else{

            echo "<script>alert('Something went wrong! Please try again.'); </script>";
        }
    }else{

        //if password is not matched
        echo "<script>alert('Password dosen't match!'); </script>";
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    
  <!-- Favicons -->
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

    <div class="container">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4" id="mainform">
                <center>
                    <h3>Reset Your Password</h3>
                    <p>Now set your desire password!</p>
                    <form class="row g-3" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                          <input type="password" class="form-control" name="pwd1" placeholder="Enter new password">
                          <input type="password" class="form-control" name="pwd2" placeholder="Confirm your password">
                          <input type="submit" name="submit" value="Change Password" class="btn btn-primary">
                    </form>    
                </center>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
    

    <script src="../assets/vendor/bootstrap/js/bootstrap.js"></script>
</body>
</html>