<?php


session_start();

include ('../config/db_config.php');

if (isset($_POST['department'])) {
//     echo "<pre>";
//     print_r($_POST);
// echo "</pre>";

$finalcount = null;
$finalcount1 = null;
$finaldepartment = null;


$department = $_POST['department'];
// $user_id = $_SESSION['id'];


//select all data type
$get_all_dept_sql = "SELECT `objid` FROM `tbl_department` WHERE objid = :department";
$get_all_dept_data = $con->prepare($get_all_dept_sql);
$get_all_dept_data->execute([':department'=> $department]);  
 while ($result = $get_all_dept_data->fetch(PDO::FETCH_ASSOC)) {
  $finaldepartment =  $result['objid'];
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
$get_noofdocs_sql= "SELECT COUNT(`empID`) as total FROM `tbl_employee` WHERE empID LIKE '".$department."%' ";
$get_noofdocs_data = $con->prepare($get_noofdocs_sql);
$get_noofdocs_data->execute();
$get_noofdocs_data->setFetchMode(PDO::FETCH_ASSOC);
while ($result1 = $get_noofdocs_data->fetch(PDO::FETCH_ASSOC)) {    
  $finalcount =  $result1['total'];
}


  $finalcount1 = $finalcount + 1;

  $idnumber = $finaldepartment.'-'.$finalcount1;
  echo "EMP".'-'.$idnumber;
  die();


}
?>