<?php


include ('../config/db_config.php');

if (isset($_POST['jo_code'])) {

  $namejo = $_POST['jo_code'];
  $code = '';

 
  // $user_id = $_SESSION['id  //select all data type
  $get_all_employeedetail_sql = "SELECT * FROM `payroll` WHERE PayrollNo = :code";
  $get_all_employeedetail_data = $con->prepare($get_all_employeedetail_sql);
  $get_all_employeedetail_data->execute([':code'=> $namejo]);  
   while ($result = $get_all_employeedetail_data->fetch(PDO::FETCH_ASSOC)) {
    $code =  $result['Period'];
   
   }

  $data = array(
    'statuscode' => 200,
    'data' => $code,
    'message' => 'success'
  );
  echo json_encode($data);
  
}

?>