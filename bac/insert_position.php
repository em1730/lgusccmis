<?php

include ('../config/db_config.php');
//include('import_pdf.php');


$myID = uniqid('id',true);
$alert_msg = '';
$alert_msg1 = '';



if (isset($_POST['insert_position'])) {

    //     echo "<pre>";
    //     print_r($_POST);
    // echo "</pre>";
    $position = $_POST['position'];
    $status = $_POST['status'];
 

   
    $insert_position_sql = "INSERT INTO tbl_position SET 
        objid               = :id,
        position            = :pos,
        status              = :status";
        
    $position_data = $con->prepare($insert_position_sql);
    $position_data->execute([
        ':id'                => $myID,

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