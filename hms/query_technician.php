<?php


session_start();

include('../config/db_config.php');

// adding technician info
if (isset($_POST['add_technician'])) {
    $alert_msg = ' ';
    // $tech_myID = uniqid('unit', true);
    $tech_firstname = $_POST['firstname'];
    $tech_middlename = $_POST['middlename'];
    $tech_lastname = $_POST['lastname'];
    $tech_position = $_POST['position'];


    $insert_tech_sql = "INSERT INTO hms_technician SET 
        -- idno               = :id,
        firstname           = :fname,
        middlename          = :mname,
        lastname            = :lname,
        position            = :pos,
        status              = 'Active'";

    $insert_tech_data = $con->prepare($insert_tech_sql);
    $insert_tech_data->execute([

        ':fname'              => $tech_firstname,
        ':mname'              => $tech_middlename,
        ':lname'              => $tech_lastname,
        ':pos'                => $tech_position
        // ':id'                 => $tech_myID

    ]);

    if ($insert_tech_data) {

        $_SESSION['status'] = "Adding Technician Succesfully!";
        $_SESSION['status_code'] = "success";

        header('location: list_technician.php');
    } else {
        $_SESSION['status'] = "Adding Technician Unsuccessful!! ";
        $_SESSION['status_code'] = "error";

        header('location: list_technician.php');
    }


}


// updating technician info
if (isset($_POST['update_technician'])) {
    $alert_msg = ' ';
    $get_firstname = $_POST['firstname'];
    $get_middlename = $_POST['middlename'];
    $get_lastname = $_POST['lastname'];
    $get_position = $_POST['position'];
    $get_tech_idno = $_POST['idno'];


    $update_tech_sql = "UPDATE hms_technician SET
        firstname           = :fname,
        middlename          = :mname,
        lastname            = :lname,
        position            = :pos
        where idno          = :id";

    $update_tech_data = $con->prepare($update_tech_sql);
    $update_tech_data->execute([
        ':id'                => $get_tech_idno,
        ':mname'             => $get_middlename,
        ':fname'             => $get_firstname,
        ':lname'             => $get_lastname,
        ':pos'               => $get_position
    ]);

    if ($update_tech_data) {

        $_SESSION['status'] = "Updating Technician Succesfully!";
        $_SESSION['status_code'] = "success";

        header('location: list_technician.php');
    } else {
        $_SESSION['status'] = "Updating Technician Unsuccessful!! ";
        $_SESSION['status_code'] = "error";

        header('location: list_technician.php');
    }
} 



// deleting technician
if (isset($_POST['delete_technician'])) {

    $delete_tech_id = $_POST['del_idno'];

    $delete_tech_sql = "UPDATE hms_technician SET status ='Inactive' WHERE idno = :id ";
    $delete_tech_data = $con->prepare($delete_tech_sql);
    $delete_tech_data->execute([':id' => $delete_tech_id]);



    // header('location: list_technician.php');

    if ($delete_tech_data) {

        $_SESSION['status'] = "Deleted Succesfully!";
        $_SESSION['status_code'] = "success";

        header('location: list_technician.php');
    } else {
        $_SESSION['status'] = "Deleted Unsuccessful!! ";
        $_SESSION['status_code'] = "error";

        header('location: list_technician.php');
    }
}


