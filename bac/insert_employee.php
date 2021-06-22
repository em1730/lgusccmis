 <?php

include ('../config/db_config.php');
//include('import_pdf.php');

$myID = uniqid('id',true);

$alert_msg = '';
$alert_msg1 = '';
if (isset($_POST['insert_employee'])) {

    //     echo "<pre>";
    //     print_r($_POST);
    // echo "</pre>";
    
    $idnumber = $_POST['idnumber'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $birth = date('Y-m-d', strtotime($_POST['birthdate']));
    $department = $_POST['department'];
    $position = $_POST['positions'];
    $section = $_POST['section'];
    $contact_no = $_POST['contact'];
    $status = $_POST['status'];
    $datecreated = date('Y-m-d', strtotime($_POST['datecreated']));


    
   
    $insert_employee_sql ="INSERT INTO tbl_employee SET 
            objid                    = :unique,
            empID                    = :empids,
            first_name               = :fname,
            middle_name              = :mname,
            last_name                = :lname,
            address                  = :add,
            birthdate                = :birth,
            department               = :dept,
            position                 = :pos,
            section                  = :sec,
            contactno                = :contact,
            datecreated              = :created,
            status                   = :stat";


        
    $emp_data = $con->prepare($insert_employee_sql);
    $emp_data->execute([
        ':unique'               => $myID, 
        ':empids'               => $idnumber,
        ':fname'                => $firstname,
        ':mname'                => $middlename,
        ':lname'                => $lastname,
        ':add'                  => $address,
        ':birth'                => $birth,
        ':dept'                 => $department,
        ':pos'                  => $position,
        ':sec'                  => $section,
        ':contact'              => $contact_no,
        ':created'              => $datecreated,
        ':stat'                 => $status
        
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