<?php
session_start();
//redirect if already logged in
if ($_SESSION['managername']) {
  header("Location: ../manager/manager-dashboard.php");
}
if (isset($_SESSION['empfname'])) {

  echo "<script>
            alert('Employee is already Logged In!');
            window.location.href='../index.php';   
        </script>";
  
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Swift | Manager Login </title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/login.css">

  <!--offline links-->
  <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.css">

  <style>
      body {
  font-family: "Karla", sans-serif;
  background-color: #fff;
  min-height: 100vh; }

  .brand-wrapper {
    padding-top: 7px;
    padding-bottom: 8px; }
    .brand-wrapper .logo {
      height: 25px; }

  .login-section-wrapper {
    display: -webkit-box;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
            flex-direction: column;
    padding: 68px 100px;
    background-color: #fff; }
    @media (max-width: 991px) {
      .login-section-wrapper {
        padding-left: 50px;
        padding-right: 50px; } }
    @media (max-width: 575px) {
      .login-section-wrapper {
        padding-top: 20px;
        padding-bottom: 20px;
        min-height: 100vh; } }

  .login-wrapper {
    width: 300px;
    max-width: 100%;
    padding-top: 24px;
    padding-bottom: 24px; }
    @media (max-width: 575px) {
      .login-wrapper {
        width: 100%; } }
    .login-wrapper label {
      font-size: 14px;
      font-weight: bold;
      color: #b0adad; }
    .login-wrapper .form-control {
      border: none;
      border-bottom: 1px solid #e7e7e7;
      border-radius: 0;
      padding: 9px 5px;
      min-height: 40px;
      font-size: 18px;
      font-weight: normal; }
      .login-wrapper .form-control::-webkit-input-placeholder {
        color: #b0adad; }
      .login-wrapper .form-control::-moz-placeholder {
        color: #b0adad; }
      .login-wrapper .form-control:-ms-input-placeholder {
        color: #b0adad; }
      .login-wrapper .form-control::-ms-input-placeholder {
        color: #b0adad; }
      .login-wrapper .form-control::placeholder {
        color: #b0adad; }
    .login-wrapper .login-btn {
      padding: 13px 20px;
      background-color: #009df8;
      border-radius: 0;
      font-size: 20px;
      font-weight: bold;
      color: #fff;
      margin-bottom: 14px; }
      .login-wrapper .login-btn:hover {
        border: 1px solid #009df8;
        background-color: #fff;
        color: black; }
    .login-wrapper a.forgot-password-link {
      color: #080808;
      font-size: 14px;
      text-decoration: underline;
      display: inline-block;
      margin-bottom: 54px; }
      @media (max-width: 575px) {
        .login-wrapper a.forgot-password-link {
          margin-bottom: 16px; } }
    .login-wrapper-footer-text {
      font-size: 16px;
      color: #000;
      margin-bottom: 0; }

  .login-title {
    font-size: 30px;
    color: #000;
    font-weight: bold;
    margin-bottom: 25px; }

  .login-img {
    width: 100%;
    height: 100vh;
    -o-object-fit: cover;
      object-fit: cover;
    -o-object-position: left;
      object-position: left; }

  /*# sourceMappingURL=login.css.map */

  </style>
</head>
<body>
    <nav style="width: 100%; background-color: #009df8; height: 10vh; color: white; padding:10px 10px 10px 10px;"> <center><h2>Swift Bank Login</h2></center></nav>
  <main>
    <div class="container-fluid">
      <div class="row">
          <div class="col-sm-4"></div>
        <div class="col-sm-5 login-section-wrapper">
          <div class="login-wrapper my-auto">
            <h1 class="login-title">Welcome Manager!</h1>
            <p>Please login to continue...</p>
            <form action="../backend/authenticate.php" method="post">
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="email@example.com">
              </div>
              <div class="form-group mb-4">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="enter your passsword">
              </div>
              <div class="g-recaptcha" data-sitekey="6LdJ7KsaAAAAADktI0pN2xrxKECOVhYr7B3DKOhg"></div>
              <input name="managerlogin" id="login" class="btn btn-block login-btn" type="submit" value="Login">
            </form>
            <a href="../resetpassword/reset-manager-password.php" class="forgot-password-link">Forgot password?</a>
          </div>
        </div>
        <div class="col-sm-3">
           <img src="/assets/img/bankside.jpg" class="img-fluid" alt="">
        </div>

      </div>
    </div>
  </main>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

  <script src="../assets/vendor/bootstrap/js/bootstrap.js"></script>
  <script src="../assets/js/jquery.js"></script>
</body>
</html>
