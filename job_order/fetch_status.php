<?php 
	include 'includes/session.php';
  
	if(isset($_POST['id'])){
    
	 $travelNo = $_POST['id'];
		$get_number_sql = "SELECT * FROM alltravelorder WHERE travelOrderNo = :id";
    $get_number_data = $con->prepare($get_number_sql);
    $get_number_data->execute([':id'=>$travelNo]);
    while ($result2 = $get_number_data->fetch(PDO::FETCH_ASSOC)) {

  $travelNumber = $result2['travelOrderNo'];
    $travelStatus = $result2['Status'];
  
}

$row = array(
  'travelOrderNo'         => $travelNumber,
  'Status'                => $travelStatus,
  );
    echo json_encode($row);
    
	}
?>