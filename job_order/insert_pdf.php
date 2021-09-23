<?php
  include('../config/db_config.php');

  $alert_msg = '';     
  $alert_msg1 = '';    

  //if button insert clicked

  if (isset($_POST['insert'])) {
    

    $joborno = $_POST['joborno'];
   

   if ( isset( $_FILES['pdfFile'] ) ) {
  if ($_FILES['pdfFile']['type'] == "application/pdf" or $_FILES['pdfFile']['type'] == "application/jpg") {
    $source_file = $_FILES['pdfFile']['tmp_name'];
    $dest_files = "../upload/".$_FILES['pdfFile']['name'];
  

    if (file_exists($dest_files)) {
      print "The file name already exists!!";
    }
    else {
      move_uploaded_file( $source_file, $dest_files )
      or die ("Error!!");
      if($_FILES['pdfFile']['error'] == 0) {
       $alert_msg =  "Pdf file uploaded successfully!";
       $alert_msg = "<b><u>Details : </u></b><br/>";
       $alert_msg =  "File Name : ".$_FILES['pdfFile']['name']."<br.>"."<br/>";
       $alert_msg =  "File Size : ".$_FILES['pdfFile']['size']." bytes"."<br/>";
      $alert_msg = "File location : ../upload/".$_FILES['pdfFile']['name']."<br/>";
      }
    }
  }
  else {
    if ( $_FILES['pdfFile']['type'] != "application/pdf" or  $_FILES['pdfFile']['type'] != "aaplication/jpg") {
      print "Error occured while uploading file : ".$_FILES['pdfFile']['name']."<br/>";
      print "Invalid  file extension, should be pdf !!"."<br/>";
      print "Error Code : ".$_FILES['pdfFile']['error']."<br/>";
    }
  }
}
 
      $register_user_sql = "INSERT INTO pdf SET 
        JobOrderno     = :joborno,
        Filenames     = :pdfFile
        ";

$sql ="UPDATE `jo_details` SET Filenames   = '$dest_files'
        WHERE   JobOrderno               = '$joborno' ";

$sql1 ="UPDATE `createjo` SET Filenames   = '$dest_files'
        WHERE   JobOrderno               = '$joborno' ";

      $register_data = $con->prepare($register_user_sql);
      $register_data->execute([
        ':joborno'          => $joborno,
        ':pdfFile'          => $dest_files
      ]);

    if($con->query($sql) AND $con->query($sql1)){
     
     $btnStatus = 'disabled';
     $btnNew = 'enabled';
   }
        else{
            $_SESSION['error'] = $con->error;
        }
    }
    else{
        $_SESSION['error'] = 'Fill up edit form first';
    }




 
header('location: list_jo.php');
 
?>
