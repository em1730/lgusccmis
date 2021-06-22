<?php

include ('../config/db_config.php');
//include('import_pdf.php');


$myID = uniqid('iditemcateg',true);
$alert_msg = '';
$alert_msg1 = '';
if (isset($_POST['add'])) {

    //     echo "<pre>";
    //     print_r($_POST);
    // echo "</pre>";
    $codecateg = $_POST['code'];
    $namecategory = $_POST['category'];
    $status = 'Active';
   
    $insert_categ_sql = "INSERT INTO category SET 
        objid               = :id,
        code                = :code,
        itemcategory        = :category,
        status              = :status";
        
    $categ_data = $con->prepare($insert_categ_sql);
    $categ_data->execute([

        ':code'             => $codecateg, 
        ':category'             => $namecategory,
        ':status'           => $status,
        ':id'               => $myID
        
        ]);

    $alert_msg .= ' 
          <div class="new-alert new-alert-success alert-dismissible">
              <i class="icon fa fa-success"></i>
              Data Inserted
          </div>     
      ';
    
    $btnSave = 'disabled';
    $btnNew = 'enabled';

    header('location: list_category.php');


    }























?>