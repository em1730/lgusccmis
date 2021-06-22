<?php

include ('../config/db_config.php');
//include('import_pdf.php');

$alert_msg = '';
$alert_msg1 = '';
if (isset($_POST['update_itemunit'])) {

    //     echo "<pre>";
    //     print_r($_POST);
    // echo "</pre>";
    $get_idno = $_POST['idno'];
    $get_code = $_POST['code'];
    $get_itemunit = $_POST['unit'];
    $get_status = $_POST['status'];

   
    $update_categ_sql = "UPDATE tbl_itemunit SET
        code            = :code,
        itemunit        = :unit,
        status          = :stat
        where idno      = :id";
            
    $update_data = $con->prepare($update_categ_sql);
    $update_data->execute([
        ':id'            => $get_idno,
        ':unit'         => $get_itemunit,
        ':code'          => $get_code,
        ':stat'          => $get_status
        ]);

        $alert_msg .= ' 
        <div class="new-alert new-alert-success alert-dismissible">
            <i class="icon fa fa-success"></i>
            Data Updated.
        </div>     
      ';

    }

?>