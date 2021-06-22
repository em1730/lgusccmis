<?php

include ('../config/db_config.php');
//include('import_pdf.php');


$myID = uniqid('iditem',true);
$alert_msg = '';
$alert_msg1 = '';

if (isset($_POST['insert_item'])) {

    //     echo "<pre>";
    //     print_r($_POST);
    // echo "</pre>";
    $itemcode = $_POST['code'];
    $itemname = $_POST['itemname'];
    $type = $_POST['category'];
    $itemunit = $_POST['itemunit'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $status = $_POST['status'];

   
    $insert_item_sql = "INSERT INTO tbl_items SET 
        objid               = :id,
        itemcode            = :code,
        itemname            = :itemname,
        category            = :categ,
        unit                = :unit,
        description         = :descript,
        price               = :price,
        status              = :status";
        
    $item_data = $con->prepare($insert_item_sql);
    $item_data->execute([
        ':id'                => $myID,
        ':code'              => $itemcode,
        ':itemname'          => $itemname,
        ':categ'             => $type,
        ':unit'              => $itemunit,
        ':descript'          => $description, 
        ':price'              => $price,
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

header('location: list_items.php');

    


?>