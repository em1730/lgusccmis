<?php

include ('../config/db_config.php');
//include('import_pdf.php');

$alert_msg = '';
$alert_msg1 = '';
if (isset($_POST['update_section'])) {

    //     echo "<pre>";
    //     print_r($_POST);
    // echo "</pre>";
    $get_section = $_POST['section'];
    $get_idno = $_POST['idno'];
    $get_status = $_POST['status'];
    
   
    $update_section_sql = "UPDATE tbl_section SET
        section            = :section,
        status              = :status
        where idno          = :id";
            
    $update_data = $con->prepare($update_section_sql);
    $update_data->execute([
        ':section'            => $get_section,
        ':id'            => $get_idno,
        ':status'            => $get_status

        
        
        ]);

        $alert_msg .= ' 
        <div class="new-alert new-alert-success alert-dismissible">
            <i class="icon fa fa-success"></i>
            Data Updated
        </div>     
      ';

    }

?>