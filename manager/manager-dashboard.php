<?php
/*
session_start();

if (!isset($_SESSION['managername'])) {
  header("location: ../forms/manager-login.php");
}*/

require_once("../backend/helpme.php");
checkLogin();

require_once("../backend/connection.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Swift | Employee</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

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



<!-----Account Details Section---->
    <section class="inner-page pt-4 m-5">
      <center><h2><b>Customer Details</b></h2></center>
      <div class="container">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Account Details</button>
              </li>
              
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Transfer Funds</button>
              </li>
              <!--
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Temp tab</button>
              </li> --->
          </ul>
          <div class="tab-content" id="myTabContent">
              <!--Account details-->
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                  <!---Customer related section--->
                  <div class="d-flex align-items-start mt-5">
                        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Find Customer</button>
                                <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Add Customer</buttona>
                                <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Remove Customer</button>
                        </div>
                        <div class="tab-content" id="v-pills-tabContent">
                                <!--Find customer-->
                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                  <center><h2>Find Account Details</h2></center>
                                  <form action="" method="post">
                                    <div class="input-group input-group-lg mb-3">
                                      <input type="number" class="form-control" name="accountnum" placeholder="Enter Account Number" aria-label="Recipient's username" aria-describedby="button-addon2">
                                      <button class="btn btn-outline-secondary" name="findcustomer" type="submit" id="button-addon2">Find Details</button>
                                    </div>
                                  </form>  
                                    <?php
                                        if (isset($_POST['findcustomer'])) {
                                         
                                           $query = "SELECT * FROM `customerdata` WHERE account_no='$_POST[accountnum]'";
                                           $result = mysqli_query($conn,$query);

                                           while ($row = mysqli_fetch_assoc($result)) {
                                            
                                           
                                    ?>
                                    <form class="row g-3 m-4" id="printCustomerDetail">
                                    <center><h3>Customer Detail's</h3></center>
                                    <table class="table table-striped mb-5" >
                                            <thead>
                                              <tr>
                                                <th scope="col">Sr.no</th>
                                                <th scope="col">Parameters</th>
                                                <th scope="col">Details</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <tr>
                                                <th scope="row">1</th>
                                                <td>Account Holder Name</td>
                                                <td><?php echo "$row[first_name] $row[father_name] $row[last_name]"; ?></td>
                                              </tr>
                                              <tr>
                                                <th scope="row">2</th>
                                                <td>Account Number</td>
                                                <td><?php echo "$row[account_no]"; ?></td>   
                                              </tr>
                                              <tr>
                                                <th scope="row">3</th>
                                                <td>Email</td>
                                                <td><?php echo "$row[email_address]"; ?></td>   
                                              </tr>
                                              <tr>
                                                <th scope="row">4</th>
                                                <td>Mobile</td>
                                                <td><?php echo "$row[mobile_no]"; ?></td>   
                                              </tr>
                                              <tr>
                                                <th scope="row">5</th>
                                                <td>City</td>
                                                <td><?php echo "$row[city]"; ?></td>   
                                              </tr>
                                              <tr>
                                                <th scope="row">6</th>
                                                <td>Taluka</td>
                                                <td><?php echo "$row[taluka]"; ?></td>   
                                              </tr>
                                              <tr>
                                                <th scope="row">7</th>
                                                <td>District</td>
                                                <td><?php echo "$row[district]"; ?></td>   
                                              </tr>
                                              <tr>
                                                <th scope="row">8</th>
                                                <td>State</td>
                                                <td><?php echo "$row[state]"; ?></td>   
                                              </tr>
                                              <tr>
                                                <th scope="row">9</th>
                                                <td>Pincode</td>
                                                <td><?php echo "$row[pincode]"; ?></td>   
                                              </tr>
                                              <tr>
                                                <th scope="row">10</th>
                                                <td>Address</td>
                                                <td><?php echo "$row[address]"; ?></td>   
                                              </tr>
                                              
                                            </tbody>
                                          </table>
                                          <div class="input-group justify-content-center">
                                            <button class="btn btn-outline-danger d-grid gap-2 col-4 mx-auto" type="button" onclick="printDiv('printCustomerDetail')" > Print</button>
                                          </div>
                                    </form>   
                                    <?php
                                    }
                                  }
                                    ?>
                                </div>


                                <!--add customer-->
                                <div class="tab-pane fade mb-5" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                        <center><h2>Add New Customer</h2></center>

                                        <form class="row g-3" method="post" action="../forms/add-customer.php">
                                              <div class="col-md-4">
                                                  <label class="form-label">Firstname</label>
                                                  <input type="text" name="firstname" class="form-control" required>
                                              </div>
                                              <div class="col-md-4">
                                                  <label for="inputEmail4" class="form-label">Fathername</label>
                                                  <input type="text" name="fathername" class="form-control" required>
                                              </div>
                                              <div class="col-md-4">
                                                  <label for="inputEmail4" class="form-label">Lastname</label>
                                                  <input type="text" name="lastname" class="form-control" required>
                                              </div>
                                              <div class="col-md-4">
                                                  <label for="inputEmail4" class="form-label">Email</label>
                                                  <input type="email" name="emailaddress" class="form-control" required>
                                              </div>
                                              <div class="col-md-4">
                                                  <label for="inputEmail4" class="form-label">Mobile</label>
                                                  <input type="text" name="mobileno" class="form-control" required>
                                              </div>
                                              <div class="col-md-4">
                                                  <label for="inputEmail4" class="form-label">Aadhar Number</label>
                                                  <input type="number" name="aadharno" class="form-control" required>
                                              </div>
                                              <div class="col-md-4">
                                                  <label for="inputEmail4" class="form-label">Balance</label>
                                                  <input type="number" name="balance" value="200" class="form-control" required>
                                              </div>
                                              <div class="col-md-4">
                                                  <label for="inputEmail4" class="form-label">Account Number(Do not edit))</label>
                                                  <input type="number" name="accountno"  value="<?php echo rand();  ?>" class="form-control" >
                                              </div>
                                              <div class="col-md-4">
                                                  <label for="inputEmail4" class="form-label">Date of Birth</label>
                                                  <input type="date" id="date" name="dob"  class="form-control" onfocusout="calculateAge()" required>
                                              </div>
                                             
                                              <div class="col-md-4">
                                                  <label for="inputEmail4" class="form-label">City</label>
                                                  <input type="text" name="city"  class="form-control" required>
                                              </div>
                                              <div class="col-md-4">
                                                  <label for="inputEmail4" class="form-label">Taluka</label>
                                                  <input type="text" name="taluka" class="form-control" required>
                                              </div>
                                              <div class="col-md-4">
                                                  <label for="inputEmail4" class="form-label">District</label>
                                                  <input type="text" name="district" class="form-control" required>
                                              </div>
                                              <div class="col-md-4">
                                                  <label for="inputEmail4" class="form-label">Permanent Address</label>
                                                  <input type="text" name="address" class="form-control" required>
                                              </div>
                                              <div class="col-md-4">
                                                  <label for="inputEmail4" class="form-label">Pincode</label>
                                                  <input type="number" name="pincode"  class="form-control" required>
                                              </div>
                                              <div class="col-md-4">
                                                <label for="inputEmail4" class="form-label" required>Select state</label>
                                                  <select class="form-select" name="state" aria-label="Default select example">
                                                        <option selected>Select State</option>
                                                        <option value="Andhra Pradesh">Andhra Pradesh</option>
                                                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                        <option value="Assam">Assam</option>
                                                        <option value="Bihar">Bihar</option>
                                                        <option value="Chhattisgarh">Chhattisgarh</option>
                                                        <option value="Goa">Goa</option>
                                                        <option value="Gujarat">Gujarat</option>
                                                        <option value="Haryana">Haryana</option>
                                                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                        <option value="Jharkhand">Jharkhand</option>
                                                        <option value="Karnataka">Karnataka</option>
                                                        <option value="Kerala">Kerala</option>
                                                        <option value="Madhya Pradesh">Madhya Pradesh</option>
                                                        <option value="Maharashtra">Maharashtra</option>
                                                        <option value="Manipur">Manipur</option>
                                                        <option value="Meghalaya">Meghalaya</option>
                                                        <option value="Mizoram">Mizoram</option>
                                                        <option value="Nagaland">Nagaland</option> 
                                                        <option value="Odisha">Odisha</option>
                                                        <option value="Punjab">Punjab</option>
                                                        <option value="Rajasthan">Rajasthan</option>
                                                        <option value="Sikkim">Sikkim</option>
                                                        <option value="Tamil Nadu">Tamil Nadu</option>
                                                        <option value="Telangana">Telangana</option>
                                                        <option value="Tripura">Tripura</option>
                                                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                        <option value="Uttarakhand">Uttarakhand</option>
                                                        <option value="West Bengal">West Bengal</option>
                                                  </select>
                                              </div> 
                                              <div class="col-md-4">
                                                  <div class="form-check">
                                                        <input class="form-check-input" type="radio" value="Male" name="flexRadioDefault" id="flexRadioDefault1">
                                                        <label class="form-check-label" for="flexRadioDefault1">Male</label>
                                                  </div>
                                                  <div class="form-check">
                                                        <input class="form-check-input" type="radio" value="Female" name="flexRadioDefault" id="flexRadioDefault1">
                                                        <label class="form-check-label" for="flexRadioDefault1">Female</label>
                                                  </div>
                                              </div>
                                              <div class="col-md-4">
                                                  <input type="submit" name="addcustomer" class="form-control btn btn-success btn-lg">
                                              </div>
                                              <div class="col-md-4">                                                
                                                  <input type="reset" class="form-control btn btn-outline-danger btn-lg">
                                              </div>
                                        </form>      
                                
                                
                                </div>


                                <!--remove customer-->
                                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                      <center><h2><b>Remove Customer</b></h2></center>
                                      <form action="" method="post">
                                          <div class="input-group mb-3">
                                              <input type="text" class="form-control" placeholder="Account Number" name="accnum" aria-label="Recipient's username" aria-describedby="button-addon2">
                                              <button class="btn btn-outline-danger" name="removeC" type="submit" id="button-addon2">Remove Customer</button>
                                          </div>
                                      </form>  
                                      <?php
                                          if (isset($_POST['removeC'])) {
                                            $query = "DELETE FROM `customerdata` WHERE account_no='$_POST[accnum]' LIMIT 1";
                                            $result = mysqli_query($conn,$query);
                                          }
                                      ?>
                                    
                                </div>

                        </div>
                      </div>
              </div>


            <!----------Transter funds section-->
              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  <center>
                        <h3 class="m-5">Transfer Funds</h3>
                  </center>      
                        <!-------Transfer funds form---->
                  <form action="../forms/transfer-funds.php" method="post">
                            <div class="row">
                                  <div class="col-sm-4">
                                      <div class="input-group input-group-lg">
                                            <span class="input-group-text" id="inputGroup-sizing-lg">From</span>
                                            <input type="number" name="fromaccount" class="form-control" aria-label="Sizing example input" required aria-describedby="inputGroup-sizing-lg">
                                      </div>
                                  </div>
                                  <div class="col-sm-4">
                                      <div class="input-group input-group-lg">
                                            <span class="input-group-text" id="inputGroup-sizing-lg">To</span>
                                            <input type="number" name="toaccount" class="form-control" aria-label="Sizing example input" required aria-describedby="inputGroup-sizing-lg">
                                      </div>
                                  </div>
                                  <div class="col-sm-4">
                                      <div class="input-group input-group-lg">
                                            <input type="number" name="amount" placeholder="Enter amount" class="form-control" aria-label="Sizing example input" required aria-describedby="inputGroup-sizing-lg">
                                      </div>
                                  </div>
                                  <div class="col-sm-4"> </div>
                                  <div class="col-sm-4 mt-4 d-flex justify-content-center">
                                  <i class="fas fa-paper-plane"></i>
                                      <input type="submit" name="transferfund" class="btn btn-primary btn-lg" value="Transfer Funds">
                                  </div>
                            </div>                              
                    </form>

                  
              </div>


             <!--- Empolyee details
              Temp details
              <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                Temperary
              </div>
              -->
          </div>
      </div>
    </section>


<hr>
<!--==============================================================================================-->
<!-------empolyee details section-->
   <section style="height:110vh;">
   
      <div class="row">
                                          <center><h2><b>Employee Details</b></h2></center>
          <div class="col-sm-1"></div>
                    
                <div class="col-sm-10">
                      <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
                          <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Find Employee</button>
                          </li>
                          <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Add Employee</button>
                          </li>
                          <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Remove Employee</button>
                          </li>
                      </ul>
                      <div class="tab-content" id="pills-tabContent">
                          
                          <!------Find Employee details-->
                          <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                              <form action="" method="post" >
                                  <div class="input-group input-group-lg m-3 ">
                                        <input type="text" name="employeeid" class="form-control" placeholder="Enter Employee ID" aria-label="Recipient's username" aria-describedby="button-addon2">
                                        <button name="findemployee" class="btn btn-outline-secondary" type="submit" id="button-addon2">Find Details</button>
                                  </div>
                              </form>
                              <?php

                                  if (isset($_POST['findemployee'])) {
                                    
                                    $query="SELECT * FROM `employeedata` WHERE emp_id='$_POST[employeeid]' LIMIT 1";
                                    $result = mysqli_query($conn,$query);

                                    while ($row = mysqli_fetch_assoc($result)) {
                                    
                              ?>
                            <form class="row g-3 m-5" id="printInfo">
                            <center><h4>Employee Details</h4></center>
                              <table class="table table-striped">
                                  <thead>
                                      <tr>
                                        <th scope="col">Sr. no</th>
                                        <th scope="col">Parameters</th>
                                        <th scope="col">Details</th>
                                       
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr>
                                        <th scope="row">1</th>
                                        <td>Employee Name</td>
                                        <td><?php echo "$row[first_name] $row[father_name] $row[last_name]"; ?></td>
                                        
                                      </tr>
                                      <tr>
                                        <th scope="row">2</th>
                                        <td>Employee ID</td>
                                        <td><?php echo "$row[emp_id]" ?></td>
                                        
                                      </tr>
                                      <tr>
                                        <th scope="row">3</th>
                                        <td>Email address</td>
                                        <td><?php echo "$row[email_address]" ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">4</th>
                                        <td>Mobile No</td>
                                        <td><?php echo "$row[mobile_no]" ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">5</th>
                                        <td>Aadhar no</td>
                                        <td><?php echo "$row[aadhar_no]" ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">6</th>
                                        <td>Address</td>
                                        <td><?php echo "$row[address]" ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">7</th>
                                        <td>Qualification</td>
                                        <td><?php echo "$row[qualification]" ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">8</th>
                                        <td>City</td>
                                        <td><?php echo "$row[city]" ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">9</th>
                                        <td>Taluka</td>
                                        <td><?php echo "$row[taluka]" ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">10</th>
                                        <td>District</td>
                                        <td><?php echo "$row[district]" ?></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">11</th>
                                        <td>State</td>
                                        <td><?php echo "$row[state]" ?></td>
                                      </tr>
                                  </tbody>
                                </table>
                              </form>  
                              <div class="input-group justify-content-center">
                                <button class="btn btn-outline-danger d-grid gap-2 col-4 mx-auto" type="button" onclick="printDiv('printInfo')" > Print</button>
                              </div>
                                <?php
                                     }
                                    }
                                ?>
                          </div>
                           <!------add Employee details-->
                          <div class="tab-pane fade m-5" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <center><h3>Add New Employee</h3></center>
                                    <form class="row g-3" method="post" action="../forms/add-employee.php">
                                          <div class="col-md-4">
                                            <label class="form-label">Firstname</label>
                                            <input type="text" name="firstname" class="form-control" required>
                                          </div>
                                          <div class="col-md-4">
                                            <label class="form-label">Fathername</label>
                                            <input type="text" name="fathername" class="form-control" required>
                                          </div>
                                          <div class="col-md-4">
                                            <label class="form-label">Lastname</label>
                                            <input type="text" name="lastname" class="form-control" required>
                                          </div>
                                          <div class="col-md-4">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="emailaddr" class="form-control" required>
                                          </div>
                                          <div class="col-md-4">
                                            <label class="form-label">Password</label>
                                            <input type="password" name="pwd1" class="form-control" required>
                                          </div>
                                          <div class="col-md-4">
                                            <label class="form-label">Confirm Password</label>
                                            <input type="password" name="pwd2" class="form-control" required>
                                          </div>
                                          <div class="col-md-4">
                                            <label class="form-label">Mobile</label>
                                            <input type="number" name="mobileno" class="form-control" required>
                                          </div>
                                          <div class="col-md-4">
                                            <label class="form-label">Aadhar Number</label>
                                            <input type="number" name="aadharno" class="form-control" required>
                                          </div>
                                          <div class="col-md-4">
                                            <label class="form-label">Employee ID(Don't Edit)</label>
                                            <input type="number" name="empid" value="<?php echo rand(1000,9999);?>"  class="form-control" required>
                                          </div>
                                          <div class="col-md-4">
                                            <label class="form-label">Date of birth</label>
                                            <input type="date" name="dob" class="form-control" required>
                                          </div>
                                          <div class="col-md-4">
                                            <label class="form-label">Qualification</label>
                                            <input type="text" name="qualification" class="form-control" required>
                                          </div>
                                          <div class="col-md-4">
                                            <label class="form-label">Address</label>
                                            <input type="text" name="address" class="form-control" required>
                                          </div>
                                          <div class="col-md-4">
                                            <label class="form-label">City</label>
                                            <input type="text" name="city" class="form-control" required>
                                          </div>
                                          <div class="col-md-4">
                                            <label class="form-label">Taluka</label>
                                            <input type="text" name="taluka" class="form-control" required>
                                          </div>
                                          <div class="col-md-4">
                                            <label class="form-label">District</label>
                                            <input type="text" name="district" class="form-control" required>
                                          </div>
                                          <div class="col-md-4">
                                               
                                                  <select class="form-select" name="state" aria-label="Default select example" required>
                                                        <option selected>Select State</option>
                                                        <option value="Andhra Pradesh">Andhra Pradesh</option>
                                                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                        <option value="Assam">Assam</option>
                                                        <option value="Bihar">Bihar</option>
                                                        <option value="Chhattisgarh">Chhattisgarh</option>
                                                        <option value="Goa">Goa</option>
                                                        <option value="Gujarat">Gujarat</option>
                                                        <option value="Haryana">Haryana</option>
                                                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                        <option value="Jharkhand">Jharkhand</option>
                                                        <option value="Karnataka">Karnataka</option>
                                                        <option value="Kerala">Kerala</option>
                                                        <option value="Madhya Pradesh">Madhya Pradesh</option>
                                                        <option value="Maharashtra">Maharashtra</option>
                                                        <option value="Manipur">Manipur</option>
                                                        <option value="Meghalaya">Meghalaya</option>
                                                        <option value="Mizoram">Mizoram</option>
                                                        <option value="Nagaland">Nagaland</option> 
                                                        <option value="Odisha">Odisha</option>
                                                        <option value="Punjab">Punjab</option>
                                                        <option value="Rajasthan">Rajasthan</option>
                                                        <option value="Sikkim">Sikkim</option>
                                                        <option value="Tamil Nadu">Tamil Nadu</option>
                                                        <option value="Telangana">Telangana</option>
                                                        <option value="Tripura">Tripura</option>
                                                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                        <option value="Uttarakhand">Uttarakhand</option>
                                                        <option value="West Bengal">West Bengal</option>
                                                  </select>
                                              </div> 
                                              <div class="col-md-4">
                                                  <input type="submit" name="addemp" class="form-control btn btn-success btn-lg">
                                              </div>
                                              <div class="col-md-4">                                                
                                                  <input type="reset" class="form-control btn btn-outline-danger btn-lg">
                                              </div>
                                    </form>      
                          
                          </div>
                           <!------remove Employee details-->
                          <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <form action="" method="post">
                            <div class="input-group input-group-lg mb-3 ">
                                <input type="text" class="form-control" name="empid" placeholder="Enter Employee ID" aria-describedby="button-addon2">
                                <button class="btn btn-outline-danger" type="submit" name="removeemp" id="button-addon2">Remove Employee</button>
                            </div>
                        </form>
                        <?php
                                          if (isset($_POST['removeemp'])) {
                                            $query = "DELETE FROM `employeedata` WHERE emp_id='$_POST[empid]' LIMIT 1";
                                            $result = mysqli_query($conn,$query);
                                          }
                                      ?>
                          </div>
                      </div>
                </div>  
                
          <div class="col-sm-1"></div>                          
          
      </div>
                                          
   </section>

                                   
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/aos/aos.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="../assets/vendor/purecounter/purecounter.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>
<script>

  function calculateAge(){
  
    var userinput = document.getElementById("date").value;
    var dob = new Date(userinput);
    
    //calculate month difference from current date in time
    var month_diff = Date.now() - dob.getTime();
    
    //convert the calculated difference in date format
    var age_dt = new Date(month_diff); 
    
    //extract year from date    
    var year = age_dt.getUTCFullYear();
    
    //now calculate the age of the user
    var age = Math.abs(year - 1970);
    
    //display the calculated age
   document.getElementById("age").value=age;
    }

</script>
 <!---------Print btn for employee----->
    <script>
        function printDiv(printInfo) {
            var printContents = document.getElementById("printInfo").innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
          }
    </script>
      <!---Print btn for customer---->
    <script>
        function printDiv(printCustomerDetail) {
            var printContents = document.getElementById("printCustomerDetail").innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
          }
    </script>
 
</body>

</html>