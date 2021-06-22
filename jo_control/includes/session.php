<?php


session_start();
include ('../config/db_config.php');

$user_id = $_SESSION['id'];

 $btnStatus = 'enabled';
 $btnNew = 'disbled';  
$btnAdd = 'enabled';

 $finalcount="0";
  $alert_msg = '';     
  $alert_msg1 = '';  
   $alert_msg3 = '';  
 $sss="";
  $pag_ibig="";
  $other="";
   $month="enabled";
 


//fetch user from database
$get_user_sql = "SELECT * FROM tbl_users where user_id = :id";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {

    $db_user = $result['user_id'];
    $db_first_name = $result['first_name'];
    $db_middle_name = $result['middle_name'];
    $db_last_name = $result['last_name'];
    $db_contact_number = $result['contact_no'];
    $db_position = $result['position'];
    $db_email_ad = $result['email'];
    $db_user_name = $result['username'];
    $db_location = $result['location'];
    $db_department = $result['Department'];
    

    }

    if (isset($_GET['id'])) {

  $schedule_id = $_GET['id'];
  // $user_id = $_SESSION['id  //select all data type
  $get_all_schedule_sql = "SELECT * FROM schedule WHERE id = :id";
  $get_all_schedule_data = $con->prepare($get_all_schedule_sql);
  $get_all_schedule_data->execute([':id'=> $schedule_id]);  
   while ($result = $get_all_schedule_data->fetch(PDO::FETCH_ASSOC)) {
    $id =  $result['id'];
    $no_jobOrder =  $result['JobOrderNo'];
    $no =  $result['no'];
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
       $get_total = ($get_day1*$get_rate1)+($get_day2*$get_rate2)+($get_day3*$get_rate3);
     $get_no =  $result['id_no'];
     $get_payrollno =  $result['PayrollNo'];
     $get_id_no =  $result['id_no'];
     
   }

 }

 if (isset($_GET['ID'])) {

  $emp_id = $_GET['ID'];
  // $user_id = $_SESSION['id  //select all data type
  $get_all_emp_sql = "SELECT * FROM `employeedetail` WHERE ID = :ID";
  $get_all_emp_data = $con->prepare($get_all_emp_sql);
  $get_all_emp_data->execute([':ID'=> $emp_id]);  
   while ($result = $get_all_emp_data->fetch(PDO::FETCH_ASSOC)) {
    $emp_code =  $result['EmpCode'];
    $emp_photo =  $result['EmpPhoto'];
          
   }

 }

if (isset($_GET['user_id'])) {

    //select filename
    $id_user = $_GET['user_id'];
    $get_user_data_sql = "SELECT * FROM tbl_users where user_id = :user_id";
    $get_user_data_data = $con->prepare($get_user_data_sql);
    $get_user_data_data->execute([':user_id' => $id_user]);
    while ($result = $get_user_data_data->fetch(PDO::FETCH_ASSOC)) {
    $get_db_user = $result['user_id'];
    $get_db_first_name = $result['first_name'];
    $get_db_middle_name = $result['middle_name'];
    $get_db_last_name = $result['last_name'];
    $get_db_contact_number = $result['contact_no'];
    $get_db_position = $result['position'];
    $get_db_email_ad = $result['email'];
    $get_db_user_name = $result['username'];
    $get_db_location = $result['location'];
    $get_db_password = $result['userpass'];
    $get_db_department = $result['Department'];

    
    }
}

if (isset($_GET['objid'])) {

    //select filename
    $new_job = $_GET['objid'];
    $get_job_data_sql = "SELECT * FROM createjo where objid = :objid";
    $get_job_data_data = $con->prepare($get_job_data_sql);
    $get_job_data_data->execute([':objid' => $new_job]);
    while ($result = $get_job_data_data->fetch(PDO::FETCH_ASSOC)) {
    $Job = $result['JobOrderNo'];
    $Bal = $result['PreviousBalance'];
}
}

if (isset($_GET['objid'])) {

    //select filename
    $details_no = $_GET['objid'];
    $get_details_data_sql = "SELECT * FROM `jo_details` where objid = :objid";
    $get_details_data_data = $con->prepare($get_details_data_sql);
    $get_details_data_data->execute([':objid' => $details_no]);
    while ($result = $get_details_data_data->fetch(PDO::FETCH_ASSOC)) {
    $JobOrder = $result['JobOrderNo'];
    $PayrollNo = $result['PayrollNo'];
    $scheds = $result['Schedules'];
    $amount1 = $result['Amount'];
    $laborers1 = $result['Laborers'];
    $filenames = $result['Filenames'];
}
}

if (isset($_GET['ID'])) {

    //select filename
    $id_emp = $_GET['ID'];
    $get_emp_data_sql = "SELECT * FROM employeedetail where ID = :ID";
    $get_emp_data_data = $con->prepare($get_emp_data_sql);
    $get_emp_data_data->execute([':ID' => $id_emp]);
    while ($result = $get_emp_data_data->fetch(PDO::FETCH_ASSOC)) {
    $get_emp_id = $result['ID'];
    $get_emp_fname = $result['EmpFname'];
    $get_emp_mname = $result['EmpMname'];
    $get_emp_lname = $result['EmpLname'];
    $get_emp_contact_number = $result['EmpContactNo'];
    $get_emp_designation = $result['EmpDesignation'];
    $get_emp_email= $result['EmpEmail'];
    $get_emp_gender = $result['EmpGender'];
    $get_emp_photo = $result['EmpPhoto'];
    $get_emp_department = $result['EmpDept'];
    $get_emp_code = $result['EmpCode'];
    $get_emp_joingdate = $result['EmpJoingdate'];
    $get_emp_address = $result['EmpAddress'];
    $get_emp_brgy = $result['EmpBrgy'];
    $get_emp_city = $result['EmpCity'];
    $get_emp_province = $result['EmpProvince'];
    $get_emp_skills = $result['EmpSkills'];
    $get_emp_status = $result['EmpStatus'];
    $get_status = $result['E_Status'];
    $get_emp_birth =$result['EmpBirth'];
    $get_emp_blood = $result['EmpBlood'];
    $get_emp_service = $result['EmpNoService'];
    $get_emp_eligibility = $result['EmpEligible'];
     $get_emp_now = $result['PostingDate'];
     $get_now=date('Y-m-d');
   $diff =  date_diff(date_create($get_emp_birth), date_create($get_now));
$get_age = $diff->format('%y');
    }
}



if (isset($_GET['ID'])) {

    //select filename
    $id_edu = $_GET['ID'];
    $get_edu_data_sql = "SELECT * FROM empeducation where ID = :ID";
    $get_edu_data_data = $con->prepare($get_edu_data_sql);
    $get_edu_data_data->execute([':ID' => $id_edu]);
    while ($result = $get_edu_data_data->fetch(PDO::FETCH_ASSOC)) {
    $get_edu_id = $result['ID'];
    $get_edu_att = $result['EduAttainment'];
    $get_edu_elem_sch = $result['ElementarySchool'];
    $get_edu_elem_yr = $result['ElementaryYear'];
    $get_edu_sec_sch = $result['SecondarySchool'];
    $get_edu_sec_yr = $result['SecondaryYear'];
    $get_edu_course = $result['CourseGra'];
    $get_edu_col_sch = $result['SchoolCollegeGra'];
    $get_edu_col_yr = $result['YearPassingGra'];
    $get_edu_award = $result['Awards'];
    }
}

if (isset($_GET['ID'])) {

    //select filename
    $id_no = $_GET['ID'];
    $get_id_no_data_sql = "SELECT * FROM no where ID = :ID";
    $get_id_no_data_data = $con->prepare($get_id_no_data_sql);
    $get_id_no_data_data->execute([':ID' => $id_no]);
    while ($result = $get_id_no_data_data->fetch(PDO::FETCH_ASSOC)) {
    $get_id_no = $result['ID'];
    $get_id_sss = $result['SssNo'];
    $get_id_pagibig = $result['PagIbigNo'];
    $get_id_ctc = $result['CtcNo'];
    $get_id_date = $result['CtcDate'];
    $get_id_place = $result['CtcAt'];
    $get_id_atm = $result['AtmNo'];
    $get_id_tin = $result['TinNo'];
    $get_id_phil = $result['PhilNo'];
       
    }
}


if (isset($_GET['ID'])) {

    //select filename
    $exp_id = $_GET['ID'];
    $get_exp_data_sql = "SELECT * FROM empexperience where ID = :ID";
    $get_exp_data_data = $con->prepare($get_exp_data_sql);
    $get_exp_data_data->execute([':ID' => $exp_id]);
    while ($result = $get_exp_data_data->fetch(PDO::FETCH_ASSOC)) {
    $get_exp_id = $result['ID'];
    $get_exp_emp1_name = $result['Employer1Name'];
    $get_exp_emp1_designation = $result['Employer1Designation'];
    $get_exp_emp1_salary = $result['Employer1CTC'];  
    $get_exp_emp1_duration = $result['Employer1WorkDuration'];
    $get_exp_emp2_name = $result['Employer2Name'];
    $get_exp_emp2_designation = $result['Employer2Designation'];
    $get_exp_emp2_salary = $result['Employer2CTC'];  
    $get_exp_emp2_duration = $result['Employer2WorkDuration'];
    $get_exp_emp3_name = $result['Employer3Name'];
    $get_exp_emp3_designation = $result['Employer3Designation'];
    $get_exp_emp3_salary = $result['Employer3CTC'];  
    $get_exp_emp3_duration = $result['Employer3WorkDuration'];
    }
}



if (isset($_GET['id'])) {

    //select filename
    $sched_id = $_GET['id'];
    $get_sched_data_sql = "SELECT * FROM schedule where id = :id ";
    $get_sched_data_data = $con->prepare($get_sched_data_sql);
    $get_sched_data_data->execute([':id' => $sched_id]);
    while ($result = $get_sched_data_data->fetch(PDO::FETCH_ASSOC)) {
    $get_sched_id = $result['id'];
    }
}




$get_total_rate_sql= "SELECT `createjo`.`JobOrderNo`, `schedule`.`JobOrderNo`, SUM(`schedule`.`TotalAmount`) as total FROM `createjo`left join `schedule` on `createjo`.`JobOrderNo`=`schedule`.`JobOrderNo`  where `createjo`.`JobOrderNo` IS NOT NULL group by `createjo`.`JobOrderNo";
$get_total_rate_data = $con->prepare($get_total_rate_sql);
$get_total_rate_data->execute();
$get_total_rate_data->setFetchMode(PDO::FETCH_ASSOC);
while ($result1 = $get_total_rate_data->fetch(PDO::FETCH_ASSOC)) {
  $finalcount =  $result1['total'];
  $finalcount_1 =  $result1['total'];
}



$get_nojo_sql= "SELECT COUNT(`objid`) as total FROM `createjo`";
$get_nojo_data = $con->prepare($get_nojo_sql);
$get_nojo_data->execute();
$get_nojo_data->setFetchMode(PDO::FETCH_ASSOC);
while ($result1 = $get_nojo_data->fetch(PDO::FETCH_ASSOC)) {
  $countjo =  $result1['total']; 
}
$JobNo =date('Y').'-'.$countjo;





$get_jo_sql= "SELECT `PreviousBalance` FROM `createjo`";
$get_jo_data = $con->prepare($get_jo_sql);
$get_jo_data->execute();
$get_jo_data->setFetchMode(PDO::FETCH_ASSOC);
while ($result1 = $get_jo_data->fetch(PDO::FETCH_ASSOC)) {
  $count =  $result1['PreviousBalance']; 
  $count_1 =  $result1['PreviousBalance'];

}



$get_final_sql= "SELECT `schedule`.`JobOrderNo`, COUNT(`createjo`.`JobOrderNo`) as total FROM  `createjo`left join  `schedule` on `createjo`.`JobOrderNo`=`schedule`.`JobOrderNo` where `createjo`.`JobOrderNo` IS NOT NULL group by `createjo`.`JobOrderNo`";
$get_final_data = $con->prepare($get_final_sql);
$get_final_data->execute();
$get_final_data->setFetchMode(PDO::FETCH_ASSOC);
while ($result1 = $get_final_data->fetch(PDO::FETCH_ASSOC)) {
  $totalcount =  $result1['total'];
}


$get_jo_sql= "SELECT * FROM `project`";
$get_jo_data = $con->prepare($get_jo_sql);
$get_jo_data->execute();
$get_jo_data->setFetchMode(PDO::FETCH_ASSOC);
while ($result1 = $get_jo_data->fetch(PDO::FETCH_ASSOC)) {
 
  $charges =  $result1['Charges'];
  $objid =  $result1['objid'];
  $project_budget =  $result1['ProjectBudget'];
}








$get_pay_sql= "SELECT COUNT(`objid`) as total FROM `payroll`";
$get_pay_data = $con->prepare($get_pay_sql);
$get_pay_data->execute();
$get_pay_data->setFetchMode(PDO::FETCH_ASSOC);
while ($result1 = $get_pay_data->fetch(PDO::FETCH_ASSOC)) {
 
  $payroll1 =$result1['total'];
  $payroll2 =$payroll1+1;
}

  $payroll = "P".date('Y')."_".$payroll2;


$get_pay_amount_sql= "SELECT SUM(`PayAmount`) as total FROM `payroll`";
$get_pay_amount_data = $con->prepare($get_pay_amount_sql);
$get_pay_amount_data->execute();
$get_pay_amount_data->setFetchMode(PDO::FETCH_ASSOC);
while ($result1 = $get_pay_amount_data->fetch(PDO::FETCH_ASSOC)) {
 
  $payrolltotal =$result1['total'];
}




$get_all_user_sql = "SELECT * FROM tbl_users";
$get_all_user_data = $con->prepare($get_all_user_sql);
$get_all_user_data->execute();

$get_all_user3_sql = "SELECT * FROM tbl_users";
$get_all_user3_data = $con->prepare($get_all_user3_sql);
$get_all_user3_data->execute();

$get_all_user1_sql = "SELECT * FROM tbl_users WHERE userStatus = 'Active'";
$get_all_user1_data = $con->prepare($get_all_user1_sql);
$get_all_user1_data->execute();

$get_all_user2_sql = "SELECT * FROM tbl_users WHERE userStatus = 'Inactive'";
$get_all_user2_data = $con->prepare($get_all_user2_sql);
$get_all_user2_data->execute();

$get_all_emp_sql = "SELECT * FROM employeedetail";
$get_all_emp_data = $con->prepare($get_all_emp_sql);
$get_all_emp_data->execute();

$get_att_sql = "SELECT * FROM eduattainment";
$get_att_data = $con->prepare($get_att_sql);
$get_att_data->execute();

$get_department_sql = "SELECT * FROM department";
$get_department_data = $con->prepare($get_department_sql);
$get_department_data->execute();

$get_details_sql = "SELECT * FROM jo_details";
$get_details_data = $con->prepare($get_details_sql);
$get_details_data->execute();

$get_year_sql = "SELECT * FROM year";
$get_year_data = $con->prepare($get_year_sql);
$get_year_data->execute();

$get_barangay_sql = "SELECT * FROM barangay";
$get_barangay_data = $con->prepare($get_barangay_sql);
$get_barangay_data->execute();

$get_department3_sql = "SELECT * FROM department";
$get_department3_data = $con->prepare($get_department3_sql);
$get_department3_data->execute();

$get_project_sql = "SELECT * FROM project";
$get_project_data = $con->prepare($get_project_sql);
$get_project_data->execute();

$get_period_sql = "SELECT * FROM period";
$get_period_data = $con->prepare($get_period_sql);
$get_period_data->execute();

$get_period_sql = "SELECT * FROM period";
$get_period_data = $con->prepare($get_period_sql);
$get_period_data->execute();

$get_rate_sql = "SELECT * FROM rate";
$get_rate_data = $con->prepare($get_rate_sql);
$get_rate_data->execute();

$get_time_sql = "SELECT * FROM timer ";
$get_time_data = $con->prepare($get_time_sql);
$get_time_data->execute();

$get_all_emp1_sql = "SELECT * FROM employeedetail WHERE E_Status = 'Active'  ORDER BY EmpLname";
$get_all_emp1_data = $con->prepare($get_all_emp1_sql);
$get_all_emp1_data->execute();

$get_time1_sql = "SELECT * FROM timer";
$get_time1_data = $con->prepare($get_time1_sql);
$get_time1_data->execute();

$get_time2_sql = "SELECT * FROM timer";
$get_time2_data = $con->prepare($get_time2_sql);
$get_time2_data->execute();

$get_time3_sql = "SELECT * FROM timer";
$get_time3_data = $con->prepare($get_time3_sql);
$get_time3_data->execute();


$get_rate1_sql = "SELECT * FROM rate";
$get_rate1_data = $con->prepare($get_rate1_sql);
$get_rate1_data->execute();

$get_rate2_sql = "SELECT * FROM rate";
$get_rate2_data = $con->prepare($get_rate2_sql);
$get_rate2_data->execute();

$get_schedule_sql = "SELECT * FROM schedule";
$get_schedule_data = $con->prepare($get_schedule_sql);
$get_schedule_data->execute();

$get_createjo_sql = "SELECT * FROM jo_details";
$get_createjo_data = $con->prepare($get_createjo_sql);
$get_createjo_data->execute();

$get_payroll_sql = "SELECT * FROM payroll";
$get_payroll_data = $con->prepare($get_payroll_sql);
$get_payroll_data->execute();

$get_sql = "SELECT * FROM sss";
$get_data = $con->prepare($get_sql);
$get_data->execute();

$get_pag_sql = "SELECT * FROM pag_ibig";
$get_pag_data = $con->prepare($get_pag_sql);
$get_pag_data->execute();


$get_combine_sql = "SELECT * FROM createjo INNER JOIN jo_details INNER JOIN schedule  WHERE `createjo`.`JobOrderNo` = `jo_details`.`JobOrderNo` AND `schedule`.`JobOrderNo`=  `jo_details`.`JobOrderNo` AND `schedule`.`no`= 1 ORDER BY `jo_details`.`JobOrderNo` DESC  ";
$get_combine_data = $con->prepare($get_combine_sql);
$get_combine_data->execute();


$get_sched_sql = "SELECT * FROM createjo INNER JOIN payroll INNER JOIN schedule WHERE `createjo`.`objid` = `payroll`.`id_no` AND `schedule`.`JobOrderNo` = `payroll`.`JobOrderNo` AND `schedule`.`no`= 1 ORDER BY `payroll`.`PreviousBalance` ASC ";
$get_sched_data = $con->prepare($get_sched_sql);
$get_sched_data->execute();

$get_sss_sql = "SELECT * FROM employeedetail INNER JOIN sss INNER JOIN no WHERE `sss`.`EmpCode` = `employeedetail`.`EmpCode` AND `sss`.`Empcode` = `no`.`EmpCode` ORDER BY `sss`. `PayrollNo` DESC";
$get_sss_data = $con->prepare($get_sss_sql);
$get_sss_data->execute();


$get_pag_sql = "SELECT * FROM pag_ibig INNER JOIN no INNER JOIN employeedetail WHERE `employeedetail`.`EmpCode`= `no`.`EmpCode`  AND `pag_ibig`.`EmpCode` = `no`.`EmpCode` ORDER BY `pag_ibig`. `PayrollNo` DESC";
$get_pag_data = $con->prepare($get_pag_sql);
$get_pag_data->execute();

$get_nopayroll_sql = "SELECT * FROM jo_details WHERE PayrollNo IS NULL";
$get_nopayroll_data = $con->prepare($get_nopayroll_sql);
$get_nopayroll_data->execute();

$get_namejo_sql= "SELECT `payroll`.`objid`,`schedule`.`id_no`,`payroll`.`PayrollNo`,`schedule`.`PayrollNo`,`schedule`.`FName`,`schedule`.`LName`,`schedule`.`MName` FROM  `schedule`left join  `payroll` on `payroll`.`objid`=`schedule`.`id_no` where `schedule`.`id_no` IS NOT NULL group by `schedule`.`id_no`";
$get_namejo_data = $con->prepare($get_namejo_sql);
$get_namejo_data->execute();



$get_payrollno_sql = "SELECT * FROM payroll INNER JOIN schedule INNER JOIN employeedetail INNER JOIN jo_details WHERE `schedule`.`JobOrderNo` = `payroll`.`JobOrderNo` AND `schedule`.`EmpCode` = `employeedetail`.`EmpCode`";
$get_payrollno_data = $con->prepare($get_payrollno_sql);
$get_payrollno_data->execute();


