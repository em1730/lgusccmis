<?php
    
 include('../config/db_config.php');
  if (isset($_POST['update'])) {
    

       $emp_id = $_POST['ID'];
        $emp_code = $_POST['EmpCode'];
        $emp_fname = $_POST['EmpFname'];
        $emp_mname = $_POST['EmpMname'];
        $emp_lname = $_POST['EmpLname'];
        $emp_address = $_POST['EmpAddress'];
        $emp_brgy = $_POST['EmpBrgy'];
        $emp_city = $_POST['EmpCity'];
        $emp_province = $_POST['EmpProvince'];
        $emp_birth = date('Y-m-d', strtotime($_POST['EmpBirth']));
     
        $emp_blood = $_POST['EmpBlood'];
        $emp_status = $_POST['EmpStatus'];
        $emp_gender = $_POST['EmpGender'];
        $emp_skills = $_POST['EmpSkills'];
        $emp_designation = $_POST['EmpDesignation'];
        $emp_joining = date('Y-m-d', strtotime($_POST['EmpJoingdate']));
        $emp_service = $_POST['EmpNoService'];
        $emp_eligible = $_POST['EmpEligible'];
        $emp_email = $_POST['EmpEmail'];
        $emp_department = $_POST['EmpDept'];
        $emp_contact = $_POST['EmpContactNo'];
     
       


       
    
    // check if travelno number is available to avoid duplciation
       $sql ="UPDATE employeedetail SET EmpFname   = '$emp_fname',
               EmpCode               = '$emp_code',
               EmpMname              = '$emp_mname',
               EmpLname              = '$emp_lname',
               EmpAddress            = '$emp_address',
               EmpBrgy               = '$emp_brgy',
               EmpCity               = '$emp_city',
               EmpProvince           = '$emp_province',
               EmpBirth              = '$emp_birth',
            
               EmpBlood              = '$emp_blood',
               EmpStatus             = '$emp_status',
               EmpGender             = '$emp_gender',
               EmpSkills             = '$emp_skills',
               EmpJoingdate          = '$emp_joining',
               EmpNoService          = '$emp_service',
               EmpEligible           = '$emp_eligible',
               EmpEmail              = '$emp_email',
               EmpContactNo          = '$emp_contact',
               EmpDept               = '$emp_department',
               EmpDesignation        = '$emp_designation'
                 


        WHERE  ID              = '$emp_id'  

     ";

     $sql1="UPDATE empeducation SET  EmpCode = '$emp_code' WHERE ID   = '$emp_id'";
     $sql2="UPDATE empexperience SET EmpCode = '$emp_code' WHERE ID   = '$emp_id'";
     $sql3="UPDATE no SET EmpCode = '$emp_code' WHERE ID   = '$emp_id';";
     $sql4="UPDATE pag_ibig SET EmpCode = '$emp_code'  WHERE Name   = '$emp_fname'";
     $sql5="UPDATE sss SET EmpCode = '$emp_code'  WHERE Name   = '$emp_fname'";
     $sql6="UPDATE schedule SET EmpCode = '$emp_code'  WHERE FName   = '$emp_fname'";

              
    if($con->query($sql) And $con->query($sql1) And $con->query($sql2) And $con->query($sql3) And $con->query($sql4) And $con->query($sql5) And $con->query($sql6)){
            $alert_msg .= '<div class="alert alert-success alert-dismissible"><i class="icon fa fa-check"></i>Successfully Updated</div>';
    }
        else{
            $_SESSION['error'] = $con->error;
        }
    }
    else{
        $_SESSION['error'] = 'Fill up edit form first';
    }
  
?>