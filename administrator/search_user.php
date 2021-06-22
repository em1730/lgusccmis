<?php
/* Database connection start */
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "sccdrrmo";
include('../config/db_config.php');
// $office = $_POST['office'];


// echo "<pre>";
// echo print_r("test");
// echo "</pre>";
// $conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());


/* Database connection end */
session_start();

// storing  request (ie, get/post) global array to a variable  
$requestData = $_REQUEST;


$columns = array(
	// datatable column index  => database column name
	// 0 => 'entity_no',
	// 1 => 'datecreate',
	// 2 => 'fullname',
	// 3 => 'gender',
	// 4 => 'birthdate',
	// 5 => 'street',
	// 6 => 'barangay',
	// 7 => 'MunCity',
	// 8 => 'province',
	// 9 => 'Region',
	// 10 => 'Employed',
	// 11 => 'covid_history'



);



// getting total number records without any search

$sql = "SELECT * FROM tbl_users  ORDER BY user_id DESC LIMIT " . $requestData['start'] . "," . $requestData['length'] . "";
$get_user_data = $con->prepare($sql);
$get_user_data->execute() or die("search_user.php");
// $query=mysqli_query($conn, $sql) or die("search_user.php");
// PDOStatement::rowCount

$countnofilter = "SELECT COUNT(user_id) as id from tbl_users";
//count all rows w/o filter
$getrecordstmt = $con->prepare($countnofilter);
$getrecordstmt->execute() or die("search_user.php");
$getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
$totalData = $getrecord['id'];
// $totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT * FROM tbl_users where ";

if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql .= "  (user_id LIKE '%" . $requestData['search']['value'] . "%' ";
	$sql .= " OR first_name LIKE '%" . $requestData['search']['value'] . "%' ";
	$sql .= " OR middle_name LIKE '%" . $requestData['search']['value'] . "%' ";
	$sql .= " OR last_name LIKE '%" . $requestData['search']['value'] . "%' ";
	$sql .= " OR contact_no LIKE '%" . $requestData['search']['value'] . "%' ";
	$sql .= " OR position LIKE '%" . $requestData['search']['value'] . "%' ";
	$sql .= " OR email LIKE '%" . $requestData['search']['value'] . "%' ";
	$sql .= " OR username LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR userpass LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR account_type LIKE '%" . $requestData['search']['value'] . "%' ";
	$sql .= " OR location LIKE '%" . $requestData['search']['value'] . "%' ";
	$sql .= " OR department LIKE '%" . $requestData['search']['value'] . "%' ) ";



	// $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
	$sql .= " ORDER BY idno LIMIT " . $requestData['start'] . "," . $requestData['length'] . " ";
	$get_user_data = $con->prepare($sql);
	$get_user_data->execute();
	// $totalData = $get_user_data->fetch(PDOStatement::rowCount);
	// $totalFiltered = $totalData;
	// $query=mysqli_query($conn, $sql) or die("search_user.php");

	$countfilter = "SELECT COUNT(user_id) as id from tbl_users where ";
	$countfilter .= "(user_id LIKE '%" . $requestData['search']['value'] . "%' ";
	$countfilter .= " OR first_name LIKE '%" . $requestData['search']['value'] . "%' ";
	$countfilter .= " OR middle_name LIKE '%" . $requestData['search']['value'] . "%' ";
	$countfilter .= " OR last_name LIKE '%" . $requestData['search']['value'] . "%' ";
	$countfilter .= " OR contact_no LIKE '%" . $requestData['search']['value'] . "%' ";
	$countfilter .= " OR position LIKE '%" . $requestData['search']['value'] . "%' ";
	$countfilter .= " OR email LIKE '%" . $requestData['search']['value'] . "%' ";
    $countfilter .= " OR username LIKE '%" . $requestData['search']['value'] . "%' ";
    $countfilter .= " OR userpass LIKE '%" . $requestData['search']['value'] . "%' ";
    $countfilter .= " OR account_type LIKE '%" . $requestData['search']['value'] . "%' ";
	$countfilter .= " OR location LIKE '%" . $requestData['search']['value'] . "%' ";
	$countfilter .= " OR department LIKE '%" . $requestData['search']['value'] . "%' ) ";
	// $countfilter .= " OR Barangay LIKE '%" . $requestData['search']['value'] . "%' ) ";
	// $countfilter .= " OR MunCity LIKE '%" . $requestData['search']['value'] . "%' ";
	// $countfilter .= " OR Province LIKE '%" . $requestData['search']['value'] . "%' ";
	// $countfilter .= " OR Region LIKE '%" . $requestData['search']['value'] . "%' ";
	// $countfilter .= " OR Employed LIKE '%" . $requestData['search']['value'] . "%' ";
	// $countfilter .= " OR covid_history LIKE '%" . $requestData['search']['value'] . "%' )";

	$countfilter .= " order by user_id LIMIT " . $requestData['start'] . "," . $requestData['length'] . " "; //count all rows w/ filter
	$getrecordstmt = $con->prepare($countfilter);
	$getrecordstmt->execute() or die("search_user.php");
	$getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
	$totalData = $getrecord['id'];
	$totalFiltered = $totalData;
}
$data = array();
// while( $row=mysqli_fetch_array($query) ) {  // preparing an array
while ($row = $get_user_data->fetch(PDO::FETCH_ASSOC)) {
	$nestedData = array();

	$nestedData[] = $row["user_id"];
	$nestedData[] = strtoupper($row["first_name"] . ' ' . $row["middle_name"] . ' ' . $row["last_name"]);
	$nestedData[] = strtoupper($row["position"]);
    $nestedData[] = strtoupper($row["department"]);
	$data[] = $nestedData;
}



$json_data = array(
	"draw"            => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
	"recordsTotal"    => intval($totalData),  // total number of records
	"recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
	"data"            => $data   // total data array
);

echo json_encode($json_data);  // send data as json format
