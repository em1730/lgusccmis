<?php

include ('../config/db_config.php');
//include('import_pdf.php');



$alert_msg = '';

$alert_msg1 = '';






if (isset($_POST['insert_purchaseitem'])) {

    //     echo "<pre>";
    //     print_r($_POST);
    // echo "</pre>";
    $itemname = $_POST['itemname'];


   
    $insert_item_sql = "INSERT INTO tbl_purchaseitem SET 
        itemname               = itemname";
        
    $item_data = $con->prepare($insert_item_sql);
    $item_data->execute([
       
        ':itemname'             => $itemname 
      
        
        ]);

    $alert_msg .= ' 
          <div class="new-alert new-alert-success alert-dismissible">
              <i class="icon fa fa-success"></i>
              Data Inserted
          </div>     
      ';



    
    $btnSave = 'disabled';
    $btnNew = 'enabled';
    $btnPrint ='enabled';
   







}
























?>