 <?php

include ('../config/db_config.php');
//include('import_pdf.php');


$alert_msg = '';
$alert_msg1 = '';
if (isset($_POST['insert_employee'])) {

    //     echo "<pre>";
    //     print_r($_POST);
    // echo "</pre>";
    // $idnumber = $_POST['idnumber'];
    $emp_number  = $_POST['empNumber'];
    $last        = $_POST['lastname']; 
    $fname       = $_POST['firstname'];
    $middle      = $_POST['middlename'];
    $emp_type    = $_POST['emp_type'];
    $designation = $_POST['designation']; 
    $department  = $_POST['department'];   
    $status      = $_POST['status']; 
   
    $insert_employee_sql = "INSERT INTO tbl_employee SET 
        EmployeeNo         = :empNo,
        LastName           = :lname,
        FirstName          = :fname,
        MiddleName         = :mname,
        EmploymentType     = :empType,
        DesignationCode    = :degCode,
        DepartmentCode     = :deptCode,
        Status             = :status";
        
    $employee_data = $con->prepare($insert_employee_sql);
    $employee_data->execute([
         ':empNo'          => $emp_number,
         ':lname'          => $last,
         ':fname'          => $fname,
         ':mname'          => $middle,
         ':empType'        => $emp_type,
         ':degCode'        => $designation,
         ':deptCode'       => $department,
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