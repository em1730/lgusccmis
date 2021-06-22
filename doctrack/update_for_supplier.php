<?php
    include('../config/db_config.php');


  $alert_msg = '';
  
    if (isset($_POST['update_supplier'])){
         //to check if data are passed

$get_objid          = $_POST['sup_objid'];
$get_code           = $_POST['sup_code'];
$get_supplierName   = $_POST['sup_name'];
$get_owner          = $_POST['sup_owner'];
$get_product        = $_POST['sup_product'];
$get_address        = $_POST['sup_address'];
$get_contact        = $_POST['sup_contact'];
$get_conPerson      = $_POST['sup_conPerson'];
$get_telNo          = $_POST['sup_telNo'];
$get_faxNo          = $_POST['sup_faxNo'];
$get_others         = $_POST['sup_others'];


   
            //update tbl users do not include password
            $update_supplier_sql = "UPDATE tbl_suppliers SET
                objid          = :id,
                code           = :code,
                name_supplier  = :nameSupplier,
                owner          = :owner,
                product_lines  = :productLines,
                address        = :address,
                contact_no     = :contactNo,
                contact_person = :contactPer,
                tel_no         = :telNo,
                fax_no         = :faxNo,
                others         = :others
                WHERE objid    = :id";

          $update_data = $con->prepare($update_supplier_sql);
          $update_data->execute([
                ':id'               => $get_objid,
                ':code'             => $get_code,
                ':nameSupplier'     => $get_supplierName,
                ':owner'            => $get_owner,
                ':productLines'     => $get_product,
                ':address'          => $get_address,
                ':contactNo'        => $get_contact,
                ':contactPer'       => $get_conPerson,
                ':telNo'            => $get_telNo,
                ':faxNo'            => $get_faxNo,
                ':others'           => $get_others
                
          ]);
     
     

    
            $alert_msg .= ' 
              <div class="new-alert new-alert-success alert-dismissible">
                  <i class="icon fa fa-success"></i>
                  Data Updated.
              </div>     
            ';


    }
?>