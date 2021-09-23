<?php


session_start();

include('../config/db_config.php');

if (isset($_POST['type'])) {
//     echo "<pre>";
//     print_r($_POST);
// echo "</pre>";

$finalcount = null;
$finalcount1 = null;
$finaltype = null;
$type = $_POST['type'];
$user_id = $_SESSION['id'];


//select all data type


//select office
$get_user_sql = "SELECT * FROM tbl_users WHERE user_id = :id";
$get_user_data = $con->prepare($get_user_sql);
$get_user_data->execute([':id'=>$user_id]);
while ($result2 = $get_user_data->fetch(PDO::FETCH_ASSOC)) {

  $user_name = $result2['username'];
  $department = $result2['Department'];
}

//count no. of documents
$get_nooftravel_sql= "SELECT COUNT(`travelOrderNo`) as total FROM `alltravelorder` ";
$get_nooftravel_data = $con->prepare($get_nooftravel_sql);
$get_nooftravel_data->execute();
$get_nooftravel_data->setFetchMode(PDO::FETCH_ASSOC);
while ($result1 = $get_nooftravel_data->fetch(PDO::FETCH_ASSOC)) {
  $finalcount =  $result1['total'];

}


  $finalcount1 = $finalcount + 1;


if ($type){
  $travelNo =date('Y').'-'.$finalcount1;
}else{
$travelNo =$finaltype.'-'.$department.'-'.date('Y').'-'.$finalcount1;
}
echo $travelNo;
die();

}
?>