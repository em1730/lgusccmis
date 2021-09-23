<?php
  include('../config/db_config.php');

  $alert_msg = '';     
  

  if (isset($_POST['insert'])) {


    $payrollNo = $_POST['payrollno'];
    $sssAmount = $_POST['sssamount'];
    $empCode = $_POST['empcode'];
    $name = $_POST['name'];
    $covered = $_POST['coveredmonth'];
    $year = $_POST['year'];
    

    $insert_project_sql  = "INSERT INTO sss SET 
        PayrollNo               = :payrollno,
        sss_amount              = :sssamount,
        EmpCode                 = :empcode,
        Name                    = :name,
        year                    = :year,
        CoveredMonth            = :coveredmonth
        ";

      $project_data = $con->prepare($insert_project_sql);
      $project_data->execute([
        ':payrollno'          => $payrollNo, 
        ':sssamount'          => $sssAmount,
        ':name'               => $name,
        ':empcode'            => $empCode,
        ':year'               => $year,
        ':coveredmonth'       => $covered]);

 $sql ="UPDATE schedule SET sss   = '$sssAmount',
                
                 FName  = '$name'
         WHERE EmpCode     =     '$empCode'

     ";
if($con->query($sql)){

      $alert_msg .= ' 
          <div class="alert alert-success alert-dismissible">
              <i class="icon fa fa-success"></i>
             Deducted!
          </div>     
      ';
        $btnStatus = 'disabled';
     $btnNew = 'enabled';
     $month = 'disabled';
     // $fname = $mname = $lname = $contact_number = $email = $uname = $upass = '';
 }
        else{
            $_SESSION['error'] = $con->error;
        }
    }
    else{
        $_SESSION['error'] = 'Fill up edit form first';
    
  
     

    
 }
?>