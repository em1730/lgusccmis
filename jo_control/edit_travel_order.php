<?php

include ('../config/db_config.php');


$alert_msg = '';
$alert_msg1 = '';
$alert_msg2 = '';
if (isset($_POST['edit_travel_order'])) {

      //echo "<pre>";
     // print_r($_POST);
    // echo "</pre>";
    $travelNo = $_POST['travelNo'];
    $travelNo2 = $_POST['travelNo2'];
    $fullname = $_POST['fullname'];
    $division = $_POST['division'];
    $destination = $_POST['destination'];
    $dateDeparture = date('Y-m-d', strtotime($_POST['dateDeparture']));
    $dateArrival = date('Y-m-d', strtotime($_POST['dateArrival']));
    $sponsoringAgency = $_POST['sponsoringAgency'];
    $purpose = $_POST['purpose'];
    $modetrans = $_POST['modeTransportation'];
    $typeVehicle = $_POST['typeOfvehicle'];
    $NatureofTravel = $_POST['NatureOfTravel'];
    $sourceOfFund = $_POST['SourceOfFund'];
    $travelStatus = $_POST['Status'];
    $recommend = $_POST['Recommending'];
    $approve = $_POST['Approved'];
    $remarks = $_POST['Remarks'];



    $edit_travel_order_sql ="UPDATE alltravelorder SET 
    travelOrderNo               = :TravelOrderNo,      
        fullname                    = :fullname,
        division                    = :Division,
        Destination                 = :Destination,
        dateDeparture               = :DateDeparture,
        dateArrival                 = :DateArrival,
        SponsoringAgency            = :SponsoringAgency,
        purpose                     = :Purpose,
        modeTransportation          = :ModeTransportation,
        DateFiled                   = now(),
        TypeOfVehicle               = :TypeOfVehicle,
        natureOfTravel              = :Natureoftravel,
        SourceOfFund                = :Sourceoffund,
        Status                      = :Travelstatus,
        Recommending                = :Recommend,
        Approved                    = :Approved,
        Remarks                     = :Remarks          

        WHERE   travelOrderNo               = :TravelOrderNo2";
            
    $edit_travel_order_data = $con->prepare($edit_travel_order_sql);
    $edit_travel_order_data->execute([
        ':TravelOrderNo' =>  $travelNo,
        ':fullname' =>  implode(",", $fullname),
        ':Division' => $division,
        ':Destination' => $destination,
        ':DateDeparture' => $dateDeparture,
        ':DateArrival' => $dateArrival,
        ':SponsoringAgency' => $sponsoringAgency,
        ':Purpose' => $purpose,
        ':ModeTransportation' => $modetrans,
         // ':dateNow'              => now() ,
        ':TypeOfVehicle' => $typeVehicle,
        ':Natureoftravel' => $NatureofTravel,
        ':Sourceoffund' => $sourceOfFund,
        ':Travelstatus' => $travelStatus,
        ':Recommend' => $recommend,
        ':Approved' => $approve,
        ':Remarks'  => $remarks,


         ':TravelOrderNo2' =>  $travelNo2
       
     ]);

    $alert_msg .= ' 
    <div class="alert alert-success alert-dismissible">
    <i class="icon fa fa-warning"></i>
    Data updated!
    </div>     
      ';
      }
?>

