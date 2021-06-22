<?php

include ('../config/db_config.php');
//include('import_pdf.php');


$myID = uniqid('iditem',true);
$alert_msg = '';
$alert_msg1 = '';
if (isset($_POST['insert_itemunit'])) {

    //     echo "<pre>";
    //     print_r($_POST);
    // echo "</pre>";
    $code = $_POST['code'];
    $itemunit = $_POST['unit'];
    $status = $_POST['status'];
   
    $insert_categ_sql = "INSERT INTO tbl_itemunit SET 
        objid               = :id,
        code                = :code,
        itemunit            = :unit,
        status              = :status";
        
    $categ_data = $con->prepare($insert_categ_sql);
    $categ_data->execute([

        ':code'             => $code, 
        ':unit'             => $itemunit,
        ':status'           => $status,
        ':id'               => $myID
        
        ]);

    $alert_msg .= ' 
          <div class="new-alert new-alert-success alert-dismissible">
              <i class="icon fa fa-success"></i>
              Data Inserted
          </div>     
      ';
    
    $btnSave = 'disabled';
    $btnNew = 'enabled';
    }


?>