<?php
    
   include 'includes/session.php';
   if (isset($_POST['update_status'])) {
    
    $travelNo = $_POST['id'];
    $travelStatus = $_POST['Status'];
    
    // check if travelno number is available to avoid duplciation
    $sql ="UPDATE alltravelorder SET Status   = '$travelStatus'
        WHERE   travelOrderNo               = '$travelNo'  
     ";
            
    if($con->query($sql)){
            $_SESSION['success'] = "<i class='icon fa fa-check'></i>success";
    }
        else{
            $_SESSION['error'] = $con->error;
        }
    }
    else{
        $_SESSION['error'] = 'Fill up edit form first';
    }

    header('location: table.php');


?>