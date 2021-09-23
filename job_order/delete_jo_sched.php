<?php


	include('../config/db_config.php');

	if(isset($_POST['delete'])){

	$delete_id = $_POST['id'];
    $delete_user_sql = "DELETE FROM schedule WHERE id = :id";
    $delete_user_data = $con->prepare($delete_user_sql);
    $delete_user_data->execute([':id'=>$delete_id]);

    $alert_msg .= '<div class="alert alert-danger alert-dismissible"><i class="icon fa fa-check"></i>Deleted</div>';

    $btnStatus='disabled';
  }
?>