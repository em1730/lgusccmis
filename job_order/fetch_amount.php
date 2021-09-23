<?php


include ('../config/db_config.php');

if (isset($_POST['jo_amount'])) {

  $namejo = $_POST['jo_amount'];
  $code = '';

 
  // $user_id = $_SESSION['id  //select all data type
  $get_all_employeedetail1_sql = "SELECT * FROM `jo_details` WHERE JobOrderNo = :jo_number";
  $get_all_employeedetail1_data = $con->prepare($get_all_employeedetail1_sql);
  $get_all_employeedetail1_data->execute([':jo_number'=> $namejo]);  
   while ($result = $get_all_employeedetail1_data->fetch(PDO::FETCH_ASSOC)) {
    $code =  $result['Amount'];
     $jonumber=  $result['JobOrderNo'];
 
 

   }

  $data = array(
    'statuscode' => 200,
    'data' => number_format($code,2),
    'code1' => $code,
    'message' => 'success'
  );
  echo json_encode($data);
  
}

?>