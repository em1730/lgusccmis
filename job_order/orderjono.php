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
$jo_id = $_SESSION['id'];


//select all data type


//select office
$get_no_sql = "SELECT * FROM createjo WHERE objid = :id";
$get_no_data = $con->prepare($get_no_sql);
$get_no_data->execute([':id'=>$jo_id]);
while ($result2 = $get_no_data->fetch(PDO::FETCH_ASSOC)) {

  $no_jo = $result2['JobOrderNo'];
 
}

//count no. of documents
$get_nojo_sql= "SELECT COUNT(`objid`) as total FROM `createjo` ";
$get_nojo_data = $con->prepare($get_nojo_sql);
$get_nojo_data->execute();
$get_nojo_data->setFetchMode(PDO::FETCH_ASSOC);
while ($result1 = $get_nojo_data->fetch(PDO::FETCH_ASSOC)) {
  $finalcount =  $result1['total'];

}


  $finalcount1 = $finalcount + 1;


if ($type){
  $JobNo =date('Y').'-'.$finalcount1;
}else{
$JobNo =$finaltype.'-'.date('Y').'-'.$finalcount1;
}
echo $JobNo;
die();

}
?>