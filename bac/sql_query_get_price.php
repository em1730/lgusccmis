<?php


include ('../config/db_config.php');

if (isset($_POST['pr_item'])) {


  $item = $_POST['pr_item'];
  $price = '';
  $unit = '';
  $itemname = '';
  $description = '';
  

  // $user_id = $_SESSION['id  //select all data type
  $get_all_item_sql = "SELECT * FROM `tbl_items` WHERE itemcode = :item";
  $get_all_item_data = $con->prepare($get_all_item_sql);
  $get_all_item_data->execute([':item'=> $item]);  
   while ($result = $get_all_item_data->fetch(PDO::FETCH_ASSOC)) {
    
    
    $price =  $result['price'];
    $unit =  $result['unit'];
    $itemname =  $result['itemname'];
    $description =  $result['description'];
    $price2 =  $result['price'];

   
 
   }

  $data = array(
    'statuscode' => 200,
    'data' => $price,
    'data1' => $unit,
    'data2' => $itemname,
    'data3' => $description,
    'data4' => $price2,


  
    'message' => 'success'
  );
  echo json_encode($data);










}
?>