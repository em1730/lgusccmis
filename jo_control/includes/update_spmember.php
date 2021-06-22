<?php
    include('../config/db_config.php');


  $alert_msg = '';
  $alert_msg1 ='';
    if (isset($_POST['update_profile'])){
         //to check if data are passed
    
    $empID = $_POST['objid'];
    $fullName = $_POST['fullname'];
    $email = $_POST['email'];
    $contact_number = $_POST['contact_number'];
    $committee =$_POST['committee'];

     $currentDir = getcwd();
    $uploadDirectory = "../dist/pic/";

    $errors = [];

    $fileExtensions = ['png','jpg','jpeg',];

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
            echo $error . "Thses are the errors" . "\n";

        }
    }

        $update_spmember_sql = "UPDATE sp_members SET 
        fullname            = :fullname,
        contactno           = :contactno,
        email               = :email,
        committee           = :committee,
        location            = :filenames

        where  objid               = :id";
    
          $update_data = $con->prepare($update_spmember_sql);
          $update_data->execute([
        ':fullname'         => $fullName,
        ':contactno'        => $contact_number,
        ':email'            => $email,
        ':committee'        => $committee,
        ':filenames'        => $fileName,

         ':id'               => $empID
          ]);
          
           $alert_msg .= ' 
              <div class="new-alert new-alert-success alert-dismissible">
                  <i class="icon fa fa-success"></i>
                  Data Updated.
              </div>     
            ';

} 
    
?>