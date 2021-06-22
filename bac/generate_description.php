<?php


session_start();

include ('../config/db_config.php');

if (isset($_POST['itemname'])) {
//     echo "<pre>";
//     print_r($_POST);
// echo "</pre>";

$finalcount = null;
$finalcount1 = null;
$finalitem = null;


$item = $_POST['description'];
// $user_id = $_SESSION['id'];


//select all data type
$get_all_item_sql = "SELECT `description` FROM `tbl_items` WHERE itemcode = :description";
$get_all_item_data = $con->prepare($get_all_item_sql);
$get_all_item_data->execute([':itemname'=> $item]);  
 while ($result = $get_all_item_data->fetch(PDO::FETCH_ASSOC)) {
  $finalitem =  $result['description'];
 }

//select office
// $get_user_sql = "SELECT * FROM tbl_users WHERE user_id = :id";
// $get_user_data = $con->prepare($get_user_sql);
// $get_user_data->execute([':id'=>$user_id]);
// while ($result2 = $get_user_data->fetch(PDO::FETCH_ASSOC)) {

//   $user_name = $result2['username'];
//   $department = $result2['department'];
// }

//count no. of documents
$get_noofdocs_sql= "SELECT COUNT(`itemcode`) as total FROM `tbl_items` WHERE itemcode LIKE '".$category."%' ";
$get_noofdocs_data = $con->prepare($get_noofdocs_sql);
$get_noofdocs_data->execute();
$get_noofdocs_data->setFetchMode(PDO::FETCH_ASSOC);
while ($result1 = $get_noofdocs_data->fetch(PDO::FETCH_ASSOC)) {    
  $finalcount =  $result1['total'];
}


  $finalcount1 = $finalcount + 1;

  $itemcode = $finalcategory.'-'.$finalcount1;
  echo $itemcode;
  die();


}
?>