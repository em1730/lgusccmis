<?php
    
 include('../config/db_config.php');
   if (isset($_POST['update'])) {

       $emp_id = $_POST['ID'];
    

        $emp_attain = $_POST['EduAttainment'];
        $emp_course = $_POST['CourseGra'];
        $emp_awards = $_POST['Awards'];
        $emp_elem_sch = $_POST['ElementarySchool'];
        $emp_elem_year = date('Y-m-d', strtotime($_POST['ElementaryYear']));
        $emp_sec_sch = $_POST['SecondarySchool'];
        $emp_sec_year = date('Y-m-d', strtotime($_POST['SecondaryYear']));
        $emp_col_sch = $_POST['SchoolCollegeGra'];
        $emp_col_year = date('Y-m-d', strtotime($_POST['YearPassingGra']));




    
    // check if travelno number is available to avoid duplciation
    $sql ="UPDATE empeducation SET EduAttainment   = '$emp_attain',
               CourseGra             = '$emp_course',
               Awards                = '$emp_awards',
               ElementarySchool      = '$emp_elem_sch',
               ElementaryYear        = '$emp_elem_year',
               SecondarySchool       = '$emp_sec_sch',
               SecondaryYear         = '$emp_sec_year',
               SchoolCollegeGra      = '$emp_col_sch',
               YearPassingGra        ='$emp_col_year'

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
