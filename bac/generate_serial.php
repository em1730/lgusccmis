<?php


session_start();

include ('../config/db_config.php');

if (isset($_POST['category'])) {
//     echo "<pre>";
//     print_r($_POST);
// echo "</pre>";

$finalcount = null;
$finalcount1 = null;
$finalcategory = null;


$category = $_POST['category'];
// $user_id = $_SESSION['id'];


//select all data type
$get_category_sql = "SELECT `code` FROM `category` WHERE code = :category";
$get_category_data = $con->prepare($get_category_sql);
$get_category_data->execute([':category'=> $category]);  
 while ($result = $get_category_data->fetch(PDO::FETCH_ASSOC)) {
  $finalcategory =  $result['code'];
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