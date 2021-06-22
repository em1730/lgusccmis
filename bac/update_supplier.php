<?php

include ('../config/db_config.php');
//include('import_pdf.php');

$alert_msg = '';
$alert_msg1 = '';
if (isset($_POST['update_supplier'])) {

    //     echo "<pre>";
    //     print_r($_POST);
    // echo "</pre>";
    $get_contact_no = $_POST['contact_no'];
    $get_name_supplier =  $_POST['supplier'];
    $get_owner = $_POST['owner'];
    $get_product_lines = $_POST['product_lines'];
    $get_address = $_POST['address'];
    $get_contact_person = $_POST['contact_person'];
    $get_fax_no = $_POST['fax_no'];
    $get_others = $_POST['others'];
    $get_code = $_POST['code'];
    $get_status = $_POST['status'];
    $get_idno = $_POST['idno'];
    
   
    $update_supplier_sql = "UPDATE tbl_suppliers SET
        name_supplier   =:supplier,
        owner           =:owner,
        product_lines   =:product,
        address         =:add,
        contact_no      =:number,
        contact_person  =:person,
        fax_no          =:fax,
        others          =:others,
        status          =:status
        where idno      = :id";
            
    $update_data = $con->prepare($update_supplier_sql);
    $update_data->execute([
        ':supplier'            => $get_name_supplier,
        ':owner'            => $get_owner,
        ':product'            => $get_product_lines,
        ':add'            => $get_address,
        ':number'            => $get_contact_no,
        ':person'            => $get_contact_person,
        ':fax'            => $get_fax_no,
        ':others'            => $get_others,
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