<?php
    
 include('../config/db_config.php');
   if (isset($_POST['update'])) {

       $emp_id = $_POST['ID'];
    

        $emp_name1 = $_POST['Employer1Name'];
        $emp_designation1 = $_POST['Employer1Designation'];
        $emp_salary1 = $_POST['Employer1CTC'];
        $emp_duration1 = $_POST['Employer1WorkDuration'];
        $emp_name2 = $_POST['Employer2Name'];
        $emp_designation2 = $_POST['Employer2Designation'];
        $emp_salary2 = $_POST['Employer2CTC'];
        $emp_duration2 = $_POST['Employer2WorkDuration'];
        $emp_name3= $_POST['Employer3Name'];
        $emp_designation3 = $_POST['Employer3Designation'];
        $emp_salary3 = $_POST['Employer3CTC'];
        $emp_duration3 = $_POST['Employer3WorkDuration'];


    
    // check if travelno number is available to avoid duplciation
    $sql ="UPDATE empexperience SET Employer1Name   = '$emp_name1',
               Employer1Designation        = '$emp_designation1',
               Employer1CTC                = '$emp_salary1',
               Employer1WorkDuration      = '$emp_duration1',
               Employer2Name              = '$emp_name2',
               Employer2Designation       = '$emp_designation2',
               Employer2CTC               = '$emp_salary2',
               Employer2WorkDuration      = '$emp_duration2',
               Employer3Name              ='$emp_name3',
               Employer3Designation       = '$emp_designation3',
               Employer3CTC                = '$emp_salary3',
               Employer3WorkDuration      = '$emp_duration3'

        WHERE   ID                = '$emp_id'  

     ";
            
    if($con->query($sql)){
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
