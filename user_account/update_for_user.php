<?php
include('../config/db_config.php');


$alert_msg = '';

if (isset($_POST['update_for_user.php'])) {
  //to check if data are passed

  $users_id = $result['user_id'];
  $first_name = $result['first_name'];
  $middle_name = $result['middle_name'];
  $last_name = $result['last_name'];
  $contact_no = $result['contact_no'];
  $position = $result['position'];
  $email = $result['email'];
  $username = $result['username'];
  $userpass = $result['userpass'];
  $account_type = $result['account_type'];
  $get_department = $result['department'];
  $location = $result['location'];
  $status = $result['status'];


  //update tbl users do not include password
  $update_users_sql = "UPDATE tbl_users SET
                user_id        = :id,
                first_name     = :first_name,
                middle_name    = :middle_name,
                last_name      = :last_name,
               contact_no     =  :contact_no,
               position       =   :position,
                email         =   :email,
                username      = :username,
                -- userpass      = :userpass,
                account_type  = :account_type,
                department    = :department,
                location      = :location,
                status        = :status,
                WHERE user_id   = :id";

  $update_data = $con->prepare($update_users_sql);
  $update_data->execute([
    ':id'             => $user_id,
    ':first_name'     => $first_name,
    ':middle_name'    => $middle_name,
    ':last_name'      => $last_name,
    ':contact_no'     => $contact_no,
    ':position'       => $position,
    ':email'          => $email,
    ':username'       => $username,
    ':account_type'   => $account_type,
    ':department'     => $department,
    ':location'       => $location,
    ':status'         => $status

  ]);




  $alert_msg .= ' 
              <div class="new-alert new-alert-success alert-dismissible">
                  <i class="icon fa fa-success"></i>
                  Data Updated.
              </div>     
            ';
}
