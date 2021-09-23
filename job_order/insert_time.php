<?php
  include('../config/db_config.php');

  $alert_msg = '';     
  

  if (isset($_POST['add'])) {


    $time = $_POST['jo_time'];
    
      
    $insert_time_sql  = "INSERT INTO timer SET 
        TimeSched             = :jo_time";

      $rate_data = $con->prepare($insert_time_sql);
      $rate_data->execute([
        ':jo_time'             => $time
      ]);

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

 
