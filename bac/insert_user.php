<?php
  include('../config/db_config.php');

  $alert_msg = '';     

  //if button insert clicked

  if (isset($_POST['insert'])) {

    $fname = $_POST['firstname'];
    $mname = $_POST['middlename'];
    $lname = $_POST['lastname'];
    $contact_number = $_POST['contact_number'];
    $position = $_POST['position'];
    $email = $_POST['email'];
    $uname = $_POST['username'];
    $upassword = $_POST['password'];
    $account = $_POST['account_type'];
    $department = $_POST['dept'];

    //length of $contact_number
    $con_number = strlen($contact_number);
    
    if ($con_number != 11) {
      $alert_msg .= ' 
          <div class="new-alert new-alert-warning alert-dismissible">
              <i class="icon fa fa-warning"></i>
              Contact Number must be 11 digit.
          </div>     
      ';
    }
    else {

      //hash the password
      $hashed_password  = password_hash($upassword, PASSWORD_DEFAULT);
      //insert user to database
      $register_user_sql = "INSERT INTO tbl_users SET 
        first_name     = :fname,
        middle_name    = :mname,
        last_name      = :lname,
        contact_no = :contact_number,
        position       = :position,
        email          = :email,
        username       = :uname,
        userpass       = :upass,
        account_type   = :account,
        department     = :department";

      $register_data = $con->prepare($register_user_sql);
      $register_data->execute([
        ':fname'          => $fname,
        ':mname'          => $mname,
        ':lname'          => $lname,
        ':contact_number' => $contact_number,
        ':position' => $position,
        ':email'          => $email,

        ':uname'          => $uname,
        ':upass'          => $hashed_password,
        ':account'   =>   $account,
        ':department'   => $department,
      ]);

      $alert_msg .= ' 
          <div class="new-alert new-alert-success alert-dismissible">
              <i class="icon fa fa-success"></i>
              Data Inserted
          </div>     
      ';
     // $fname = $mname = $lname = $contact_number = $email = $uname = $upass = '';

     $btnStatus = 'disabled';
     $btnNew = 'enabled';
    }

  }

 

 
?>