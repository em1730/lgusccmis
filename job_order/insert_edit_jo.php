<?php
  include('../config/db_config.php');

  $alert_msg = '';     
  

  if (isset($_POST['insert'])) {


    $jo_no = $_POST['jo_no'];
    $no = $_POST['new_number'];
    $jo_name = $_POST['name'];
    $jo_schedule = $_POST['schedule'];
    $jo_rate = $_POST['rate'];
     $jo_period = $_POST['period'];
     $jo_regdays = $_POST['jo_regdays'];
    $jo_time = $_POST['time1'];
    $jo_empcode = $_POST['empcode'];
    $jo_middle = $_POST['jo_middle'];
    $jo_last = $_POST['jo_last'];
    $jo_photo = $_POST['jo_photo'];
    $jo_total = $_POST['jo_total'];
    $jo_month1 = $_POST['jo_month1'];
    $jo_days1 = $_POST['jo_days1'];
    $jo_time1 = $_POST['jo_time1'];
    $jo_rate1 = $_POST['jo_rate1'];
    $jo_month2 = $_POST['jo_month2'];
    $jo_days2 = $_POST['jo_days2'];
    $jo_years = date('Y', strtotime($_POST['jo_years']));
    $jo_time2 = $_POST['jo_time2'];
    $jo_rate2 = $_POST['jo_rate2'];
    $jo_no_days = $_POST['jo_no_days'];
     $jo_day1 = $_POST['jo_day1'];
     $jo_day2 = $_POST['jo_day2'];
     $jo_day3 = $_POST['jo_day3'];
    $jo_total_amount = ($jo_rate * $jo_day1) + ($jo_rate1 * $jo_day2) + ($jo_rate2 * $jo_day3);
      
    $insert_schedule_sql  = "INSERT INTO schedule SET 
        JobOrderNo               = :jo_no,
        id_no                     = :new_number,
        EmpPhoto                  = :jo_photo,
        FName                     = :name,
        Schedule                 = :schedule,
        Rate                     = :rate,
        Period                   = :period,
         RegDays                   = :jo_regdays,
        Years                   = :jo_years,
        Time1                    = :time1,
        EmpCode                  = :empcode,
        MName                    = :jo_middle,
        LName                    = :jo_last,
        no                       = :jo_total,
        Month1                  = :jo_month1,
        Days1                    = :jo_days1,
        Time2                    = :jo_time1,
        Rate1                    = :jo_rate1,
        Month2                  = :jo_month2,
        Days2                    = :jo_days2,
        Time3                    = :jo_time2,
        Rate2                    = :jo_rate2,
        NoDays                   = :jo_no_days,
        Day1                     = :jo_day1,
         Day2                     = :jo_day2,
          Day3                     = :jo_day3,
          TotalAmount             =:jo_total_amount
        ";

      $schedule_data = $con->prepare($insert_schedule_sql);
      $schedule_data->execute([
        ':jo_no'             => $jo_no, 
         ':new_number'             => $no, 
        ':jo_photo'          => $jo_photo,
        ':name'              => $jo_name,
        ':schedule'          => $jo_schedule,
        ':period'         => $jo_period,
        ':jo_regdays'         => $jo_regdays,
        ':jo_years'         => $jo_years,
        ':rate'              => $jo_rate,
        ':time1'             => $jo_time,
        ':empcode'           => $jo_empcode,
        ':jo_middle'         => $jo_middle,
        ':jo_last'           => $jo_last,
        ':jo_total'         => $jo_total,
        ':jo_month1'        => $jo_month1,
        ':jo_days1'         => $jo_days1,
        ':jo_time1'           => $jo_time1,
        ':jo_rate1'         => $jo_rate1,
        ':jo_month2'        => $jo_month2,
        ':jo_days2'         => $jo_days2,
        ':jo_time2'           => $jo_time2,
        ':jo_rate2'         => $jo_rate2,
         ':jo_no_days'         => $jo_no_days,
         ':jo_day1'         => $jo_day1,
         ':jo_day2'         => $jo_day2,
         ':jo_day3'         => $jo_day3,
         ':jo_total_amount'   => $jo_total_amount
      ]);

      $alert_msg .= ' 
          <div class="alert alert-success alert-dismissible">
              <i class="icon fa fa-success"></i>
             Proceed to continue!
          </div>     
      ';
     // $fname = $mname = $lname = $contact_number = $email = $uname = $upass = '';

     $btnStatus = 'disabled';
 
   
header('location: create_job_order_edit1.php?objid=<?php echo $no?>');
}

?>

 
