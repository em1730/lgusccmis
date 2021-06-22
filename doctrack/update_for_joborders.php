<?php
    include('../config/db_config.php');


  $alert_msg = '';
  
    if (isset($_POST['update_jobOrder'])){
         //to check if data are passed

    $objid = $_POST['objid'];
    $control = $_POST['controlNumber'];
    $fname = $_POST['firstname'];
    $middle = $_POST['middlename'];
    $last = $_POST['lastname'];
    $rate = $_POST['rate'];
    $department = $_POST['department'];
    $status = $_POST['status'];

   
            //update tbl users do not include password
            $update_joborder_sql = "UPDATE tbl_joborder SET
                objid         = :id,
                controlno     = :controlNo,
                firstname     = :fname,
                middlename    = :mname,
                lastname      = :lname,
                rate          = :rate,
                department    = :department,
                status        = :status
                WHERE objid   = :id";

          $update_data = $con->prepare($update_joborder_sql);
          $update_data->execute([
                ':id'             => $objid,
                ':controlNo'      => $control,
                ':fname'          => $fname,
                ':mname'          => $middle,
                ':lname'          => $last,
                ':rate'           => $rate,
                ':department'     => $department,
                ':status'         => $status
                
          ]);
     
     

    
            $alert_msg .= ' 
              <div class="new-alert new-alert-success alert-dismissible">
                  <i class="icon fa fa-success"></i>
                  Data Updated.
              </div>     
            ';


    }
?>