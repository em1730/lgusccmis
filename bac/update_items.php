<?php

include ('../config/db_config.php');
//include('import_pdf.php');

$alert_msg = '';
$alert_msg1 = '';
if (isset($_POST['update_items'])) {

    //     echo "<pre>";
    //     print_r($_POST);
    // echo "</pre>";
    $get_itemcode = $_POST['code'];
    $get_itemname = $_POST['itemname'];
    $get_categ = $_POST['category'];
    $get_unit = $_POST['itemunit'];
    $get_description = $_POST['description'];
    $get_price = $_POST['price'];
 
    $get_status = $_POST['status'];
    
   
    $update_items_sql = "UPDATE tbl_items SET
        itemname            = :name,
        unit                = :unit,
        description         = :desc,
        price               = :price,
       
        status              = :status
        where itemcode      = :code";
            
    $update_data = $con->prepare($update_items_sql);
    $update_data->execute([
        ':code'            => $get_itemcode,
        ':name'            => $get_itemname,
        ':unit'            => $get_unit,
        ':desc'            => $get_description,
        ':price'            => $get_price,
    
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