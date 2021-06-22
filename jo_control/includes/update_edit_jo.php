<?php
    
 include('../config/db_config.php');
   if (isset($_POST['update'])) {

      
        $job_no = $_POST['job_no'];  
         $jo_amount = $_POST ['jo_amount'];
         $job_prev = $_POST['job_prev'];
         $jo_balance = $_POST['jo_balance'];
        $job_date = $_POST['job_date'];
        $job_charge = $_POST['job_charge'];
        $job_schedules = $_POST['job_schedules'];

    
    // check if travelno number is available to avoid duplciation
    $sql ="UPDATE jo_details SET 
             Amount                  = '$jo_amount',
             PrevBal                 = '$job_prev',
            Balance                 = '$jo_balance',
            DateJo                  = '$job_date',
            Charge                  = '$job_charge',
            Schedules                  = '$job_schedules'


        WHERE   JobOrderNo = '$job_no' 

     ";
            
    if($con->query($sql)){
             $alert_msg .= '<div class="alert alert-success alert-dismissible"><i class="icon fa fa-check"></i>Successfully Updated</div>';

    $btnAdd = 'disabled';
    $btnStatus = 'disabled';
     $btnNew = 'enabled';
    }
        else{
            $_SESSION['error'] = $con->error;
        }
    }
    else{
        $_SESSION['error'] = 'Fill up edit form first';
    }

  
?>
