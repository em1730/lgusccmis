<?php

include ('../config/db_config.php');
if ($empno!==""){

    //select filename
    $empno = $_REQUEST['empno'];
    $query = "SELECT * FROM employee where empid = '$empno'");
    $row = mysqli_fetch_array($query);
    $update_position = $result['position'];
   
    }
    $result = array("$update_position");
    $myJSON = json_encode($result);
    echo $myJSON;
?>
