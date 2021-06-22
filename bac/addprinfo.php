<?php
include('../config/db_config.php');

  $alert_msg = '';     

  if (isset($_POST['addprinfo'])) {


 
   
    $dept               = $_POST['dept'];
    $prno               = $_POST['prno'];
    $prdate             = $_POST['prdate'];
    $section            = $_POST['section'];
    $saino              = $_POST['saino'];
    $saidate            = $_POST['saidate'];
    $reqby              = $_POST['reqby'];
    $checkby            = $_POST['checkby'];
    $purpose            = $_POST['purpose'];


    $get_user_sql = "SELECT * FROM tbl_department WHERE department = :dept and status = 'ACTIVE'";
    $user_data = $con->prepare($get_user_sql);
    $user_data->execute([':dept' => $dept]);
    while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {
      $deptcode    = $result['idno'];
    }
  


       //insert issuances to issuances database
      $register_user_sql  = "INSERT INTO pr_info SET
        pr_info_state             = UPPER(:state),
        pr_info_control_no        = :prcontrolno,
        pr_info_dept              = UPPER(:dept),
        pr_info_no                = :prno,
        pr_info_date              = :prdate,
        pr_info_section           = UPPER(:section),
        pr_info_sai_no            = :saino,
        pr_info_sai_date          = :saidate,
        pr_info_reqby             = UPPER(:reqby),
        pr_info_checkedby         = UPPER(:checkby),
        pr_info_purpose           = UPPER(:purpose)";

      $register_data = $con->prepare($register_user_sql);
      $register_data->execute([
      	':state'              => 'ACTIVE',
        ':prcontrolno'        => $prcontrolno,
        ':dept'               => $dept,
        ':prno'               => $prno,
        ':prdate'             => $prdate,
        ':section'            => $section,
        ':saino'              => $saino,
        ':saidate'            => $saidate,
        ':reqby'              => $reqby,
        ':checkby'            => $checkby,
        ':purpose'            => $purpose,
        ]);



 
 
      

      }



?>
  