<?php

include ('../config/db_config.php');
//include('import_pdf.php');

$alert_msg = '';
$alert_msg1 = '';
if (isset($_POST['update_position'])) {

    //     echo "<pre>";
    //     print_r($_POST);
    // echo "</pre>";
    $get_position = $_POST['position'];
    $get_idno = $_POST['idno'];
    $get_status = $_POST['status'];
    
   
    $update_position_sql = "UPDATE tbl_position SET
        position            = :pos,
        status              = :status
        where idno          = :id";
            
    $update_data = $con->prepare($update_position_sql);
    $update_data->execute([
        ':pos'            => $get_position,
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