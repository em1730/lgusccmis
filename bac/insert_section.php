<?php

include ('../config/db_config.php');
//include('import_pdf.php');


$myID = uniqid('id',true);
$alert_msg = '';
$alert_msg1 = '';
if (isset($_POST['insert_section'])) {

    //     echo "<pre>";
    //     print_r($_POST);
    // echo "</pre>";

    $section = $_POST['sections'];
    $status = $_POST['status'];
 

   
    $insert_section_sql = "INSERT INTO tbl_section SET 
        objid               = :id,
        section               = :section,
        status               = :status";
        
    $section_data = $con->prepare($insert_section_sql);
    $section_data->execute([
        ':id'             => $myID,
        ':section'             => $section,
        ':status'             => $status
        
        
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