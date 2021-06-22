<?php


include ('../config/db_config.php');

if (isset($_GET['id'])) {

  $schedule_id = $_GET['id'];
  // $user_id = $_SESSION['id  //select all data type
  $get_all_schedule_sql = "SELECT * FROM `schedule` WHERE id = :id";
  $get_all_schedule_data = $con->prepare($get_all_schedule_sql);
  $get_all_schedule_data->execute([':id'=> $schedule_id]);  
   while ($result = $get_all_schedule_data->fetch(PDO::FETCH_ASSOC)) {
    $id =  $result['id'];
    $no_jobOrder =  $result['JobOrderNo'];
    $get_firstn =  $result['FName'];
     $get_middlen =  $result['MName'];
      $get_lastn =  $result['LName'];
    $get_sched_code =  $result['EmpCode'];
     $get_rate1 =  $result['Rate'];
     $get_rate2 =  $result['Rate1'];
     $get_rate3 =  $result['Rate2'];
      $get_month1 =  $result['Period'];
       $get_month2 =  $result['Month1'];
        $get_month3 =  $result['Month2'];
         $get_days1 =  $result['RegDays'];
         $get_days2 =  $result['Days1'];
          $get_days3 =  $result['Days2'];
  $get_time1 =  $result['Time1'];
  $get_time2 =  $result['Time2'];
  $get_time3 =  $result['Time3'];
  $get_schedule =  $result['Schedule'];
  $get_photo =  $result['EmpPhoto'];
     $get_day1 =  $result['Day1'];
         $get_day2 =  $result['Day2'];
          $get_day3 =  $result['Day3'];
       $get_total =  $result['TotalAmount'];
      
   }

 }

 if (isset($_GET['ID'])) {

  $emp_id = $_GET['ID'];
  // $user_id = $_SESSION['id  //select all data type
  $get_all_emp_sql = "SELECT * FROM `employeedetail` WHERE ID = :ID";
  $get_all_emp_data = $con->prepare($get_all_schedule_sql);
  $get_all_emp_data->execute([':ID'=> $emp_id]);  
   while ($result = $get_all_emp_data->fetch(PDO::FETCH_ASSOC)) {
    $emp_code =  $result['EmpCode'];
    $emp_photo =  $result['EmpPhoto'];
          
   }

 }
?>