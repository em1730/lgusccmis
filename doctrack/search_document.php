<?php
session_start();
/* Database connection start */
// $servername = "localhost";
// $username = "root";
// $password = "1234";
// $dbname = "scc_doctrack";
// $office = $_POST['office'];

// $servername = "192.168.0.5";
// $username = "root";
// $password = "1234";
// $dbname = "scc_doctrack";
// $office = $_POST['office'];

include('../config/db_config.php');
// $conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());


// $get_user_sql = "SELECT * FROM tbl_users WHERE user_id = :id";
// $get_user_data = $con->prepare($get_user_sql);
// $get_user_data->execute([':id'=>$user_id]);
// while ($result = $get_user_data->fetch(PDO::FETCH_ASSOC)) {

// $user_name = $result['username'];
// $department = $result['department'];
// $db_first_name = $result['first_name'];
// $db_middle_name = $result['middle_name'];
// $db_last_name = $result['last_name'];
// $db_email_ad = $result['email'];
// $db_contact_number = $result['contact_no'];
// $db_user_name = $result['username'];
// }

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData = $_REQUEST;


$columns = array(
	// datatable column index  => database column name
	0 => 'objid',
	1 => 'type',
	2 => 'description',

);

// getting total number records without any search
$getAllDocuments = "SELECT * FROM document_type where status !='VOID' ORDER BY type ASC LIMIT " . $requestData['start'] . "," . $requestData['length'] . "  ";

$getAllDocumentsData = $con->prepare($getAllDocuments);
$getAllDocumentsData->execute();

$countNoFilter = "SELECT COUNT(idno) as id from document_type";
$getrecordstmt = $con->prepare($countNoFilter);
$getrecordstmt->execute() or die("search_document.php");
$getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
$totalData = $getrecord['id'];
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$getAllDocuments = "SELECT * from document_type	where  ";

if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$getAllDocuments .= " (idno LIKE '%" . $requestData['search']['value'] . "%' ";
	$getAllDocuments .= " OR objid LIKE '%" . $requestData['search']['value'] . "%' ";
	$getAllDocuments .= " OR type LIKE '%" . $requestData['search']['value'] . "%' ";
	$getAllDocuments .= " OR description LIKE '%" . $requestData['search']['value'] . "%' ) ";
	$getAllDocuments .= " AND status !='VOID' ORDER BY type ASC LIMIT " . $requestData['start'] . "," . $requestData['length'] . " ";
	$getAllDocumentsData = $con->prepare($getAllDocuments);
	$getAllDocumentsData->execute();

	$countFilter = " SELECT COUNT(idno) as id from document_type where ";
	$countFilter .= " (idno LIKE '%" . $requestData['search']['value'] . "%' ";
	$countFilter .= " OR objid LIKE '%" . $requestData['search']['value'] . "%' ";
	$countFilter .= " OR type LIKE '%" . $requestData['search']['value'] . "%' ";
	$countFilter .= " OR description LIKE '%" . $requestData['search']['value'] . "%' )";
	$countFilter .= " AND status !='VOID' ORDER BY type ASC LIMIT " . $requestData['length'] . " ";
	$getrecordstmt = $con->prepare($countFilter);
	$getrecordstmt->execute() or die("search_document.php");
	$getrecord1 = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
	$totalData = $getrecord['id'];
	$totalFiltered = $totalData;
}


$data = array();

while ($row = $getAllDocumentsData->fetch(PDO::FETCH_ASSOC)) {
	$nestedData = array();
	$nestedData[] = $row["idno"];
	$nestedData[] = $row["objid"];
	$nestedData[] = $row["type"];
	$nestedData[] = $row["description"];
	$data[] = $nestedData;
}


$json_data = array(
	"draw"            => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
	"recordsTotal"    => intval($totalData),  // total number of records
	"recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
	"data"            => $data   // total data array
);

echo json_encode($json_data);  // send data as json format
