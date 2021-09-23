<?php
    
 include('../config/db_config.php');
   if (isset($_POST['update'])) {

       $emp_id = $_POST['ID'];
    

        $emp_sss = $_POST['SssNo'];
        $emp_tin = $_POST['TinNo'];
        $emp_ctc_no = $_POST['CtcNo'];
        $emp_pag_ibig = $_POST['PagIbigNo'];
        $emp_atm_no = $_POST['AtmNo'];
        $emp_ctc_date = date('Y-m-d', strtotime($_POST['CtcDate']));
        $emp_ctc_at = $_POST['CtcAt'];
        $emp_philhealth = $_POST['PhilNo'];




    
    // check if travelno number is available to avoid duplciation
    $sql ="UPDATE no SET SssNo   = '$emp_sss',
               TinNo              = '$emp_tin',
               CtcNo              = '$emp_ctc_no',
               PagIbigNo          = '$emp_pag_ibig',
               AtmNo              = '$emp_atm_no',
               CtcDate            = '$emp_ctc_date',
               CtcAt              = '$emp_ctc_at',
               PhilNo             = '$emp_philhealth'

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
