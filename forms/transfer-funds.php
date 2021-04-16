<?php

require("../backend/helpme.php");
checkLogin();


require("../backend/connection.php");

if (isset($_POST['transferfund'])) {
    
    $from_account_num = $_POST['fromaccount'];
    $to_account_num = $_POST['toaccount'];
    $transfer_amount = $_POST['amount'];

//search for account existance and balance
    $search = "SELECT * FROM `customerdata` WHERE account_no='$from_account_num' LIMIT 1";

    $search_result = mysqli_query($conn,$search);

    $row = mysqli_num_rows($search_result);

    $result = mysqli_fetch_assoc($search_result);
    
    #if account is found
    if ($row > 0) {

        #echo "account found";
        //Check for insufficient balance or 0 balance
        if (($result['balance'] == 0) OR ($result['balance'] <= $transfer_amount)) {
            
            echo "<script> alert('Insufficient Balance!'); </script>";
            redirectPage();

            /*
            //REDIRECT TO THE RESPECTED DASHBOARD IS SESSION ARE SET
            if (isset($_SESSION['managername'])) {
                #REDIRECT TO manager DASHBOARD
                echo "<script>
                        window.location.href='../manager/manager-dashboard.php';
                    </script>";
                
            }elseif (isset($_SESSION['empfname'])) {
                #REDIRECT TO employee DASHBOARD
                echo "<script>
                        window.location.href='../employee/employee-dashboard.php';
                    </script>";
                
            }*/
            
        }else {
            #Send if sufficient money is present
            #echo "<br>Transferred";

            $find_to_account = "SELECT * FROM `customerdata` WHERE account_no='$to_account_num' LIMIT 1"; 
            
            $search_acc = mysqli_query($conn,$find_to_account);

            $to_result = mysqli_fetch_assoc($search_acc);

            #if we get values successfully
            if ($to_result) {

                #adding money
                $total_amount_after_add = $to_result['balance'] + $transfer_amount;

                #echo "<br>total amount $total_amount_after_add";
                 #funds are added query
                 $add_fund = "UPDATE customerdata SET balance='$total_amount_after_add' WHERE account_no='$to_account_num'";
                 #echo "<br>".$add_fund;
                 $done_adding_fund = mysqli_query($conn,$add_fund);

                #subtracting money
                $total_amount_after_subtract = $result['balance'] - $transfer_amount;
                #funds are subtracted query
                $subtract_fund = "UPDATE customerdata SET balance='$total_amount_after_subtract' WHERE account_no='$from_account_num'";
                #echo "<br>".$subtract_fund;
                $done_subtracting_fund = mysqli_query($conn,$subtract_fund);

                //ADD RECORD TO THE TRANSACTION HISTORY TABLE
                $current_time = date("Y-m-d");
                
                $add_trans_record = "INSERT INTO `transaction_history` (`from_account`, `to_account`, `transfer_amount`, `date`) VALUES ('$from_account_num', '$to_account_num', '$transfer_amount', '$current_time')";
                
                mysqli_query($conn,$add_trans_record);


                //IF FUND ADDED SUCCESSFULLY
                if ($done_adding_fund && $done_subtracting_fund) {

                    echo "<script> alert('Fund Transfered Successfully!'); </script>";

                    redirectPage();
                    //REDIRECT TO THE RESPECTED DASHBOARD IS SESSION ARE SET
                    /*if (isset($_SESSION['managername'])) {
                        #REDIRECT TO manager DASHBOARD
                        echo "<script>
                                window.location.href='../manager/manager-dashboard.php';
                              </script>";
                        
                    }elseif (isset($_SESSION['empfname'])) {
                        #REDIRECT TO employee DASHBOARD
                        echo "<script>
                                window.location.href='../employee/employee-dashboard.php';
                             </script>";
                        
                    }*/
                   

                }else{
                    echo "<script>alert('Fund Transfered Failed!');</script>";
                    redirectPage();
                }
            }
            

        }

    }else{#if account is not found

        echo "<script>alert('Customer Not Found!');</script>";
        redirectPage();
    }

}//end of submit button




//REDIRECT FUNCTION FOR EMPLOYEE AND MANAGER
//tHIS IS SPECIALLY MADE FOR SECURITY PURPOSE
/*
function redirectPage(){
    
    if (isset($_SESSION['empfname'])) {
        echo "<script> window.location.href='../employee/employee-dashboard.php'; </script>";
    }elseif (isset($_SESSION['managername'])) {
        echo "<script> window.location.href='../manager/manager-dashboard.php'; </script>";
    }
}*/











?>