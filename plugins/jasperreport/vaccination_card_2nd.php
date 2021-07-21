<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once("PHPJasperXML.inc.php");



// $server = 'http://localhost:8888';
// $user = 'root';
// $pass = '1234';
// $db = 'sccdrrmo';


$host = "127.0.0.1";
$db_name = "sccdrrmo";
$username = "root";
$password = "I0nvNUWNXoYI";

// $host = "localhost";
// $db_name = "sccdrrmo";
// $username = "root";
// $password = "";


$entity_no = $_GET['entity_no'];
// $date_from =   date('Y-m-d', strtotime($_GET['datefrom']));
// $date_to =  date('Y-m-d', strtotime($_GET['dateto']));
$PHPJasperXML = new PHPJasperXML();
// $PHPJasperXML->debugsql=true;
// $PHPJasperXML->arrayParameter=array("employeeNo"=>'12345678');
$xml = $PHPJasperXML->load_xml_file("vaccination_card_2nd.jrxml");
// $PHPJasperXML->xml_dismantle($xml);
// $PHPJasperXML->sql = "SELECT r.trace_no,r.date,t.fullname from tbl_tracehistory r inner join tbl_individual t on t.entity_no = r.trace_no where  r.entity_no ='" . $entity_no . "'";

$PHPJasperXML->sql = "SELECT v.entity_no, lastname, firstname, middlename, suffix, full_address, contact_no, birthdate_, PhilHealthID, category, 
(SELECT DateVaccination FROM tbl_assessment WHERE (1stDose = '01_Yes' AND 2nddose = '02_No') AND entity_no = '". $entity_no ."') AS datevaccination1, 
(SELECT VaccineManufacturer FROM tbl_assessment WHERE (1stDose = '01_Yes' AND 2nddose = '02_No') AND entity_no = '". $entity_no ."') AS VaccineManufacturer1,
(SELECT BatchNumber FROM tbl_assessment WHERE (1stDose = '01_Yes' AND 2nddose = '02_No') AND entity_no = '". $entity_no ."') AS BatchNumber1,
(SELECT LotNumber FROM tbl_assessment WHERE (1stDose = '01_Yes' AND 2nddose = '02_No') AND entity_no = '". $entity_no ."') AS LotNumber1,
(SELECT VaccinatorName FROM tbl_assessment WHERE (1stDose = '01_Yes' AND 2nddose = '02_No') AND entity_no = '". $entity_no ."') AS VaccinatorName1, 
(SELECT DateVaccination FROM tbl_assessment WHERE (1stDose = '01_Yes' AND 2nddose = '01_Yes') AND entity_no = '". $entity_no ."') AS datevaccination2, 
(SELECT VaccineManufacturer FROM tbl_assessment WHERE (1stDose = '01_Yes' AND 2nddose = '01_Yes') AND entity_no = '". $entity_no ."') AS VaccineManufacturer2,
(SELECT BatchNumber FROM tbl_assessment WHERE (1stDose = '01_Yes' AND 2nddose = '01_Yes') AND entity_no = '". $entity_no ."') AS BatchNumber2,
(SELECT LotNumber FROM tbl_assessment WHERE (1stDose = '01_Yes' AND 2nddose = '01_Yes') AND entity_no = '". $entity_no ."') AS LotNumber2,
(SELECT VaccinatorName FROM tbl_assessment WHERE (1stDose = '01_Yes' AND 2nddose = '01_Yes') AND entity_no = '". $entity_no ."') AS VaccinatorName2,
(SELECT DISTINCT(bakuna_center) FROM tbl_assessment WHERE entity_no = '". $entity_no ."') AS bakunacenter,
(SELECT DISTINCT(bakuna_center_no) FROM tbl_assessment WHERE entity_no = '". $entity_no ."') AS bakunacenter_no
FROM tbl_vaccine v WHERE v.entity_no = '". $entity_no ."'";

$PHPJasperXML->transferDBtoArray($host, $username, $password, $db_name);
$PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file



?>