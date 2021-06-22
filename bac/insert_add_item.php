<?php


include ('../config/db_config.php');
//include('import_pdf.php');


$alert_msg = '';
$alert_msg1 = '';

if (isset($_POST['insert_add'])) {

        echo "<pre>";
        print_r($_POST);
    echo "</pre>";
    
    $pr_controlno = $_POST['control_no'];
    $itemname = $_POST['itemname'];
    $pr_description = $_POST['description'];
    $pr_unit = $_POST['unit'];
    
    $quantity = $_POST['quantity'];
    $total = $_POST['total_amount'];
    $type = $_POST['prItem'];
    $totalcost = $_POST['totalcost'];




   
    $insert_pr_items_sql = "INSERT INTO pr_items SET 
        pr_info_controlno           = :controlno,
        pr_item_code                = :code,
        pr_item_name                = :name,
        pr_item_description         = :description,
        pr_item_unit                = :pr_unit,
        pr_item_qty                 = :quantity,
        pr_item_unitcost            = :unitcost,
        pr_item_totalcost            = :totalcost
     
     

       
       ";
        
    $pr_items_data = $con->prepare($insert_pr_items_sql);
    $pr_items_data->execute([
      
        ':controlno'                => $pr_controlno,
        ':code'                     => $type,
        ':name'                     => $itemname,
        ':description'              => $pr_description,
        ':pr_unit'                     => $pr_unit,
        ':quantity'                 => $quantity,
        ':unitcost'                 => $totalcost,
        ':totalcost'                 => $total
      
      
      
        
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





 
header("location: add_pr_item.php?controlno=$control_no"); 



   
   




}














?>