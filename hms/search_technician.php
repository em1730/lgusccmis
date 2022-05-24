<?php
include('../config/db_config.php');
// $userDepartment = $_SESSION['department'];
// $filterBrgy =   '';
// if($_SESSION['user_type'] == 1){
//     $filterBrgy = '';
// }else{
//     $filterBrgy = "WHERE barangay = '".$userDepartment."'";
// }
$columns= array( 
    // datatable column index  => database column name
        0 => 'idno', 
        1 => 'fullname',
        2 => 'position',
        3 => 'status',
    
    );
    

// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$getAllIndividual = "SELECT * FROM hms_technician  ORDER BY idno DESC 
                    LIMIT ".$requestData['start']." ,".$requestData['length']."  ";

$getIndividualData = $con->prepare($getAllIndividual);
$getIndividualData->execute();                   

$countNoFilter = "SELECT COUNT(idno) as id from hms_technician";
$getrecordstmt = $con->prepare($countNoFilter);
$getrecordstmt->execute() or die("search_technician.php");
$getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
$totalData = $getrecord['id'];

$totalFiltered = $totalData;  
// when there is no search parameter then total number rows = total number filtered rows.


$getAllIndividual = "SELECT * from hms_technician where ";
             
     if( !empty($requestData['search']['value']) ) {
        $getAllIndividual.=" (idno LIKE '%".$requestData['search']['value']."%'";
        $getAllIndividual.=" OR firstname LIKE '%".$requestData['search']['value']."%' ";
        $getAllIndividual.=" OR middlename LIKE '%".$requestData['search']['value']."%' ";
        $getAllIndividual.=" OR lastname LIKE '%".$requestData['search']['value']."%' ";
        $getAllIndividual.=" OR position LIKE '%".$requestData['search']['value']."%' ";
        $getAllIndividual.=" OR status LIKE '%".$requestData['search']['value']."%' )";
        $getAllIndividual.=" ORDER BY idno DESC LIMIT 50 ";
        $getIndividualData = $con->prepare($getAllIndividual);
        $getIndividualData->execute(); 

     $countfilter = "SELECT COUNT(idno) as id from hms_technician where";
       $countfilter.=" (idno LIKE '%".$requestData['search']['value']."%'";
       $countfilter.=" OR firstname LIKE '%".$requestData['search']['value']."%' ";
       $countfilter.=" OR middlename LIKE '%".$requestData['search']['value']."%' ";
       $countfilter.=" OR lastname LIKE '%".$requestData['search']['value']."%' ";
       $countfilter.=" OR position LIKE '%".$requestData['search']['value']."%' ";
       $countfilter.=" OR status LIKE '%".$requestData['search']['value']."%') ";
       $countfilter.="LIMIT ".$requestData['length']." " ;


        $getrecordstmt = $con->prepare($countfilter);
        $getrecordstmt->execute() or die("search_technician.php");
        $getrecord1 = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
        $totalData = $getrecord['id'];
        $totalFiltered = $totalData;
     }





     $data = array();
// while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	while ($row = $getIndividualData->fetch(PDO::FETCH_ASSOC)){
	$nestedData=array(); 

	$nestedData[] = $row["idno"];
    $nestedData[] = ucwords(strtoupper($row["firstname"].' '.$row["middlename"].'. '.$row["lastname"]));
    $nestedData[] = $row["position"];
    $nestedData[] = $row["status"];

	$data[] = $nestedData;
}
        $json_data = array(
    "draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
    "recordsTotal"    => intval( $totalData ),  // total number of records
    "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
    "data"            => $data   // total data array
    );

    echo json_encode($json_data);  // send data as json format


?>