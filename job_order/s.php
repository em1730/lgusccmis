<?php


session_start();
include ('../config/db_config.php');

$obj_id = $_SESSION['objid'];


if (!isset($_SESSION['objid'])) {
    header('location:../create_job_order.php');
} else {

}
$get_createjo_sql = "SELECT * FROM createjo WHERE objid = :objid";
$get_createjo_data = $con->prepare($get_createjo_sql);
$get_createjo_data->execute([':objid'=>$obj_id]); 
while ($result = $get_createjo_data ->fetch(PDO::FETCH_ASSOC)) {
  $Job = $result['JobOrderNo'];
  $bal = $result['PreviousBalance'];

}
?>