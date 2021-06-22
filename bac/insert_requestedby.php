<?php

include ('../config/db_config.php');
//include('import_pdf.php');


$myID = uniqid('id',true);
$alert_msg = '';
$alert_msg1 = '';



if (isset($_POST['insert_requestedby'])) {

    //     echo "<pre>";
    //     print_r($_POST);
    // echo "</pre>";

    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $status = $_POST['status'];
    $department = $_POST['department'];
    $position = $_POST['positions'];
 

   
    $insert_requested_sql = "INSERT INTO tbl_requestedby SET 
        objid                = :id,
        firstname            = :fname,
        middlename           = :mname,
        lastname             = :lname,
        position             = :pos,
        department           = :dept,
        status              = :status";
        
    $requested_data = $con->prepare($insert_requested_sql);
    $requested_data->execute([
        ':id'                => $myID,
        ':fname'                => $firstname,
        ':mname'                => $middlename,
        ':lname'                => $lastname,
        ':dept'                => $department,
        ':pos'                => $position,
        ':status'                => $status
        
        
        ]);

    $alert_msg .= ' 
          <div class="new-alert new-alert-success alert-dismissibl`  e">
              <i class="icon fa fa-success"></i>
              Data Inserted
          </div>     
      ';
    
    $btnSave = 'disabled';
    $btnNew = 'enabled';
    }


?>