<?php
  include('../config/db_config.php');

  $alert_msg = '';     
  

  if (isset($_POST['insert'])) {

           echo "<pre>";
       print_r($_POST);
    echo "</pre>";


    $empNo = $_POST['empno'];
    $empFullname = $_POST['empfullname'];
    $empPosition = $_POST['empposition'];
    $empDepartment = $_POST['empoffice'];

    $currentDir = getcwd();
    $uploadDirectory = "../dist/photo/";

    $errors = [];

    $fileExtensions = ['png','jpg','jpeg','gif'];

    $fileName = $_FILES['myFile']['name'];
    $fileSize = $_FILES['myFile']['size'];
    $fileTmpName = $_FILES['myFile']['tmp_name'];
    $fileType = $_FILES['myFile']['type'];
    $target_file = $uploadDirectory . basename($_FILES['myFile']['name']);
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
    }    

       $insert_employee_sql  = "INSERT INTO employee SET 
        empid               = :empNo,
        fullname            = :empName,
        position            = :empPosition,
        office              = :empOffice,
        photo            = :filename
       
        ";

      $employee_data = $con->prepare($insert_employee_sql);
      $employee_data->execute([
        ':empNo'             => $empNo, 
        ':empName'           => $empFullname,
        ':empPosition'       => $empPosition,
        ':empOffice'         => $empDepartment,
        ':filename'          => $fileName
      ]);

      $alert_msg .= ' 
          <div class="alert alert-success alert-dismissible">
              <i class="icon fa fa-success"></i>
             Successfully Added!
          </div>     
      ';
     // $fname = $mname = $lname = $contact_number = $email = $uname = $upass = '';

     $btnStatus = 'disabled';
     $btnNew = 'enabled';
header('location: employee.php');
    }
 
?>