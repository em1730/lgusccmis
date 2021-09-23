<?php
  include('../config/db_config.php');

  $alert_msg = '';     
  

  if (isset($_POST['insert'])) {


 
    $pay_no = $_POST['pay_no'];
    $jo_no = $_POST['jo_no'];
    $pay_amount = $_POST['pay_amount'];
    $jo_amount = $_POST['jo_amount'];
    $pay_date = date('Y-m-d', strtotime($_POST['pay_date']));
    $prev_balance = $_POST['prev_balance'];
    $proj_charges = $_POST['proj_charges'];
    $id_number = $_POST['id_number'];
    $status = $_POST['status'];
    $amount = $prev_balance-$pay_amount;
      
    $insert_schedule_sql  = "INSERT INTO payroll SET 
        JobOrderNo               = :jo_no,
        PayrollNo                  = :pay_no,
        PayAmount                     = :pay_amount,
        PosingDate                 = :pay_date,
        JoAmount                    = :jo_amount,
        AvailableBalance          = :amount,
        PreviousBalance          = :prev_balance,
         id_no          = :id_number,
         status          = :status,
        Charges                  = :proj_charges
        ";

$schedule_sql  = "INSERT INTO payroll_add SET 
        JobOrderNo               = :jo_no,
        PayrollNo                  = :pay_no,
        AvailableBalance          = :amount,
        id_no                   = :id_number,
        PayAmount         = :pay_amount
        ";

$sql ="UPDATE `project` SET Balance   = '$amount'
        WHERE   Charges               = '$proj_charges'  
     ";

$sql1 = "UPDATE `createjo` SET status   = '$status'
        WHERE   JobOrderNo               = '$jo_no'  
     ";

$sql2 = "UPDATE `schedule` SET PayrollNo   = '$pay_no'
        WHERE   JobOrderNo               = '$jo_no'  
     ";

$sql3 = "UPDATE `jo_details` SET PayrollNo   = '$pay_no'
        WHERE   JobOrderNo               = '$jo_no'  
     ";

      $schedule_data = $con->prepare($insert_schedule_sql);
      $schedule_data->execute([
        ':jo_no'             => $jo_no, 
        ':pay_no'          => $pay_no,
        ':pay_amount'           => $pay_amount,
        ':jo_amount'           => $jo_amount,
        ':pay_date'          => $pay_date,
        ':amount'             => $amount,
         ':prev_balance'       => $prev_balance,
         ':id_number'       => $id_number,
         ':status'       => $status,
         ':proj_charges'       => $proj_charges
      ]);

       $schedule_data_data = $con->prepare($schedule_sql);
      $schedule_data_data->execute([
        ':jo_no'             => $jo_no, 
        ':pay_no'          => $pay_no,
        ':pay_amount'           => $pay_amount,
         ':id_number'       => $id_number,
        ':amount'             => $amount
      ]);


if($con->query($sql) And $con->query($sql1) And $con->query($sql2)  And $con->query($sql3)){
     
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





     header('location: payroll.php');



?>

 
