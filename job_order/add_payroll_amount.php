<?php
  include('../config/db_config.php');

 $alert_msg = '';    
  if (isset($_POST['add'])) {


    $pay_no = $_POST['pay_no'];
    $pay_amount = $_POST['pay_amount'];
      
    $add_schedule_sql  = "INSERT INTO payroll_add SET 
        PayrollNo                  = :pay_no,
         PayAmount                  = :pay_amount,
        ";


      $schedule_data = $con->prepare($add_schedule_sql);
      $schedule_data->execute([
        ':pay_no'          => $pay_no,
        ':pay_amount'          => $pay_amount
      ]);


?>

 
