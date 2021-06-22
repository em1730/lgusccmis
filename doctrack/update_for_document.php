<?php
    include('../config/db_config.php');


  $alert_msg = '';
  
    if (isset($_POST['update_document'])){
         //to check if data are passed

    $get_objid = $_POST['doc_objid'];
    $get_type = $_POST['doc_type'];
    $get_desc = $_POST['doc_desc'];
    $get_status = $_POST['doc_status'];

            //update tbl users do not include password
            $update_document_sql = "UPDATE document_type SET
                objid         = :id,
                type          = :type,
                description   = :desc,
                status        = :status
                WHERE objid   = :id";

          $update_data = $con->prepare($update_document_sql);
          $update_data->execute([
                ':id'             => $get_objid,
                ':type'           => $get_type,
                ':desc'           => $get_desc,
                ':status'         => $get_status
          ]);
     
     

    
            $alert_msg .= ' 
              <div class="new-alert new-alert-success alert-dismissible">
                  <i class="icon fa fa-success"></i>
                  Data Updated.
              </div>     
            ';


    }
?>