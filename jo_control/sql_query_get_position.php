<?php


include ('../config/db_config.php');

if (isset($_POST['emp_position'])) {

  $empID = $_POST['emp_position'];
  $position = '';
  // $user_id = $_SESSION['id  //select all data type
  $get_all_item_sql = "SELECT `position` FROM `employee` WHERE fullname = :empposition";
  $get_all_employee_data = $con->prepare($get_all_employee_sql);
  $get_all_employee_data->execute([':empposition'=> $empID]);  
   while ($result = $get_all_employee_data->fetch(PDO::FETCH_ASSOC)) {
    $position =  $result['position'];
   }

  $data = array(
    'statuscode' => 200,
    'data' => $position,
    'message' => 'success'
  );
  echo json_encode($data);

}
?>