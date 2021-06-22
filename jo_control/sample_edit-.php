<?php

include ('../config/db_config.php');


$alert_msg = '';
$alert_msg1 = '';
$alert_msg2 = '';
if (isset($_POST['update_employee_profile'])) {

    $emp_id = $_POST['id'];
    $emp_id2 = $_POST['id2'];
    $emp_fname = $_POST['firstname'];
    $emp_mname = $_POST['middlename'];
    $emp_lname = $_POST['lastname'];
    $emp_code = $_POST['code'];

    $emp_address = $_POST['address'];
    $emp_brgy =  $_POST['brgy'];
    $emp_skills =  $_POST['skills'];
    $emp_status =  $_POST['status'];
    $emp_blood =  $_POST['blood'];
    $emp_age =  $_POST['age'];
    $emp_birth = date('Y-m-d', strtotime($_POST['dateBirth']));
    $emp_city =  $_POST['city'];
    $emp_province =  $_POST['province'];
    $emp_designation = $_POST['designation'];
    $emp_dept = $_POST['dept'];
    $emp_startingdate = date('Y-m-d', strtotime($_POST['dateStart']));
    $emp_email = $_POST['email'];
    $emp_eligible =  $_POST['eligibility'];
    $emp_years =  $_POST['years'];
    $emp_contact_number = $_POST['contact_number'];

   
   //PHOTO DETAILS
    $currentDir = getcwd();
    $uploadDirectory = "../dist/photo/";

    $errors = [];

    $fileExtensions = ['png','jpg','jpeg','gif',''];

    $fileName = $_FILES['myFiles']['name'];
    $fileSize = $_FILES['myFiles']['size'];
    $fileTmpName = $_FILES['myFiles']['tmp_name'];
    $fileType = $_FILES['myFiles']['type'];
    $target_file = $uploadDirectory . basename($_FILES['myFiles']['name']);
    $fileExtension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // $fileExtension = strtolower(end(explode('.',$fileName)));
    $uploadPath = $uploadDirectory . basename($fileName);

    if (!in_array($fileExtension, $fileExtensions)) {
        $errors[] = "This file extension is not allowed.";
    }
    if (empty($errors)) {
        $dipUpload = move_uploaded_file($fileTmpName, $uploadPath);


        if ($dipUpload) {
            $alert_msg1 .= ' 
       <div class="table-bordered">
           <i class="icon fa fa-success"></i>
           File has been uploaded
       </div>     
   ';
            // $fname = $mname = $lname = $contact_number = $email = $uname = $upass = '';


        } else {
            $alert_msg1 .= ' 
       <div class="alert alert-warning alert-dismissible"">
           <i class="icon fa fa-warning"></i>
           An Error Occured;
       </div>     
   ';
            // $fname = $mname = $lname = $contact_number = $email = $uname = $upass = '';

            $btnStatus = 'disabled';
            $btnNew = 'disabled';
        }
    } else {
        foreach ($errors as $error) {
            echo $error . "These are the errors" . "\n";

        }
    }
  
    
    $update_employee_profile_sql  = "UPDATE employeedetail SET 
    ID             =      :id,
    EmpFname       =      :fname,
    EmpMname       =      :$emp_mname,  
    EmpLname       =      :lname,
    EmpCode        =      :code,
    EmpPhoto       =      :fileName,

    EmpAddress     =      :address,
    EmpJoingdate   =      :dateStart,
    EmpBrgy        =      :brgy,
    EmpSkills      =      :skills,
    EmpStatus      =      :status,
    EmpBlood       =      :blood,
    EmpAge         =      :age,
    EmpBirth       =      :dateBirth,
    EmpCity        =      :city,
    EmpProvince    =      :province,
    EmpContactNo   =      :contact_number,
    EmpEmail       =      :email,
    EmpDesignation =      :designation,
    EmpDept        =      :dept,
    EmpEligible   =       :eligible,
    EmpNoService =        :years

    Where ID        =     :emp_id2
         ";

    $update_employee_data = $con->prepare($update_employee_profile_sql);
     $update_employee_data->execute([
   ':id'              =>  $emp_id,
    ':fname'           =>     $emp_fname,
    ':mname'           =>     $emp_mname,  
    ':lname'           =>     $emp_lname,
    ':code'            =>     $emp_code,
    ':filename'        =>     $fileName,
 
    ':address'         =>     $emp_address,
    ':dateStart'       =>     $emp_startingdate,
    ':brgy'            =>     $emp_brgy,
    ':skills'          =>     $emp_skills,
    ':status'          =>     $emp_status,
    ':blood'           =>     $emp_blood,
    ':age'             =>     $emp_age,
    ':dateBirth'       =>     $emp_birth,
    ':city'            =>     $emp_city,
    ':province'        =>     $emp_province,
    ':contact_number'  =>     $emp_contact_number,
    ':email'           =>     $emp_email,
    ':designation'     =>     $emp_designation,
    ':dept'            =>     $emp_dept,
    ':eligible'        =>     $emp_eligible,
    ':years'            =>    $emp_years,

    ':emp_id2'             =>     $emp_id2


      ]);

     $alert_msg .= ' 
     <div class="alert alert-success alert-dismissible">
    <i class="icon fa fa-warning"></i>
    Data updated!
    </div>     
      ';
      }
?>



