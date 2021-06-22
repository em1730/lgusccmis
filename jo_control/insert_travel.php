<?php

include ('../config/db_config.php');


$alert_msg = '';
$alert_msg1 = '';
$alert_msg2 = '';
if (isset($_POST['insert_travel'])) {

      //echo "<pre>";
     // print_r($_POST);
    // echo "</pre>";
    $travelNo = $_POST['travelNo'];
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
    $approved = $_POST['Approved'];
    $type =    'TO';
    
   
    $insert_travel_sql = "INSERT INTO alltravelorder SET 
        travelOrderNo               = :TravelNo,
        fullname                    = :fullName,
        division                    = :division,
        Destination                 = :destination,
        dateDeparture               = :dateDeparture,
        dateArrival                 = :dateArrival,
        SponsoringAgency            = :sponsoringAgency,
        purpose                     = :purpose,
        modeTransportation          = :modeTransportation,
        DateFiled                   = now(),
        TypeOfVehicle               = :TypeOfVehicle,
        natureOfTravel              = :natureoftravel,
        SourceOfFund                = :sourceoffund,
        Status                      = :travelstatus,
        Approved                    = :approved,
        Recommending                = :recommend,
        type                        = :type 
       
     ";
        
    $travel_data = $con->prepare($insert_travel_sql);
    $travel_data->execute ([
        ':TravelNo' =>  $travelNo,
        ':fullName' =>  implode(",", $fullname),
        ':division' => $division,
        ':destination' => $destination,
        ':dateDeparture' => $dateDeparture,
        ':dateArrival' => $dateArrival,
        ':sponsoringAgency' => $sponsoringAgency,
        ':purpose' => $purpose,
        ':modeTransportation' => $modetrans,
         // ':dateNow'              => now() ,
        ':TypeOfVehicle' => $typeVehicle,
        ':natureoftravel' => $NatureofTravel,
        ':sourceoffund' => $sourceOfFund,
        ':travelstatus' => $travelStatus,
        ':approved' => $approved,
        ':type' => $type,
        ':recommend' => $recommend
       
        
        ]);

    $alert_msg .= ' 
       <div class="alert alert-success alert-dismissible">
    <i class="icon fa fa-warning"></i>
    Data Inseerted!
    </div>     
      ';
    
    $btnStatus = 'disabled';
    $btnNew = 'enabled';
    }


?>