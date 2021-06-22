<?php 
	include 'includes/session.php';
  
if (isset($_POST['id'])) {

    //select filename
    $getEmpno = $_POST['id'];
    $get_emp_sql = "SELECT * FROM employee where empid = :id";
    $get_emp_data = $con->prepare($get_emp_sql);
    $get_emp_data->execute([':id' => $getEmpno]);
    while ($result = $get_emp_data->fetch(PDO::FETCH_ASSOC)) {
        $empNO = $result['empid'];
        $update_fullname = $result['fullname'];
        $get_designation = $result['position'];
        $get_office = $result['office'];
     
  
}

$row = array(
  'empid'                   => $empNO,
  'fullname'                => $update_fullname,
  'position'                => $get_designation,
  'office'                  => $get_office,
 
  );
    echo json_encode($row);
    
	}
?>