<?php

  require("../backend/helpme.php");
  checkLogin();
  require("../backend/connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <!-- Favicons -->
    <link href="assets/img/favicon.svg" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">

    <title>Swift Bank | Analytics</title>

    <style>
        #number-dashboard i{
            opacity: 0.6;
        }
        
        #box-1,#box-2,#box-3,#box-4{
           border-radius: 5px;
        }
        #box-1{
            background-color: #17a2b8;
        }
        #box-2{
            background-color: #28a745;
        }
        #box-3{
            background-color: #ffc107;
        }
        span{
          font-size: 40px;
          
        }

    </style>
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
          <li><a class="nav-link scrollto " href="../manager/manager-dashboard.php">Home</a></li>
          <li><a class="nav-link scrollto" href="customer-list.php">Show Customers</a></li>
          <li><a class="nav-link scrollto" href="employee-list.php">Show Employees</a></li>
          <li><a class="nav-link scrollto " href="manager-analytics.php">Analytics</a></li>
          <li><a class="nav-link scrollto" href="../index.php#team">Team</a></li>
          <li><a class="nav-link scrollto" href="../index.php#contact">Contact</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- #header -->

  <main id="main">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Welcome <?php echo $_SESSION['managername']; ?></h2>
          <a href="../backend/manager-logout.php"><h5>Logout</h5></a>
        </div>

      </div>
    </section><!-- End Breadcrumbs Section -->

    
    <!---Number dashboard------------------------------------------>
    <div class="container mt-5" id="number-dashboard">
        <!---Small box row-->
        <div class="row">

            <!-----No. of Customer-->
            <?php
              $customer_number = "SELECT COUNT(ID) AS customer_no FROM customerdata";
              $result = mysqli_query($conn,$customer_number);

              $final_result = mysqli_fetch_assoc($result);
             
            ?>
            <div id="box-1" class="col-sm-3 text-light p-3">
                   <div class="row">
                       <!---Logo-->
                    <div class="col-sm-6">
                      <center> <i class="fas fa-users fa-3x"></i>
                        <h4>Customer</h4></center>
                    </div>
                    <!--Data-->
                    <div class="col-sm-6 p-2">
                       <center><?php  echo "<span>$final_result[customer_no]</span>"; ?></center>
                    </div>      
                   </div>            
            </div>

            <!-----No. of Employee-->
            <?php

              $customer_number = "SELECT COUNT(ID) AS customer_no FROM employeedata";

              $result = mysqli_query($conn,$customer_number);

              $final_result = mysqli_fetch_assoc($result);
             
            ?>
            <div class="col-sm-1"></div>
            <div id="box-2" class="col-sm-3 text-light p-3">
                <div class="row">
                    <!---Logo-->
                 <div class="col-sm-6">
                   <center> <i class="fas fa-users-cog fa-3x"></i>
                     <h4>Employees</h4></center>
                 </div>
                 <!--Data-->
                 <div class="col-sm-6 p-2">
                    <center> <?php  echo "<span>$final_result[customer_no]</span>"; ?></center>
                 </div>      
                </div>  
            </div>

            <!-----Bank Balance-->
            <?php

              $customer_number = "SELECT SUM(balance) AS customer_no FROM customerdata";

              $result = mysqli_query($conn,$customer_number);

              $final_result = mysqli_fetch_assoc($result);
             
            ?>
            <div class="col-sm-1"></div>
            <div id="box-3" class="col-sm-3 text-dark p-3">
                <div class="row">
                    <!---Logo-->
                 <div class="col-sm-6">
                   <center> <i class="fas fa-rupee-sign fa-3x"></i>
                     <h4>Balance</h4></center>
                 </div>
                 <!--Data-->
                 <div class="col-sm-6 p-2">
                    <center><?php  echo "<span>$final_result[customer_no]</span>"; ?></center>
                 </div>      
                </div>  
            </div>
          
        </div>
    </div>
<hr>
    <!---Charts------------------------------------------------------->
    <div class="row mt-5">

      <!--Represent the gender-->
      <div class="col-sm-4">
        <!--piechart of gender-->
        <div id="piechart" style="width: 600px; height: 500px;"></div>
      </div>
      <!--Extra columns-->
      <div class="col-sm-1"></div>

      <!--Transaction done in past 6 days (column table)-->
      <div class="col-sm-7" >
        <!--Column chart of last 6 days of transcation-->
        <div id="columnchart_material" style="width: 600px; height: 500px;"></div>
      </div>

    </div>
    
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!--Get the gender of customer from database-->
    <?php

    #query for male customer
      $find_male = "SELECT COUNT(ID) AS male_gender FROM customerdata WHERE gender='Male'";
      $male_result = mysqli_query($conn,$find_male);
      $male_data = mysqli_fetch_assoc($male_result);

      #query for female customer
      $find_female = "SELECT COUNT(ID) AS female_gender FROM customerdata WHERE gender='Female'";
      $female_result = mysqli_query($conn,$find_female);
      $female_data = mysqli_fetch_assoc($female_result);



      //Get transaction history of last 6 days======================================================
      #This blocks are use to subtract days from current days. Using this we will get past 6 days.NULL MEANS CURRENT DATE
//Subtract 1 day
$current_date=date_create(NULL);
date_sub($current_date,date_interval_create_from_date_string("1 days"));
$past_one_day = date_format($current_date,"Y-m-d");
#echo $past_one_day."<br>";

//subtract 2 day
$minus_one_date=date_create(NULL);
date_sub($minus_one_date,date_interval_create_from_date_string("2 days"));
$past_two_day = date_format($minus_one_date,"Y-m-d");
#echo $past_two_day."<br>";

//subtract 3 day
$minus_two_date=date_create(NULL);
date_sub($minus_two_date,date_interval_create_from_date_string("3 days"));
$past_three_day = date_format($minus_two_date,"Y-m-d");
#echo $past_three_day."<br>";

//subtract 4 day
$minus_three_date=date_create(NULL);
date_sub($minus_three_date,date_interval_create_from_date_string("4 days"));
$past_four_day = date_format($minus_three_date,"Y-m-d");
#echo $past_four_day."<br>";

 //subtract 5 day
 $minus_four_date=date_create(NULL);
 date_sub($minus_four_date,date_interval_create_from_date_string("5 days"));
$past_five_day = date_format($minus_four_date,"Y-m-d");
#echo $past_five_day."<br>";

//subtract 6 day
$minus_five_date=date_create(NULL);
date_sub($minus_five_date,date_interval_create_from_date_string("6 days"));
$past_six_day = date_format($minus_five_date,"Y-m-d");
#echo $past_six_day."<br>";


//////=======================================================================================================
//get the sum of total fund
#get the sum of past 1 day
$query = "SELECT SUM(transfer_amount) AS trans_amount FROM transaction_history WHERE `date`='$past_one_day'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);
$past_one_day_amount = $row['trans_amount'];
#echo $past_one_day_amount."<br>";

#get the sum of past 1 day
$query = "SELECT SUM(transfer_amount) AS trans_amount FROM transaction_history WHERE `date`='$past_two_day'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);
$past_two_day_amount = $row['trans_amount'];
#echo $past_two_day_amount."<br>";

#get the sum of past 1 day
$query = "SELECT SUM(transfer_amount) AS trans_amount FROM transaction_history WHERE `date`='$past_three_day'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);
$past_three_day_amount = $row['trans_amount'];
#echo $past_three_day_amount."<br>";

#get the sum of past 1 day
$query = "SELECT SUM(transfer_amount) AS trans_amount FROM transaction_history WHERE `date`='$past_four_day'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);
$past_four_day_amount = $row['trans_amount'];
#echo $past_four_day_amount."<br>";

#get the sum of past 1 day
$query = "SELECT SUM(transfer_amount) AS trans_amount FROM transaction_history WHERE `date`='$past_five_day'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);
$past_five_day_amount = $row['trans_amount'];
#echo $past_five_day_amount."<br>";

#get the sum of past 1 day
$query = "SELECT SUM(transfer_amount) AS trans_amount FROM transaction_history WHERE `date`='$past_six_day'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);
$past_six_day_amount = $row['trans_amount'];
#echo $past_six_day_amount."<br>";

      
?>

    

    
    <!----Google chart for gender analysis-->
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Male',  <?php echo $male_data['male_gender']; ?>],
          ['Female',<?php echo $female_data['female_gender']; ?>]
          
        ]);

        var options = {
          title: 'Customer Gender'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
<!---Google chart last 6 days transaction history chart-->
<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Past 7 Days', 'Transaction'],
          ['<?php echo $past_one_day ?>', <?php echo $past_one_day_amount; ?>],
          ['<?php echo $past_two_day ?>', <?php echo $past_two_day_amount; ?>],
          ['<?php echo $past_three_day ?>', <?php echo $past_three_day_amount; ?>],
          ['<?php echo $past_four_day ?>', <?php echo $past_four_day_amount; ?>],
          ['<?php echo $past_five_day ?>', <?php echo $past_five_day_amount; ?>],
          ['<?php echo $past_six_day ?>', <?php echo $past_six_day_amount; ?>]
        ]);

        var options = {
          chart: {
            title: 'Past 7 Days Transaction History',
            subtitle: 'Maximum transaction per day',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
</script>
</body>
</html>