<?php
  include('../config/db_config.php');

  $alert_msg = '';     
  

  if (isset($_POST['insert'])) {


    $add = $_POST['rate'];
   
   
      
    $insert_rate_sql  = "INSERT INTO rate SET 
        Salary             = :add";

      $rate_data = $con->prepare($insert_rate_sql);
      $rate_data->execute([
        ':add'             => $add      ]);

   
 $alert_msg .= ' 
          <div class="alert alert-success alert-dismissible">
              <i class="icon fa fa-success"></i>
             Successfully Added!
          </div>     
      ';
        $btnStatus = 'disabled';
     $btnNew = 'enabled';
     $month = 'disabled';
  header('location: additional.php');
}
?>

 
