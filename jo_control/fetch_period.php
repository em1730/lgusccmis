
<?php


include ('../config/db_config.php');

if (isset($_POST['jo_period'])) {

  $namejo = $_POST['jo_period'];
  $code = '';
 

 
  // $user_id = $_SESSION['id  //select all data type
  $get_all_employeedetail1_sql = "SELECT * FROM `createjo` WHERE JobOrderNo = :jo_number";
  $get_all_employeedetail1_data = $con->prepare($get_all_employeedetail1_sql);
  $get_all_employeedetail1_data->execute([':jo_number'=> $namejo]);  
   while ($result = $get_all_employeedetail1_data->fetch(PDO::FETCH_ASSOC)) {
    $code =  $result['PeriodCovered'];
    $id_number = $result['objid'];
     $jonumber=  $result['JobOrderNo'];
       $amount=  $result['PreviousBalance'];
 	$charges=  $result['Charges'];
 
   }


  $data = array(
    'statuscode' => 200,
    'data' => $code,
    'amount' => $amount,
    'charges' => $charges,
    'objid' => $id_number,
    'message' => 'success'
  );
  echo json_encode($data);
  
}

?>