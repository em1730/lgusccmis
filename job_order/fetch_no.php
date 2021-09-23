<?php

session_start();

include('../config/db_config.php');

if (isset($_POST['type'])) {
//     echo "<pre>";
//     print_r($_POST);
// echo "</pre>";

$totalcount = null;
$finalcount1 = null;
$type = $_POST['type'];


$get_final_sql= "SELECT `createjo`.`JobOrderNo`, `schedule`.`JobOrderNo`, COUNT(`schedule`.`JobOrderNo`) as total FROM  `createjo`left join  `schedule` on `createjo`.`JobOrderNo`=`schedule`.`JobOrderNo` where `createjo`.`JobOrderNo` IS NOT NULL group by `createjo`.`JobOrderNo`";
$get_final_data = $con->prepare($get_final_sql);
$get_final_data->execute();
$get_final_data->setFetchMode(PDO::FETCH_ASSOC);
while ($result1 = $get_final_data->fetch(PDO::FETCH_ASSOC)) {
  $totalcount =  $result1['total'];
}

$finalcount1 = $totalcount + 1;


if ($type){
  $JobNo = $finalcount1;
}else{
$JobNo = $finalcount1;
}
echo $JobNo;
die();

}

?>