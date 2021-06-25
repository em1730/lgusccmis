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
$xml = $PHPJasperXML->load_xml_file("daily_vaccine_report_new.jrxml");
// $PHPJasperXML->xml_dismantle($xml);
// $PHPJasperXML->sql = "SELECT r.trace_no,r.date,t.fullname from tbl_tracehistory r inner join tbl_individual t on t.entity_no = r.trace_no where  r.entity_no ='" . $entity_no . "'";

$PHPJasperXML->sql = "SELECT DATE_FORMAT(a.DateVaccination,'%M %d, %Y') AS datevaccination,

SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Sinovac' AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 01_A1_1st_TOTAL_Sinovac,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Sinovac'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 02_A2_1st_TOTAL_Sinovac,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Sinovac'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 03_A3_1st_TOTAL_Sinovac,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Sinovac' AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 04_A4_1st_TOTAL_Sinovac,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Sinovac' AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 05_A5_1st_TOTAL_Sinovac,

SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Sinovac'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 01_A1_2nd_TOTAL_Sinovac,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Sinovac'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 02_A2_2nd_TOTAL_Sinovac,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Sinovac'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 03_A3_2nd_TOTAL_Sinovac,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Sinovac'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 04_A4_2nd_TOTAL_Sinovac,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Sinovac'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 05_A5_2nd_TOTAL_Sinovac,


SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Astrazeneca' AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 01_A1_1st_TOTAL_Astrazeneca,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Astrazeneca'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 02_A2_1st_TOTAL_Astrazeneca,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Astrazeneca'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 03_A3_1st_TOTAL_Astrazeneca,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Astrazeneca' AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 04_A4_1st_TOTAL_Astrazeneca,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Astrazeneca' AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 05_A5_1st_TOTAL_Astrazeneca,

SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Astrazeneca'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 01_A1_2nd_TOTAL_Astrazeneca,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Astrazeneca'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 02_A2_2nd_TOTAL_Astrazeneca,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Astrazeneca'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 03_A3_2nd_TOTAL_Astrazeneca,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Astrazeneca'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 04_A4_2nd_TOTAL_Astrazeneca,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Astrazeneca'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 05_A5_2nd_TOTAL_Astrazeneca,



SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05408'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 01_A1_1st_BRGY_I_Sinovac,
SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05396'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 01_A1_1st_GUADALUPE_Sinovac,
SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05404'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 01_A1_1st_PROSPERIDAD_Sinovac,
SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05400'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 01_A1_1st_PUNAO_Sinovac,
SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05401'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 01_A1_1st_QUEZON_Sinovac,
SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05405'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 01_A1_1st_RIZAL_Sinovac,
SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05407'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 01_A1_1st_SAN_JUAN_Sinovac,
SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC04826'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 01_A1_1st_CHO_Sinovac,
SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05415'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 01_A1_1st_HOSPITAL_Sinovac,
SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC04818'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 01_A1_1st_DOCTORS_Sinovac,

SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05408'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 01_A1_2nd_BRGY_I_Sinovac,
SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05396'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 01_A1_2nd_GUADALUPE_Sinovac,
SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05404'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 01_A1_2nd_PROSPERIDAD_Sinovac,
SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05400'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 01_A1_2nd_PUNAO_Sinovac,
SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05401'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 01_A1_2nd_QUEZON_Sinovac,
SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05405'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 01_A1_2nd_RIZAL_Sinovac,
SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05407'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 01_A1_2nd_SAN_JUAN_Sinovac,
SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC04826'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 01_A1_2nd_CHO_Sinovac,
SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05415'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 01_A1_2nd_HOSPITAL_Sinovac,
SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC04818'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 01_A1_2nd_DOCTORS_Sinovac,


SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05408'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 02_A2_1st_BRGY_I_Sinovac,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05396'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 02_A2_1st_GUADALUPE_Sinovac,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05404'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 02_A2_1st_PROSPERIDAD_Sinovac,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05400'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 02_A2_1st_PUNAO_Sinovac,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05401'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 02_A2_1st_QUEZON_Sinovac,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05405'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 02_A2_1st_RIZAL_Sinovac,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05407'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 02_A2_1st_SAN_JUAN_Sinovac,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC04826'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 02_A2_1st_CHO_Sinovac,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05415'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 02_A2_1st_HOSPITAL_Sinovac,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC04818'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 02_A2_1st_DOCTORS_Sinovac,

SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05408'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 02_A2_2nd_BRGY_I_Sinovac,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05396'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 02_A2_2nd_GUADALUPE_Sinovac,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05404'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 02_A2_2nd_PROSPERIDAD_Sinovac,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05400'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 02_A2_2nd_PUNAO_Sinovac,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05401'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 02_A2_2nd_QUEZON_Sinovac,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05405'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 02_A2_2nd_RIZAL_Sinovac,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05407'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 02_A2_2nd_SAN_JUAN_Sinovac,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC04826'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 02_A2_2nd_CHO_Sinovac,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05415'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 02_A2_2nd_HOSPITAL_Sinovac,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC04818'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 02_A2_2nd_DOCTORS_Sinovac,


SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05408'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 03_A3_1st_BRGY_I_Sinovac,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05396'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 03_A3_1st_GUADALUPE_Sinovac,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05404'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 03_A3_1st_PROSPERIDAD_Sinovac,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05400'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 03_A3_1st_PUNAO_Sinovac,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05401'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 03_A3_1st_QUEZON_Sinovac,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05405'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 03_A3_1st_RIZAL_Sinovac,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05407'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 03_A3_1st_SAN_JUAN_Sinovac,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC04826'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 03_A3_1st_CHO_Sinovac,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05415'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 03_A3_1st_HOSPITAL_Sinovac,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC04818'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 03_A3_1st_DOCTORS_Sinovac,

SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05408'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 03_A3_2nd_BRGY_I_Sinovac,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05396'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 03_A3_2nd_GUADALUPE_Sinovac,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05404'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 03_A3_2nd_PROSPERIDAD_Sinovac,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05400'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 03_A3_2nd_PUNAO_Sinovac,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05401'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 03_A3_2nd_QUEZON_Sinovac,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05405'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 03_A3_2nd_RIZAL_Sinovac,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05407'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 03_A3_2nd_SAN_JUAN_Sinovac,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC04826'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 03_A3_2nd_CHO_Sinovac,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05415'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 03_A3_2nd_HOSPITAL_Sinovac,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC04818'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 03_A3_2nd_DOCTORS_Sinovac,


SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05408'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 04_A4_1st_BRGY_I_Sinovac,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05396'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 04_A4_1st_GUADALUPE_Sinovac,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05404'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 04_A4_1st_PROSPERIDAD_Sinovac,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05400'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 04_A4_1st_PUNAO_Sinovac,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05401'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 04_A4_1st_QUEZON_Sinovac,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05405'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 04_A4_1st_RIZAL_Sinovac,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05407'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 04_A4_1st_SAN_JUAN_Sinovac,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC04826'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 04_A4_1st_CHO_Sinovac,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05415'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 04_A4_1st_HOSPITAL_Sinovac,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC04818'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 04_A4_1st_DOCTORS_Sinovac,

SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05408'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 04_A4_2nd_BRGY_I_Sinovac,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05396'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 04_A4_2nd_GUADALUPE_Sinovac,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05404'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 04_A4_2nd_PROSPERIDAD_Sinovac,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05400'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 04_A4_2nd_PUNAO_Sinovac,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05401'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 04_A4_2nd_QUEZON_Sinovac,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05405'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 04_A4_2nd_RIZAL_Sinovac,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05407'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 04_A4_2nd_SAN_JUAN_Sinovac,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC04826'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 04_A4_2nd_CHO_Sinovac,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05415'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 04_A4_2nd_HOSPITAL_Sinovac,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC04818'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 04_A4_2nd_DOCTORS_Sinovac,


SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05408'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 05_A5_1st_BRGY_I_Sinovac,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05396'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 05_A5_1st_GUADALUPE_Sinovac,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05404'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 05_A5_1st_PROSPERIDAD_Sinovac,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05400'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 05_A5_1st_PUNAO_Sinovac,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05401'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 05_A5_1st_QUEZON_Sinovac,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05405'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 05_A5_1st_RIZAL_Sinovac,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05407'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 05_A5_1st_SAN_JUAN_Sinovac,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC04826'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 05_A5_1st_CHO_Sinovac,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05415'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 05_A5_1st_HOSPITAL_Sinovac,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC04818'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 05_A5_1st_DOCTORS_Sinovac,

SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05408'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 05_A5_2nd_BRGY_I_Sinovac,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05396'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 05_A5_2nd_GUADALUPE_Sinovac,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05404'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 05_A5_2nd_PROSPERIDAD_Sinovac,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05400'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 05_A5_2nd_PUNAO_Sinovac,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05401'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 05_A5_2nd_QUEZON_Sinovac,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05405'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 05_A5_2nd_RIZAL_Sinovac,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05407'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 05_A5_2nd_SAN_JUAN_Sinovac,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC04826'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 05_A5_2nd_CHO_Sinovac,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC05415'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 05_A5_2nd_HOSPITAL_Sinovac,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Sinovac' AND bakuna_center_no='CBC04818'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 05_A5_2nd_DOCTORS_Sinovac,







SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05408'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 01_A1_1st_BRGY_I_Astrazeneca,
SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05396'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 01_A1_1st_GUADALUPE_Astrazeneca,
SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05404'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 01_A1_1st_PROSPERIDAD_Astrazeneca,
SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05400'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 01_A1_1st_PUNAO_Astrazeneca,
SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05401'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 01_A1_1st_QUEZON_Astrazeneca,
SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05405'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 01_A1_1st_RIZAL_Astrazeneca,
SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05407'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 01_A1_1st_SAN_JUAN_Astrazeneca,
SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC04826'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 01_A1_1st_CHO_Astrazeneca,
SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05415'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 01_A1_1st_HOSPITAL_Astrazeneca,
SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC04818'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 01_A1_1st_DOCTORS_Astrazeneca,

SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05408'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 01_A1_2nd_BRGY_I_Astrazeneca,
SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05396'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 01_A1_2nd_GUADALUPE_Astrazeneca,
SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05404'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 01_A1_2nd_PROSPERIDAD_Astrazeneca,
SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05400'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 01_A1_2nd_PUNAO_Astrazeneca,
SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05401'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 01_A1_2nd_QUEZON_Astrazeneca,
SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05405'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 01_A1_2nd_RIZAL_Astrazeneca,
SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05407'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 01_A1_2nd_SAN_JUAN_Astrazeneca,
SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC04826'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 01_A1_2nd_CHO_Astrazeneca,
SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05415'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 01_A1_2nd_HOSPITAL_Astrazeneca,
SUM(Category = '01_A1: Health Care Workers' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC04818'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 01_A1_2nd_DOCTORS_Astrazeneca,


SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05408'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 02_A2_1st_BRGY_I_Astrazeneca,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05396'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 02_A2_1st_GUADALUPE_Astrazeneca,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05404'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 02_A2_1st_PROSPERIDAD_Astrazeneca,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05400'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 02_A2_1st_PUNAO_Astrazeneca,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05401'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 02_A2_1st_QUEZON_Astrazeneca,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05405'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 02_A2_1st_RIZAL_Astrazeneca,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05407'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 02_A2_1st_SAN_JUAN_Astrazeneca,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC04826'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 02_A2_1st_CHO_Astrazeneca,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05415'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 02_A2_1st_HOSPITAL_Astrazeneca,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC04818'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 02_A2_1st_DOCTORS_Astrazeneca,

SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05408'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 02_A2_2nd_BRGY_I_Astrazeneca,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05396'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 02_A2_2nd_GUADALUPE_Astrazeneca,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05404'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 02_A2_2nd_PROSPERIDAD_Astrazeneca,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05400'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 02_A2_2nd_PUNAO_Astrazeneca,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05401'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 02_A2_2nd_QUEZON_Astrazeneca,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05405'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 02_A2_2nd_RIZAL_Astrazeneca,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05407'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 02_A2_2nd_SAN_JUAN_Astrazeneca,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC04826'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 02_A2_2nd_CHO_Astrazeneca,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05415'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 02_A2_2nd_HOSPITAL_Astrazeneca,
SUM(Category = '02_A2: Senior Citizens' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC04818'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 02_A2_2nd_DOCTORS_Astrazeneca,


SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05408'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 03_A3_1st_BRGY_I_Astrazeneca,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05396'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 03_A3_1st_GUADALUPE_Astrazeneca,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05404'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 03_A3_1st_PROSPERIDAD_Astrazeneca,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05400'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 03_A3_1st_PUNAO_Astrazeneca,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05401'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 03_A3_1st_QUEZON_Astrazeneca,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05405'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 03_A3_1st_RIZAL_Astrazeneca,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05407'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 03_A3_1st_SAN_JUAN_Astrazeneca,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC04826'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 03_A3_1st_CHO_Astrazeneca,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05415'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 03_A3_1st_HOSPITAL_Astrazeneca,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC04818'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 03_A3_1st_DOCTORS_Astrazeneca,

SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05408'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 03_A3_2nd_BRGY_I_Astrazeneca,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05396'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 03_A3_2nd_GUADALUPE_Astrazeneca,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05404'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 03_A3_2nd_PROSPERIDAD_Astrazeneca,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05400'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 03_A3_2nd_PUNAO_Astrazeneca,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05401'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 03_A3_2nd_QUEZON_Astrazeneca,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05405'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 03_A3_2nd_RIZAL_Astrazeneca,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05407'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 03_A3_2nd_SAN_JUAN_Astrazeneca,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC04826'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 03_A3_2nd_CHO_Astrazeneca,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05415'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 03_A3_2nd_HOSPITAL_Astrazeneca,
SUM(Category = '03_A3: Adult with Comorbidity' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC04818'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 03_A3_2nd_DOCTORS_Astrazeneca,


SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05408'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 04_A4_1st_BRGY_I_Astrazeneca,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05396'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 04_A4_1st_GUADALUPE_Astrazeneca,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05404'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 04_A4_1st_PROSPERIDAD_Astrazeneca,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05400'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 04_A4_1st_PUNAO_Astrazeneca,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05401'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 04_A4_1st_QUEZON_Astrazeneca,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05405'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 04_A4_1st_RIZAL_Astrazeneca,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05407'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 04_A4_1st_SAN_JUAN_Astrazeneca,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC04826'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 04_A4_1st_CHO_Astrazeneca,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05415'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 04_A4_1st_HOSPITAL_Astrazeneca,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC04818'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 04_A4_1st_DOCTORS_Astrazeneca,

SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05408'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 04_A4_2nd_BRGY_I_Astrazeneca,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05396'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 04_A4_2nd_GUADALUPE_Astrazeneca,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05404'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 04_A4_2nd_PROSPERIDAD_Astrazeneca,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05400'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 04_A4_2nd_PUNAO_Astrazeneca,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05401'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 04_A4_2nd_QUEZON_Astrazeneca,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05405'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 04_A4_2nd_RIZAL_Astrazeneca,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05407'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 04_A4_2nd_SAN_JUAN_Astrazeneca,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC04826'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 04_A4_2nd_CHO_Astrazeneca,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05415'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 04_A4_2nd_HOSPITAL_Astrazeneca,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC04818'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 04_A4_2nd_DOCTORS_Astrazeneca,


SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05408'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 05_A5_1st_BRGY_I_Astrazeneca,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05396'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 05_A5_1st_GUADALUPE_Astrazeneca,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05404'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 05_A5_1st_PROSPERIDAD_Astrazeneca,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05400'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 05_A5_1st_PUNAO_Astrazeneca,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05401'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 05_A5_1st_QUEZON_Astrazeneca,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05405'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 05_A5_1st_RIZAL_Astrazeneca,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05407'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 05_A5_1st_SAN_JUAN_Astrazeneca,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC04826'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 05_A5_1st_CHO_Astrazeneca,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05415'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 05_A5_1st_HOSPITAL_Astrazeneca,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC04818'  AND CASE WHEN a.entity_no NOT IN(SELECT entity_no FROM tbl_assessment WHERE 1stDose = '01_Yes' AND 2ndDose = '01_Yes' AND DateVaccination between '". $date_from ."' and '". $date_to ."') THEN 1 ELSE 0 END) AS 05_A5_1st_DOCTORS_Astrazeneca,

SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05408'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 05_A5_2nd_BRGY_I_Astrazeneca,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05396'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 05_A5_2nd_GUADALUPE_Astrazeneca,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05404'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 05_A5_2nd_PROSPERIDAD_Astrazeneca,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05400'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 05_A5_2nd_PUNAO_Astrazeneca,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05401'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 05_A5_2nd_QUEZON_Astrazeneca,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05405'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 05_A5_2nd_RIZAL_Astrazeneca,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05407'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 05_A5_2nd_SAN_JUAN_Astrazeneca,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC04826'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 05_A5_2nd_CHO_Astrazeneca,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC05415'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 05_A5_2nd_HOSPITAL_Astrazeneca,
SUM(Category = '05_A5: Poor Population' AND VaccineManufacturer = 'Astrazeneca' AND bakuna_center_no='CBC04818'  AND 1stDose ='01_Yes' AND 2ndDose = '01_Yes') AS 05_A5_2nd_DOCTORS_Astrazeneca




FROM tbl_assessment a INNER JOIN tbl_vaccine v ON v.entity_no = a.entity_no WHERE a.DateVaccination between '". $date_from ."' and '". $date_to ."'  and a.status = 'VACCINATED'   ";

$PHPJasperXML->transferDBtoArray($host, $username, $password, $db_name);
$PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file



?>