<?php
  include('../config/db_config.php');

  $alert_msg = '';     
  

  if (isset($_POST['insert'])) {

    $jo_no = $_POST['jo_no'];
    $jo_charges = $_POST['jo_charges'];
    $jo_project_name = $_POST['jo_name'];
    $jo_budget = $_POST['jo_budget'];
    $jo_previous= $_POST['jo_previous'];
    $jo_period= $_POST['datefilter'];
  
  
    $insert_createjo_sql  = "INSERT INTO createjo SET 
        JobOrderNo               = :jo_no,
        Charges                  = :jo_charges,
        ProjectName              = :jo_name,
        ProjectBudget            = :jo_budget,
        PreviousBalance          = :jo_previous,
        PeriodCovered            = :datefilter
        ";

      $createjo_data = $con->prepare($insert_createjo_sql);
      $createjo_data->execute([
        ':jo_no'                => $jo_no, 
        ':jo_charges'           => $jo_charges,
        ':jo_name'              => $jo_project_name,
        ':jo_budget'            => $jo_budget,
        ':jo_previous'          => $jo_previous,
        ':datefilter'            => $jo_period
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
     
}

?>

 
