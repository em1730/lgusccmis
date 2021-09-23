<?php


	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM employee WHERE empid = '$id'";
		if($con->query($sql)){
			$_SESSION['success'] = "<i class='icon fa fa-check'></i>Successfully Deleted";
		}
		else{
			$_SESSION['error'] = $con->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location: employee.php');
	

?>