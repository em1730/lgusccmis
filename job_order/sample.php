<?php


include ('../config/db_config.php');

if (isset($_POST['id'])) {

  $namejo = $_POST['id'];
  $code = '';

 
  // $user_id = $_SESSION['id  //select all data type
  $get_all_employeedetail1_sql = "SELECT * FROM `schedule` WHERE id = :id";
  $get_all_employeedetail1_data = $con->prepare($get_all_employeedetail1_sql);
  $get_all_employeedetail1_data->execute([':id'=> $namejo]);  
   while ($result = $get_all_employeedetail1_data->fetch(PDO::FETCH_ASSOC)) {
    $code =  $result['JobOrderNo'];
 
   }

  $data = array(
    'statuscode' => 200,
    'JobOrderNo' => $code,
    'id' => $namejo,
    'message' => 'success'
  );
  echo json_encode($data);
  
}

?>