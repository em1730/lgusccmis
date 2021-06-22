 <?php

include ('../config/db_config.php');
//include('import_pdf.php');


$alert_msg = '';
$alert_msg1 = '';
if (isset($_POST['insert_users.php'])) {

    //     echo "<pre>";
    //     print_r($_POST);
    // echo "</pre>";
    // $idnumber = $_POST['idnumber'];
    $users_id = $_POST['controlNumber'];
    $first_name = $_POST['firstname'];
    $middle_name= $_POST['middlename'];
    $last_name = $_POST['lastname'];
    $contact_no = $_POST['contact_no'];
    $position = $_POST['position'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $userpass = $_POST['userpass'];
    $account_type = $_POST['account_type'];
    $department = $_POST['department'];
    $location = $_POST['location'];
    $status = $_POST['status'];
    
    $insert_users_sql = "INSERT INTO tbl_users SET 
        users_id               = :user_id,
        -- joId             = :joid,
        first_name           = :first_name,
        middle_name          = :middle_name,
        last_name            = :last_name,
        contact_no            = :contact_no,
        position              = :position,
        email                  = :email,
        username            = :username,
        userpass              = :userpass,
        account_type           = :account_type,
        department          = :department,
        location            = :location,
        status              = :status";
        
    $users_data = $con->prepare($insert_users_sql);
    $users_data->execute([
         ':id'             => $user_id,
        // ':joid'           => $idnumber,
        ':first_name'          => $first_name,
        ':middle_name'          => $middle_name, 
        ':last_name'          => $last_name,
        ':contact_no'      => $contact_no,
        ':position'           => $position,
        ':email'           => $email,
        ':username'           => $username,
        ':userpass'           => $ruserpass,
        ':account_type'           => $account_type,
        ':department'           => $department,
        ':location'           => $location,
        ':status'         => $status


        
        ]);

    $alert_msg .= ' 
          <div class="new-alert new-alert-success alert-dismissible">
              <i class="icon fa fa-success"></i>
              Data Inserted
          </div>     
      ';
    
    $btnStatus = 'disabled';
    $btnNew = 'enabled';
    }


?>