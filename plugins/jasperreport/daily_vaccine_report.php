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

$date_from =   date('Y-m-d', strtotime($_GET['datefrom']));
$date_to =   date('Y-m-d', strtotime($_GET['dateto']));

$PHPJasperXML = new PHPJasperXML();
// $PHPJasperXML->debugsql=true;
// $PHPJasperXML->arrayParameter=array("employeeNo"=>'12345678');
$xml = $PHPJasperXML->load_xml_file("daily_vaccine_report.jrxml");
// $PHPJasperXML->xml_dismantle($xml);
// $PHPJasperXML->sql = "SELECT r.trace_no,r.date,t.fullname from tbl_tracehistory r inner join tbl_individual t on t.entity_no = r.trace_no where  r.entity_no ='" . $entity_no . "'";

$PHPJasperXML->sql = "SELECT DATE_FORMAT(date_reg,'%M %d, %Y') AS date_reg,
SUM(VaccineManufacturer = 'Astrazeneca'  OR VaccineManufacturer = 'Sinovac' ) AS TOTAL,
SUM(VaccineManufacturer = 'Sinovac' ) AS Sinovac,
SUM(VaccineManufacturer = 'Astrazeneca' ) AS Astrazeneca,
SUM(deferral != 'N/A') AS Deferral,
SUM(Refusal_Reasons != 'N/A') AS Refusal_Reasons,
COUNT(entity_no)  Eligible_population,

SUM(1stDose = '01_Yes' ) AS TOTAL_1stDose,
SUM(2ndDose = '01_Yes' ) AS TOTAL_2ndDose,


SUM(1stDose = '01_Yes' AND bakuna_center = 'BARANGAY I COVERED COURT') AS 1stDose_BARANGAY_I_COVERED_COURT,
SUM(1stDose = '01_Yes' AND bakuna_center = 'BARANGAY GUADALUPE COVERED COURT') AS 1stDose_BARANGAY_GUADALUPE,
SUM(1stDose = '01_Yes' AND bakuna_center = 'BARANGAY III COVERED COURT') AS 1stDose_BARANGAY_III,
SUM(1stDose = '01_Yes' AND bakuna_center = 'BARANGAY PROSPERIDAD COVERED COURT') AS 1stDose_BARANGAY_PROSPERIDAD,
SUM(1stDose = '01_Yes' AND bakuna_center = 'BARANGAY PUNAO COVERED COURT') AS 1stDose_BARANGAY_PUNAO,
SUM(1stDose = '01_Yes' AND bakuna_center = 'BARANGAY QUEZON COVERED COURT') AS 1stDose_BARANGAY_QUEZON,
SUM(1stDose = '01_Yes' AND bakuna_center = 'BARANGAY RIZAL COVERED COURT') AS 1stDose_BARANGAY_RIZAL,
SUM(1stDose = '01_Yes' AND bakuna_center = 'BARANGAY SAN JUAN COVERED COURT') AS 1stDose_BARANGAY_SAN_JUAN,
SUM(1stDose = '01_Yes' AND bakuna_center = 'CITY HEALTH OFFICE SAN CARLOS CITY') AS 1stDose_CITY_HEALTH_OFFICE,
SUM(1stDose = '01_Yes' AND bakuna_center = 'SAN CARLOS CITY CITY HOSPITAL') AS 1stDose_CITY_HOSPITAL,
SUM(1stDose = '01_Yes' AND bakuna_center = 'SAN CARLOS DOCTORS HOSPITAL, INC.') AS 1stDose_DOCTORS_HOSPITAL,

SUM(2ndDose = '01_Yes' AND bakuna_center = 'BARANGAY I COVERED COURT') AS 2ndDose_BARANGAY_I_COVERED_COURT,
SUM(2ndDose = '01_Yes' AND bakuna_center = 'BARANGAY GUADALUPE COVERED COURT') AS 2ndDose_BARANGAY_GUADALUPE,
SUM(2ndDose = '01_Yes' AND bakuna_center = 'BARANGAY III COVERED COURT') AS 2ndDose_BARANGAY_III,
SUM(2ndDose = '01_Yes' AND bakuna_center = 'BARANGAY PROSPERIDAD COVERED COURT') AS 2ndDose_BARANGAY_PROSPERIDAD,
SUM(2ndDose = '01_Yes' AND bakuna_center = 'BARANGAY PUNAO COVERED COURT') AS 2ndDose_BARANGAY_PUNAO,
SUM(2ndDose = '01_Yes' AND bakuna_center = 'BARANGAY QUEZON COVERED COURT') AS 2ndDose_BARANGAY_QUEZON,
SUM(2ndDose = '01_Yes' AND bakuna_center = 'BARANGAY RIZAL COVERED COURT') AS 2ndDose_BARANGAY_RIZAL,
SUM(2ndDose = '01_Yes' AND bakuna_center = 'BARANGAY SAN JUAN COVERED COURT') AS 2ndDose_BARANGAY_SAN_JUAN,
SUM(2ndDose = '01_Yes' AND bakuna_center = 'CITY HEALTH OFFICE SAN CARLOS CITY') AS 2ndDose_CITY_HEALTH_OFFICE,
SUM(2ndDose = '01_Yes' AND bakuna_center = 'SAN CARLOS CITY CITY HOSPITAL') AS 2ndDose_CITY_HOSPITAL,
SUM(2ndDose = '01_Yes' AND bakuna_center = 'SAN CARLOS DOCTORS HOSPITAL, INC.') AS 2ndDose_DOCTORS_HOSPITAL,

SUM(VaccineManufacturer = 'Sinovac' AND bakuna_center = 'BARANGAY I COVERED COURT') AS Sinovac_BARANGAY_I_COVERED_COURT,
SUM(VaccineManufacturer = 'Sinovac' AND bakuna_center = 'BARANGAY GUADALUPE COVERED COURT') AS Sinovac_BARANGAY_GUADALUPE,
SUM(VaccineManufacturer = 'Sinovac' AND bakuna_center = 'BARANGAY III COVERED COURT') AS Sinovac_BARANGAY_III,
SUM(VaccineManufacturer = 'Sinovac' AND bakuna_center = 'BARANGAY PROSPERIDAD COVERED COURT') AS Sinovac_BARANGAY_PROSPERIDAD,
SUM(VaccineManufacturer = 'Sinovac' AND bakuna_center = 'BARANGAY PUNAO COVERED COURT') AS Sinovac_BARANGAY_PUNAO,
SUM(VaccineManufacturer = 'Sinovac' AND bakuna_center = 'BARANGAY QUEZON COVERED COURT') AS Sinovac_BARANGAY_QUEZON,
SUM(VaccineManufacturer = 'Sinovac' AND bakuna_center = 'BARANGAY RIZAL COVERED COURT') AS Sinovac_BARANGAY_RIZAL,
SUM(VaccineManufacturer = 'Sinovac' AND bakuna_center = 'BARANGAY SAN JUAN COVERED COURT') AS Sinovac_BARANGAY_SAN_JUAN,
SUM(VaccineManufacturer = 'Sinovac' AND bakuna_center = 'CITY HEALTH OFFICE SAN CARLOS CITY') AS Sinovac_CITY_HEALTH_OFFICE,
SUM(VaccineManufacturer = 'Sinovac' AND bakuna_center = 'SAN CARLOS CITY CITY HOSPITAL') AS Sinovac_CITY_HOSPITAL,
SUM(VaccineManufacturer = 'Sinovac' AND bakuna_center = 'SAN CARLOS DOCTORS HOSPITAL, INC.') AS Sinovac_DOCTORS_HOSPITAL,

SUM(VaccineManufacturer = 'Astrazeneca' AND bakuna_center = 'BARANGAY I COVERED COURT') AS Astrazeneca_BARANGAY_I_COVERED_COURT,
SUM(VaccineManufacturer = 'Astrazeneca' AND bakuna_center = 'BARANGAY GUADALUPE COVERED COURT') AS Astrazeneca_BARANGAY_GUADALUPE,
SUM(VaccineManufacturer = 'Astrazeneca' AND bakuna_center = 'BARANGAY III COVERED COURT') AS Astrazeneca_BARANGAY_III,
SUM(VaccineManufacturer = 'Astrazeneca' AND bakuna_center = 'BARANGAY PROSPERIDAD COVERED COURT') AS Astrazeneca_BARANGAY_PROSPERIDAD,
SUM(VaccineManufacturer = 'Astrazeneca' AND bakuna_center = 'BARANGAY PUNAO COVERED COURT') AS Astrazeneca_BARANGAY_PUNAO,
SUM(VaccineManufacturer = 'Astrazeneca' AND bakuna_center = 'BARANGAY QUEZON COVERED COURT') AS Astrazeneca_BARANGAY_QUEZON,
SUM(VaccineManufacturer = 'Astrazeneca' AND bakuna_center = 'BARANGAY RIZAL COVERED COURT') AS Astrazeneca_BARANGAY_RIZAL,
SUM(VaccineManufacturer = 'Astrazeneca' AND bakuna_center = 'BARANGAY SAN JUAN COVERED COURT') AS Astrazeneca_BARANGAY_SAN_JUAN,
SUM(VaccineManufacturer = 'Astrazeneca' AND bakuna_center = 'CITY HEALTH OFFICE SAN CARLOS CITY') AS Astrazeneca_CITY_HEALTH_OFFICE,
SUM(VaccineManufacturer = 'Astrazeneca' AND bakuna_center = 'SAN CARLOS CITY CITY HOSPITAL') AS Astrazeneca_CITY_HOSPITAL,
SUM(VaccineManufacturer = 'Astrazeneca' AND bakuna_center = 'SAN CARLOS DOCTORS HOSPITAL, INC.') AS Astrazeneca_DOCTORS_HOSPITAL,

SUM( bakuna_center = 'BARANGAY I COVERED COURT' AND VaccineManufacturer = 'Astrazeneca' OR VaccineManufacturer = 'Sinovac') AS TOTAL_BARANGAY_I_COVERED_COURT,
SUM( bakuna_center = 'BARANGAY GUADALUPE COVERED COURT') AS TOTAL_BARANGAY_GUADALUPE,
SUM( bakuna_center = 'BARANGAY III COVERED COURT') AS TOTAL_BARANGAY_III,
SUM(bakuna_center = 'BARANGAY PROSPERIDAD COVERED COURT') AS TOTAL_BARANGAY_PROSPERIDAD,
SUM(bakuna_center = 'BARANGAY PUNAO COVERED COURT') AS TOTAL_BARANGAY_PUNAO,
SUM( bakuna_center = 'BARANGAY QUEZON COVERED COURT') AS TOTAL_BARANGAY_QUEZON,
SUM(bakuna_center = 'BARANGAY RIZAL COVERED COURT') AS TOTAL_BARANGAY_RIZAL,
SUM( bakuna_center = 'BARANGAY SAN JUAN COVERED COURT') AS TOTAL_BARANGAY_SAN_JUAN,
SUM( bakuna_center = 'CITY HEALTH OFFICE SAN CARLOS CITY') AS TOTAL_CITY_HEALTH_OFFICE,

SUM(VaccineManufacturer = 'Sinovac' AND bakuna_center = 'SAN CARLOS CITY CITY HOSPITAL') AS TOTAL_CITY_HOSPITAL,
SUM(VaccineManufacturer = 'Sinovac' AND bakuna_center = 'SAN CARLOS DOCTORS HOSPITAL, INC.') TOTAL_DOCTORS_HOSPITAL,

SUM(deferral != 'N/A' AND bakuna_center = 'BARANGAY I COVERED COURT') AS deferral_BARANGAY_I_COVERED_COURT,
SUM(deferral != 'N/A' AND bakuna_center = 'BARANGAY GUADALUPE COVERED COURT') AS deferral_BARANGAY_GUADALUPE,
SUM(deferral != 'N/A' AND bakuna_center = 'BARANGAY III COVERED COURT') AS deferral_BARANGAY_III,
SUM(deferral != 'N/A' AND bakuna_center = 'BARANGAY PROSPERIDAD COVERED COURT') AS deferral_BARANGAY_PROSPERIDAD,
SUM(deferral != 'N/A' AND bakuna_center = 'BARANGAY PUNAO COVERED COURT') AS deferral_BARANGAY_PUNAO,
SUM(deferral != 'N/A' AND bakuna_center = 'BARANGAY QUEZON COVERED COURT') AS deferral_BARANGAY_QUEZON,
SUM(deferral != 'N/A' AND bakuna_center = 'BARANGAY RIZAL COVERED COURT') AS deferral_BARANGAY_RIZAL,
SUM(deferral != 'N/A' AND bakuna_center = 'BARANGAY SAN JUAN COVERED COURT') AS deferral_BARANGAY_SAN_JUAN,
SUM(deferral != 'N/A' AND bakuna_center = 'CITY HEALTH OFFICE SAN CARLOS CITY') AS deferral_CITY_HEALTH_OFFICE,
SUM(deferral != 'N/A' AND bakuna_center = 'SAN CARLOS CITY CITY HOSPITAL') AS deferral_CITY_HOSPITAL,
SUM(deferral != 'N/A' AND bakuna_center = 'SAN CARLOS DOCTORS HOSPITAL, INC.') AS deferral_DOCTORS_HOSPITAL,

SUM(Refusal_Reasons != 'N/A' AND bakuna_center = 'BARANGAY I COVERED COURT') AS refusal_BARANGAY_I_COVERED_COURT,
SUM(Refusal_Reasons != 'N/A' AND bakuna_center = 'BARANGAY GUADALUPE COVERED COURT') AS refusal_BARANGAY_GUADALUPE,
SUM(Refusal_Reasons != 'N/A' AND bakuna_center = 'BARANGAY III COVERED COURT') AS refusal_BARANGAY_III,
SUM(Refusal_Reasons != 'N/A' AND bakuna_center = 'BARANGAY PROSPERIDAD COVERED COURT') AS refusal_BARANGAY_PROSPERIDAD,
SUM(Refusal_Reasons != 'N/A' AND bakuna_center = 'BARANGAY PUNAO COVERED COURT') AS refusal_BARANGAY_PUNAO,
SUM(Refusal_Reasons != 'N/A' AND bakuna_center = 'BARANGAY QUEZON COVERED COURT') AS refusal_BARANGAY_QUEZON,
SUM(Refusal_Reasons != 'N/A' AND bakuna_center = 'BARANGAY RIZAL COVERED COURT') AS refusal_BARANGAY_RIZAL,
SUM(Refusal_Reasons != 'N/A' AND bakuna_center = 'BARANGAY SAN JUAN COVERED COURT') AS refusal_BARANGAY_SAN_JUAN,
SUM(Refusal_Reasons != 'N/A' AND bakuna_center = 'CITY HEALTH OFFICE SAN CARLOS CITY') AS refusal_CITY_HEALTH_OFFICE,
SUM(Refusal_Reasons != 'N/A' AND bakuna_center = 'SAN CARLOS CITY CITY HOSPITAL') AS refusal_CITY_HOSPITAL,
SUM(Refusal_Reasons != 'N/A' AND bakuna_center = 'SAN CARLOS DOCTORS HOSPITAL, INC.') AS refusal_DOCTORS_HOSPITAL,

SUM(bakuna_center = 'BARANGAY I COVERED COURT' AND entity_no != 'N/A') AS eligible_BARANGAY_I_COVERED_COURT,
SUM(bakuna_center = 'BARANGAY GUADALUPE COVERED COURT' AND entity_no != 'N/A') AS eligible_BARANGAY_GUADALUPE,
SUM(bakuna_center = 'BARANGAY III COVERED COURT' AND entity_no != 'N/A') AS eligible_BARANGAY_III,
SUM(bakuna_center = 'BARANGAY PROSPERIDAD COVERED COURT' AND entity_no != 'N/A') AS eligible_BARANGAY_PROSPERIDAD,
SUM(bakuna_center = 'BARANGAY PUNAO COVERED COURT' AND entity_no != 'N/A') AS eligible_BARANGAY_PUNAO,
SUM(bakuna_center = 'BARANGAY QUEZON COVERED COURT' AND entity_no != 'N/A') AS eligible_BARANGAY_QUEZON,
SUM(bakuna_center = 'BARANGAY RIZAL COVERED COURT' AND entity_no != 'N/A') AS eligible_BARANGAY_RIZAL,
SUM(bakuna_center = 'BARANGAY SAN JUAN COVERED COURT' AND entity_no != 'N/A') AS eligible_BARANGAY_SAN_JUAN,
SUM(bakuna_center = 'CITY HEALTH OFFICE SAN CARLOS CITY' AND entity_no != 'N/A') AS eligible_CITY_HEALTH_OFFICE,
SUM(bakuna_center = 'SAN CARLOS CITY CITY HOSPITAL' AND entity_no != 'N/A') AS eligible_CITY_HOSPITAL,
SUM(bakuna_center = 'SAN CARLOS DOCTORS HOSPITAL, INC.' AND entity_no != 'N/A') AS eligible_DOCTORS_HOSPITAL

FROM tbl_assessment WHERE status !='VOID' and date_reg between '". $date_from ."' and '". $date_to ."'";

$PHPJasperXML->transferDBtoArray($host, $username, $password, $db_name);
$PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file



?>