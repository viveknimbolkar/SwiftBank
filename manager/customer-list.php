<?php

require_once("../backend/helpme.php");
checkLogin();

  require_once("../backend/connection.php");
  /*session_start();
  if (!(isset($_SESSION['managername']) OR isset($_SESSION['empfname']) ) ) {
    header("Location: ../index.php");
  }*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">


  <!-- Favicons -->
  <link href="../assets/img/favicon.svg" rel="icon">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">
    <title>Welcome To Swift Bank</title>
</head>
<body>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center">
      <div class="container d-flex justify-content-between">
  
        <div class="logo">
          
           <h1><a href="../index.php">SWIFT BANK</a></h1> 
          <!--<a href="index.php"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
        </div>
  
        <nav id="navbar" class="navbar">
          <ul>
          <li><a class="nav-link scrollto " href="../index.php">Home</a></li>
          <?php
                if (isset($_SESSION['managername'])) {
            ?>
                 <li><a class="nav-link scrollto" href="manager-dashboard.php">Dashboard</a></li>
            <?php
                }
            ?>
          <?php
            if (isset($_SESSION['empfname'])) {
          ?>
             <li><a class="nav-link scrollto" href="../employee/employee-dashboard.php">Dashboard</a></li>
          <?php
            }
          ?>
            
            <li><a class="nav-link scrollto" href="../index.php#services">Services</a></li>
            <li><a class="nav-link scrollto " href="../index.php#portfolio">Portfolio</a></li>
            <li><a class="nav-link scrollto" href="../index.php#team">Team</a></li>
            <li><a class="nav-link scrollto" href="../backend/logout.php">Logout</a></li>
          </ul>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->
  
      </div>
    </header><!-- #header -->
  
    <div class="row " style="margin-top:10%;">
      <center><h2>Customer's List</h2></center>
      <div class="input-group justify-content-center">
        <button class="btn btn-outline-primary" type="button" onclick="printDiv('PrintData')" > Print</button>
      </div>
      
        <div class="col-sm-12" id="PrintData">
              <!------List of all employee-->
                <table class="table table-striped table-bordered">
                        
                        <thead class="table-info">
                          <tr>
                            <th scope="col">Sr.no</th>
                            <th scope="col">Employee Name</th>
                            <th scope="col">Employee ID</th>
                            <th scope="col">Email</th>
                            <th scope="col">Mobile No</th>
                            <th scope="col">DOB</th>
                            <th scope="col">Aadhar No</th>
                            <th scope="col">Address</th>
                            <th scope="col">City</th>
                            <th scope="col">Taluka</th>
                            <th scope="col">District</th>
                            <th scope="col">State</th>
                          </tr>
                        </thead>
                        <tbody>
                <?php

                require("../backend/connection.php");

                $query = "SELECT * FROM customerdata";
                $result=mysqli_query($conn,$query);
                $i=1;

                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                  
                    
                    
                    
                      <tr>
                        <th scope="row"><?php echo $i++ ;  ?></th>
                        <td><?php echo "$row[first_name] $row[father_name] $row[last_name]" ?></td>
                        <td><?php echo "$row[emp_id]" ?></td>
                        <td><?php echo "$row[email_address]" ?></td>
                        <td><?php echo "$row[mobile_no]" ?></td>
                        <td><?php echo "$row[dob]" ?></td>
                        <td><?php echo "$row[aadhar_no]" ?></td>
                        <td><?php echo "$row[address]" ?></td>
                        <td><?php echo "$row[city]" ?></td>
                        <td><?php echo "$row[taluka]" ?></td>
                        <td><?php echo "$row[district]" ?></td>
                        <td><?php echo "$row[state]" ?></td>
                      </tr><br>
                    
                    
                  <?php
                }
                ?>
                </tbody>
                  </table>
                      
        </div>
    </div>

     <!-- Vendor JS Files -->
  <script src="../assets/vendor/aos/aos.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="../assets/vendor/purecounter/purecounter.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <!---------Download list----->
  <script>
        function printDiv(PrintData) {
            var printContents = document.getElementById("PrintData").innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
          }
      </script>
  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>
</body>
</html>