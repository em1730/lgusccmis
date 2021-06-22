<?php
  include('../config/db_config.php');

  $alert_msg = '';     
  $alert_msg1 = '';    

  //if button insert clicked

  if (isset($_POST['insert'])) {
    
//  EMPLOYEE DETAILS
    $jo_no = $_POST['jo_no'];
    $jo_charges = $_POST['charges'];   
    $jo_proj_name = $_POST['project_name'];
    $jo_budget = $_POST['budget'];
    $jo_previous = $_POST['previous'];

   
    
    $emp1 = $_POST['name1'];
    $emp2 = $_POST['name2'];
    $period1 = $_POST['datefilter1'];
    $period2 = $_POST['datefilter2'];

    $rate1 = $_POST['rate1'];
    $rate2 = $_POST['rate2'];

    $time1 = $_POST['time1'];
    $time2 = $_POST['time2'];
      

    $register_jo_sql = "INSERT INTO joborder SET 
      JobOrderNo      =      :jo_no,
      Charges         =      :charges,
      ProjectName     =      :project_name,
      ProjectBudget   =      :budget,
      PreviousBalance =      :previous,
      Period1         =      :datefilter1,
      Period2         =      :datefilter2,


       Emp1           =      :name1,
       Emp2           =      :name2,

       Rate1          =      :rate1,
       Rate2          =      :rate2,

       Time1          =      :time1,
       Time2          =      :time2";

      $register_data = $con->prepare($register_jo_sql);
      $register_data->execute([

      ':jo_no'         =>     $jo_no,
      ':charges'       =>     $jo_charges,
      ':project_name' =>      $jo_proj_name,
      ':budget'       =>      $jo_budget,
      ':previous'     =>      $jo_previous,
      ':datefilter1'      =>      $period1,
      ':datefilter2'      =>      $period2,



    ':name1'           =>     $emp1,
    ':name2'           =>     $emp2,

    ':rate1'           =>     $rate1,
    ':rate2'           =>     $rate2,

    ':time1'           =>     $time1,
    ':time2'           =>     $time2
  ]);

     $alert_msg .= ' 
          <div class="alert alert-success alert-dismissible">
              <i class="icon fa fa-success"></i>
              Successfully Added
          </div>     
      ';
     // $fname = $mname = $lname = $contact_number = $email = $uname = $upass = '';

     $btnStatus = 'disabled';
     
    }

  

 

 
?>
