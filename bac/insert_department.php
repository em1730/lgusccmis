 <?php

include ('../config/db_config.php');
//include('import_pdf.php');

$myID = uniqid('id',true);
$alert_msg = '';
$alert_msg1 = '';


if (isset($_POST['insert_department'])) {

    //     echo "<pre>";
    //     print_r($_POST);
    // echo "</pre>";
    $code = $_POST['code'];
    $dept = $_POST['department'];
    $status = $_POST['status'];
   
    $insert_dept_sql = "INSERT INTO tbl_department SET 
       
        objid                = :id,
        department          = :dept,
        status             = :status";
        
    $dept_data = $con->prepare($insert_dept_sql);
    $dept_data->execute([
        ':id'               => $myID,
        ':id'             => $code, 
        ':dept'             => $dept,
        ':status'           => $status
        
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


?>