<?php

include ('../config/db_config.php');
//include('import_pdf.php');

$alert_msg = '';
$alert_msg1 = '';
if (isset($_POST['update_department'])) {

    //     echo "<pre>";
    //     print_r($_POST);
    // echo "</pre>";
    $get_code = $_POST['code'];
    $get_department = $_POST['department'];
    
    $get_status = $_POST['status'];
    $get_idno = $_POST['idno'];
   
    $update_dept_sql = "UPDATE tbl_department SET
        department           = :desc,
        status                = :stat,
        objid                  = :code    
        where idno            = :idno";
            
    $update_data = $con->prepare($update_dept_sql);
    $update_data->execute([
        ':code'            => $get_code,
        ':idno'            => $get_idno,
        ':stat'            => $get_status,
        ':desc'            => $get_department
   
        
        
        ]);

        $alert_msg .= ' 
        <div class="new-alert new-alert-success alert-dismissible">
            <i class="icon fa fa-success"></i>
            Data Updated
        </div>     
      ';





    }

?>