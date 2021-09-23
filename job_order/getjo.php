<?php 
	include 'includes/session.php';
  
if (isset($_POST['objid'])) {

    //select filename
    $getEmpno = $_POST['objid'];
    $get_emp_sql = "SELECT * FROM createjo where objid = :objid";
    $get_emp_data = $con->prepare($get_emp_sql);
    $get_emp_data->execute([':id' => $getEmpno]);
    while ($result = $get_emp_data->fetch(PDO::FETCH_ASSOC)) {
        $get_jono = $result['JobOrderNo'];

}

$row = array(
  'empid'                   => $get_jono,
 
 
  );
    echo json_encode($row);
    
	}
?>