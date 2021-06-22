<?php

include ('../config/db_config.php');
//include('import_pdf.php');

$alert_msg = '';
$alert_msg1 = '';
if (isset($_POST['update_itemcategory'])) {

    //     echo "<pre>";
    //     print_r($_POST);
    // echo "</pre>";
    $get_code = $_POST['code'];
    $get_categ = $_POST['category'];
    $get_status = $_POST['status'];
    $get_idno = $_POST['idno'];

   
    $update_categ_sql = "UPDATE tbl_itemcategory SET
        code            = :code,
        itemcategory    = :categ,
        status          = :stat
        where idno      = :id";
            
    $update_data = $con->prepare($update_categ_sql);
    $update_data->execute([
        ':id'            => $get_idno,
        ':categ'         => $get_categ,
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