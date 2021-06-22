<?php
  include('../config/db_config.php');

  $alert_msg = '';     
  

  if (isset($_POST['add'])) {


    $period_code = $_POST['code'];
    $period_start = date('F d, Y', strtotime($_POST['periodStart']));
    $period_end = date('F d, Y', strtotime($_POST['periodEnd']));
    
    
    $add_period_sql  = "INSERT INTO period SET 
        EmpCode               = :code,
        PeriodCovered1        = :periodStart,
        Period                = :periodEnd
        ";

      $period_data = $con->prepare($add_period_sql);
      $period_data->execute([
        ':code'             => $period_code, 
        ':periodStart'      => $period_start,
        ':periodEnd'        => $period_end
      ]);

      $alert_msg .= ' 
          <div class="alert alert-success alert-dismissible">
              <i class="icon fa fa-success"></i>
             Proceed to continue!
          </div>     
      ';
     // $fname = $mname = $lname = $contact_number = $email = $uname = $upass = '';

      

     $btnStatus = 'disabled';
     $btnNew = 'enabled';
header('location: employeedetails.php?ID=1');
}


?>

 
