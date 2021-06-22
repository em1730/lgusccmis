<?php
  include('../config/db_config.php');

  $alert_msg = '';     
  

  if (isset($_POST['insert'])) {


    $job_no = $_POST['job_no'];
    $jo_laborers = $_POST['jo_laborers'];
    $jo_amount = $_POST ['jo_amount'];
    $job_prev = $_POST['job_prev'];
    $jo_balance = $_POST['jo_balance'];
        $job_date = $_POST['job_date'];
        $job_charge = $_POST['job_charge'];
        $job_schedules = $_POST['job_schedules'];
  

      
    $insert_job_order_sql  = "INSERT INTO jo_details SET 
             JobOrderNo               = :job_no,
            Laborers                = :jo_laborers,
             Amount                  = :jo_amount,
             PrevBal                 = :job_prev,
            Balance                 = :jo_balance,
            DateJo                  = :job_date,
            Charge                  = :job_charge,
            Schedules                  = :job_schedules
        ";

  $sql ="UPDATE project SET Balance   = '$jo_balance'
        WHERE   Charges               = '$job_charge'  
     ";

      $job_order_data = $con->prepare($insert_job_order_sql);
      $job_order_data->execute([
        ':job_no'             => $job_no,
        ':jo_laborers'           => $jo_laborers,
        ':jo_amount'       => $jo_amount,
       ':job_prev'           => $job_prev,
        ':jo_balance'       => $jo_balance,
        ':job_date'           => $job_date,
        ':job_charge'         => $job_charge,
        ':job_schedules'         => $job_schedules

             ]);

 if($con->query($sql)){
      $alert_msg .= ' 
          <div class="alert alert-success alert-dismissible">
              <i class="icon fa fa-success"></i>
             Completed!
          </div>     
      ';
     // $fname = $mname = $lname = $contact_number = $email = $uname = $upass = '';

     $btnStatus = 'disabled';
     $btnNew = 'enabled';
     $btnAdd = 'disabled';
   }
        else{
            $_SESSION['error'] = $con->error;
        }
    }
    else{
        $_SESSION['error'] = 'Fill up edit form first';
    }
 
?>


 
