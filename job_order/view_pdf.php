<?php

session_start();

include ('../config/db_config.php');


if (!isset($_SESSION['id'])) {
    header('location:../index');
}
echo "<pre>";
print_r($_POST);
echo "</pre>";

$user_id = $_SESSION['id'];


if (isset($_GET['travelno'])) {

    //select filename
    $travelnum = $_GET['travelno'];
    $get_travel_sql = "SELECT * FROM alltravelorder where travelOrderNo = :or";
    $get_travel_data = $con->prepare($get_travel_sql);
    $get_travel_data->execute([':or' => $travelnum]);
    while ($result = $get_travel_data->fetch(PDO::FETCH_ASSOC)) {
        $update_travelno = $result['travelOrderNo'];
        $get_fullname = $result['fullname'];
        $get_position = $result['Position'];
        $get_division = $result['Division'];
        $get_destination = $result['Destination'];
        $get_dateDeparture = $result['dateDeparture'];
        $get_dateArrival = $result['dateArrival'];
        $get_sponsoring = $result['SponsoringAgency']; 
        $get_purpose = $result['Purpose'];
        $get_modetrans = $result['modeTransportation'];
        $get_typevehicle = $result['TypeOfVehicle'];
         $get_natureTravel= $result['natureOfTravel'];
        $get_source = $result['SourceOfFund'];
        $get_datefiled = $result['DateFiled'];

        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
    }

    $file = '../upload/' . $get_file;

    $filename = $get_file;


    header('Content-type: application/pdf');
    header('Content-Disposition: inline; filename = "' . $filename . '"');
    header('Content-Transfer-Encoding: binary');
    header('Accept-Ranges: bytes');
    echo file_get_contents($file);
    @readfile($file);
}
?>

