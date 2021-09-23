<?php
  include('../config/db_config.php');

  $alert_msg = '';     
  

  if (isset($_POST['insert'])) {


    $budgetNo = $_POST['budgetno'];
    $project_name = $_POST['projectname'];
    $project_budget = $_POST['projectbudget'];
    $project_charges = $_POST['projectcharges'];
    
    $insert_project_sql  = "INSERT INTO project SET 
        BudgetNo               = :budgetno,
        ProjectName            = :projectname,
        ProjectBudget           = :projectbudget,
        Balance                 = :projectbudget,
        Charges                = :projectcharges
        ";

      $project_data = $con->prepare($insert_project_sql);
      $project_data->execute([
        ':budgetno'             => $budgetNo, 
        ':projectname'           => $project_name,
        ':projectcharges'       => $project_charges,
        ':projectbudget'       => $project_budget]);

      $alert_msg .= ' 
          <div class="alert alert-success alert-dismissible">
              <i class="icon fa fa-success"></i>
             Project Successfully Added!
          </div>     
      ';
     // $fname = $mname = $lname = $contact_number = $email = $uname = $upass = '';

     $btnStatus = 'disabled';
     $btnNew = 'enabled';
header('location: add_project.php');
    }
 
?>