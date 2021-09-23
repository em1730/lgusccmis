<?php
    
   include 'includes/session.php';
   if (isset($_POST['edit'])) {
    
    $EditempNumber = $_POST['empid'];
    $EditempName = $_POST['EditempName'];
    $EditempPosition = $_POST['EditempPosition'];
    $EditempDepartment = $_POST['EditempOffice'];
   
    
    // check if travelno number is available to avoid duplciation
    $sql ="UPDATE employee SET 
                  fullname            = :'$EditempName',
                  position            = :'$EditempPosition',
                  office              = :'$EditempOffice',
                 
        WHERE     empid               = :'$EditempNumber' 
     ";
            
     $alert_msg .= ' 
              <div class="new-alert new-alert-success alert-dismissible">
                  <i class="icon fa fa-success"></i>
                  Data Updated.
              </div>     
            ';


    }

    header('location: employee.php');


?>