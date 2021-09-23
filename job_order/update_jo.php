<?php
    
 include('../config/db_config.php');
   if (isset($_POST['update'])) {

        $jo_id = $_POST['id'];
        $jo_period = $_POST['Period'];
        $jo_days = $_POST['RegDays'];
        $jo_sched = $_POST['Schedule'];
        $jo_rate = $_POST['Rate'];    
        $jo_time = $_POST['Time1'];
         $jo_no_day1 = $_POST['Day1'];

         $jo_month1 = $_POST['Month1'];
          $jo_days1= $_POST['Days1'];
          $jo_time1 = $_POST['Time2'];
          $jo_rate1 = $_POST['Rate1'];
           $jo_day2 = $_POST['Day2'];
       
        $jo_month2 = $_POST['Month2'];
        $jo_days2= $_POST['Days2'];
        $jo_time2 = $_POST['Time3'];
        $jo_rate2 = $_POST['Rate2'];
        $jo_day3 = $_POST['Day3'];

        $jo_no = $_POST['no'];

        $jo_total= $_POST['TotalAmount'];

    
    // check if travelno number is available to avoid duplciation
    $sql ="UPDATE schedule SET Schedule   = '$jo_sched',
               Rate             = '$jo_rate',
               Period             = '$jo_period',
               RegDays             = '$jo_days',
               Month1             = '$jo_month1',
               Time1             =  '$jo_time',
               Day1             = '$jo_no_day1',
               Days1             = '$jo_days1',
               Time2             =  '$jo_time1',
               Rate1             =  '$jo_rate1',
               Day2             =  '$jo_day2',
              Month2             = '$jo_month2',
              Days2             = '$jo_days2',
              Time3             =  '$jo_time2',
              Rate2             =  '$jo_rate2',
              Day3             = '$jo_day3',
              no                = '$jo_no',
              TotalAmount       = '$jo_total'

        WHERE   id                = '$jo_id'  

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
