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



$PHPJasperXML = new PHPJasperXML();
// $PHPJasperXML->debugsql=true;
// $PHPJasperXML->arrayParameter=array("employeeNo"=>'12345678');
$xml = $PHPJasperXML->load_xml_file("populationreport.jrxml");
// $PHPJasperXML->xml_dismantle($xml);
// $PHPJasperXML->sql = "SELECT r.trace_no,r.date,t.fullname from tbl_tracehistory r inner join tbl_individual t on t.entity_no = r.trace_no where  r.entity_no ='" . $entity_no . "'";

$PHPJasperXML->sql = "SELECT HealthWorker,
SUM(Category = '01_A1: Health Care Workers') Health_worker_Total,
SUM(Category = '05_A5: Poor Population') 03_Indigent_Total,
SUM(Category = '02_A2: Senior Citizens' AND Indigent = '01_Indigent' AND Consent = '01_Yes') 03_Senior_Citizen_indigent,
SUM(Category = '02_A2: Senior Citizens' AND Indigent = '02_Not_Indigent' AND Consent = '01_Yes') 03_Senior_Citizen,
SUM(Category = '01_A1: Health Care Workers' OR  Category = '02_A2: Senior Citizens' OR Category = '05_A5: Poor Population' OR Category = '04_A4: Frontline Personnel in Essential Sector' OR  Employer_name = 'PHILIPPINE NATIONAL POLICE') TOTAL,
SUM(Consent = '01_Yes' AND Category = '04_A4: Frontline Personnel in Essential Sector' AND  Employer_name = 'PHILIPPINE NATIONAL POLICE' OR  Employer_name = 'PNP' AND Consent = '01_Yes') TOTAL_PNP,


SUM(HealthWorker = '01_Public_and_Private_Health_Facilities' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 01_Public_and_Private_Health_Facilities,
SUM(HealthWorker = '02_Public_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 02_Public_Health_Workers,
SUM(HealthWorker = '03_Barangay_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 03_Barangay_Health_Workers,
SUM(HealthWorker = '04_Other_NGAs' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 04_Other_NGAs,
SUM(Consent = '01_Yes' AND Category = '05_A5: Poor Population') 03_Indigent,

SUM(Barangay = '_64524010_BARANGAY_I_(POB.)'  AND Consent = '01_Yes' AND Category = '02_A2: Senior Citizens' AND Indigent = '02_Not_Indigent') 01_BARANGAY_I_Senior,
SUM(Barangay = '_64524011_BARANGAY_II_(POB.)' AND Consent = '01_Yes' AND Category = '02_A2: Senior Citizens' AND Indigent = '02_Not_Indigent') 01_BARANGAY_II_Senior,
SUM(Barangay = '_64524012_BARANGAY_III_(POB.)' AND Consent = '01_Yes' AND Category = '02_A2: Senior Citizens' AND Indigent = '02_Not_Indigent') 01_BARANGAY_III_Senior,
SUM(Barangay = '_64524013_BARANGAY_IV_(POB.)' AND Consent = '01_Yes' AND Category = '02_A2: Senior Citizens' AND Indigent = '02_Not_Indigent') 01_BARANGAY_IV_Senior,
SUM(Barangay = '_64524014_BARANGAY_V_(POB.)' AND Consent = '01_Yes' AND Category = '02_A2: Senior Citizens' AND Indigent = '02_Not_Indigent') 01_BARANGAY_V_Senior,
SUM(Barangay = '_64524015_BARANGAY_VI_(POB.)' AND Consent = '01_Yes' AND Category = '02_A2: Senior Citizens' AND Indigent = '02_Not_Indigent') 01_BARANGAY_VI_Senior,
SUM(Barangay = '_64524001_BAGONBON' AND Consent = '01_Yes' AND Category = '02_A2: Senior Citizens' AND Indigent = '02_Not_Indigent') 01_BAGONBON_Senior,
SUM(Barangay = '_64524002_BULUANGAN' AND Consent = '01_Yes' AND Category = '02_A2: Senior Citizens' AND Indigent = '02_Not_Indigent') 01_BULUANGAN_Senior,
SUM(Barangay = '_64524004_CODCOD' AND Consent = '01_Yes' AND Category = '02_A2: Senior Citizens' AND Indigent = '02_Not_Indigent') 01_CODCOD_Senior,
SUM(Barangay = '_64524005_ERMITA' AND Consent = '01_Yes' AND Category = '02_A2: Senior Citizens' AND Indigent = '02_Not_Indigent') 01_ERMITA_Senior,
SUM(Barangay = '_64524006_GUADALUPE' AND Consent = '01_Yes' AND Category = '02_A2: Senior Citizens' AND Indigent = '02_Not_Indigent') 01_GUADALUPE_Senior,
SUM(Barangay = '_64524008_NATABAN' AND Consent = '01_Yes' AND Category = '02_A2: Senior Citizens' AND Indigent = '02_Not_Indigent') 01_NATABAN_Senior,
SUM(Barangay = '_64524009_PALAMPAS' AND Consent = '01_Yes' AND Category = '02_A2: Senior Citizens' AND Indigent = '02_Not_Indigent') 01_PALAMPAS_Senior,
SUM(Barangay = '_64524016_PROSPERIDAD' AND Consent = '01_Yes' AND Category = '02_A2: Senior Citizens' AND Indigent = '02_Not_Indigent') 01_PROSPERIDAD_Senior,
SUM(Barangay = '_64524017_PUNAO' AND Consent = '01_Yes' AND Category = '02_A2: Senior Citizens' AND Indigent = '02_Not_Indigent') 01_PUNAO_Senior,
SUM(Barangay = '_64524018_QUEZON' AND Consent = '01_Yes' AND Category = '02_A2: Senior Citizens' AND Indigent = '02_Not_Indigent') 01_QUEZON_Senior,
SUM(Barangay = '_64524019_RIZAL' AND Consent = '01_Yes' AND Category = '02_A2: Senior Citizens' AND Indigent = '02_Not_Indigent') 01_RIZAL_Senior,
SUM(Barangay = '_64524020_SAN_JUAN' AND Consent = '01_Yes' AND Category = '02_A2: Senior Citizens' AND Indigent = '02_Not_Indigent') 01_SAN_JUAN_Senior,

SUM(Barangay = '_64524010_BARANGAY_I_(POB.)'  AND Consent = '01_Yes' AND Category = '02_A2: Senior Citizens' AND Indigent = '01_Indigent') 01_BARANGAY_I_Senior_Indigent,
SUM(Barangay = '_64524011_BARANGAY_II_(POB.)' AND Consent = '01_Yes' AND Category = '02_A2: Senior Citizens' AND Indigent = '01_Indigent') 01_BARANGAY_II_Senior_Indigent,
SUM(Barangay = '_64524012_BARANGAY_III_(POB.)' AND Consent = '01_Yes' AND Category = '02_A2: Senior Citizens' AND Indigent = '01_Indigent') 01_BARANGAY_III_Senior_Indigent,
SUM(Barangay = '_64524013_BARANGAY_IV_(POB.)' AND Consent = '01_Yes' AND Category = '02_A2: Senior Citizens' AND Indigent = '01_Indigent') 01_BARANGAY_IV_Senior_Indigent,
SUM(Barangay = '_64524014_BARANGAY_V_(POB.)' AND Consent = '01_Yes' AND Category = '02_A2: Senior Citizens' AND Indigent = '01_Indigent') 01_BARANGAY_V_Senior_Indigent,
SUM(Barangay = '_64524015_BARANGAY_VI_(POB.)' AND Consent = '01_Yes' AND Category = '02_A2: Senior Citizens' AND Indigent = '01_Indigent') 01_BARANGAY_VI_Senior_Indigent,
SUM(Barangay = '_64524001_BAGONBON' AND Consent = '01_Yes' AND Category = '02_A2: Senior Citizens' AND Indigent = '01_Indigent') 01_BAGONBON_Senior_Indigent,
SUM(Barangay = '_64524002_BULUANGAN' AND Consent = '01_Yes' AND Category = '02_A2: Senior Citizens' AND Indigent = '01_Indigent') 01_BULUANGAN_Senior_Indigent,
SUM(Barangay = '_64524004_CODCOD' AND Consent = '01_Yes' AND Category = '02_A2: Senior Citizens' AND Indigent = '01_Indigent') 01_CODCOD_Senior_Indigent,
SUM(Barangay = '_64524005_ERMITA' AND Consent = '01_Yes' AND Category = '02_A2: Senior Citizens' AND Indigent = '01_Indigent') 01_ERMITA_Senior_Indigent,
SUM(Barangay = '_64524006_GUADALUPE' AND Consent = '01_Yes' AND Category = '02_A2: Senior Citizens' AND Indigent = '01_Indigent') 01_GUADALUPE_Senior_Indigent,
SUM(Barangay = '_64524008_NATABAN' AND Consent = '01_Yes' AND Category = '02_A2: Senior Citizens' AND Indigent = '01_Indigent') 01_NATABAN_Senior_Indigent,
SUM(Barangay = '_64524009_PALAMPAS' AND Consent = '01_Yes' AND Category = '02_A2: Senior Citizens' AND Indigent = '01_Indigent') 01_PALAMPAS_Senior_Indigent,
SUM(Barangay = '_64524016_PROSPERIDAD' AND Consent = '01_Yes' AND Category = '02_A2: Senior Citizens' AND Indigent = '01_Indigent') 01_PROSPERIDAD_Senior_Indigent,
SUM(Barangay = '_64524017_PUNAO' AND Consent = '01_Yes' AND Category = '02_A2: Senior Citizens' AND Indigent = '01_Indigent') 01_PUNAO_Senior_Indigent,
SUM(Barangay = '_64524018_QUEZON' AND Consent = '01_Yes' AND Category = '02_A2: Senior Citizens' AND Indigent = '01_Indigent') 01_QUEZON_Senior_Indigent,
SUM(Barangay = '_64524019_RIZAL' AND Consent = '01_Yes' AND Category = '02_A2: Senior Citizens' AND Indigent = '01_Indigent') 01_RIZAL_Senior_Indigent,
SUM(Barangay = '_64524020_SAN_JUAN' AND Consent = '01_Yes' AND Category = '02_A2: Senior Citizens' AND Indigent = '01_Indigent') 01_SAN_JUAN_Senior_Indigent,

SUM(Barangay = '_64524010_BARANGAY_I_(POB.)'  AND Consent = '01_Yes' AND Category = '04_A4: Frontline Personnel in Essential Sector' AND  Employer_name = 'PHILIPPINE NATIONAL POLICE') 01_BARANGAY_I_PNP,
SUM(Barangay = '_64524011_BARANGAY_II_(POB.)' AND Consent = '01_Yes' AND Category = '04_A4: Frontline Personnel in Essential Sector' AND  Employer_name = 'PHILIPPINE NATIONAL POLICE') 01_BARANGAY_II_PNP,
SUM(Barangay = '_64524012_BARANGAY_III_(POB.)' AND Consent = '01_Yes' AND Category = '04_A4: Frontline Personnel in Essential Sector' AND  Employer_name = 'PHILIPPINE NATIONAL POLICE') 01_BARANGAY_III_PNP,
SUM(Barangay = '_64524013_BARANGAY_IV_(POB.)' AND Consent = '01_Yes' AND Category = '04_A4: Frontline Personnel in Essential Sector' AND  Employer_name = 'PHILIPPINE NATIONAL POLICE') 01_BARANGAY_IV_PNP,
SUM(Barangay = '_64524014_BARANGAY_V_(POB.)' AND Consent = '01_Yes' AND Category = '04_A4: Frontline Personnel in Essential Sector' AND  Employer_name = 'PHILIPPINE NATIONAL POLICE') 01_BARANGAY_V_PNP,
SUM(Barangay = '_64524015_BARANGAY_VI_(POB.)' AND Consent = '01_Yes' AND Category = '04_A4: Frontline Personnel in Essential Sector' AND Employer_name = 'PHILIPPINE NATIONAL POLICE') 01_BARANGAY_VI_PNP,
SUM(Barangay = '_64524001_BAGONBON' AND Consent = '01_Yes' AND Category = '04_A4: Frontline Personnel in Essential Sector' AND  Employer_name = 'PHILIPPINE NATIONAL POLICE') 01_BAGONBON_PNP,
SUM(Barangay = '_64524002_BULUANGAN' AND Consent = '01_Yes' AND Category = '04_A4: Frontline Personnel in Essential Sector' AND  Employer_name = 'PHILIPPINE NATIONAL POLICE') 01_BULUANGAN_PNP,
SUM(Barangay = '_64524004_CODCOD' AND Consent = '01_Yes' AND Category = '04_A4: Frontline Personnel in Essential Sector' AND  Employer_name = 'PHILIPPINE NATIONAL POLICE') 01_CODCOD_PNP,
SUM(Barangay = '_64524005_ERMITA' AND Consent = '01_Yes' AND Category = '04_A4: Frontline Personnel in Essential Sector' AND  Employer_name = 'PHILIPPINE NATIONAL POLICE') 01_ERMITA_PNP,
SUM(Barangay = '_64524006_GUADALUPE' AND Consent = '01_Yes' AND Category = '04_A4: Frontline Personnel in Essential Sector' AND  Employer_name = 'PHILIPPINE NATIONAL POLICE') 01_GUADALUPE_PNP,
SUM(Barangay = '_64524008_NATABAN' AND Consent = '01_Yes' AND Category = '04_A4: Frontline Personnel in Essential Sector' AND  Employer_name = 'PHILIPPINE NATIONAL POLICE') 01_NATABAN_PNP,
SUM(Barangay = '_64524009_PALAMPAS' AND Consent = '01_Yes' AND Category = '04_A4: Frontline Personnel in Essential Sector' AND  Employer_name = 'PHILIPPINE NATIONAL POLICE') 01_PALAMPAS_PNP,
SUM(Barangay = '_64524016_PROSPERIDAD' AND Consent = '01_Yes' AND Category = '04_A4: Frontline Personnel in Essential Sector' AND Employer_name = 'PHILIPPINE NATIONAL POLICE') 01_PROSPERIDAD_PNP,
SUM(Barangay = '_64524017_PUNAO' AND Consent = '01_Yes' AND Category = '04_A4: Frontline Personnel in Essential Sector' AND  Employer_name = 'PHILIPPINE NATIONAL POLICE') 01_PUNAO_PNP,
SUM(Barangay = '_64524018_QUEZON' AND Consent = '01_Yes' AND Category = '04_A4: Frontline Personnel in Essential Sector' AND  Employer_name = 'PHILIPPINE NATIONAL POLICE') 01_QUEZON_PNP,
SUM(Barangay = '_64524019_RIZAL' AND Consent = '01_Yes' AND Category = '04_A4: Frontline Personnel in Essential Sector' AND  Employer_name = 'PHILIPPINE NATIONAL POLICE') 01_RIZAL_PNP,
SUM(Barangay = '_64524020_SAN_JUAN' AND Consent = '01_Yes' AND Category = '04_A4: Frontline Personnel in Essential Sector' AND  Employer_name = 'PHILIPPINE NATIONAL POLICE') 01_SAN_JUAN_PNP,


SUM(Barangay = '_64524010_BARANGAY_I_(POB.)'  AND Consent = '01_Yes' AND Category = '05_A5: Poor Population') 01_BARANGAY_I_Indigent,
SUM(Barangay = '_64524011_BARANGAY_II_(POB.)' AND Consent = '01_Yes' AND Category = '05_A5: Poor Population') 01_BARANGAY_II_Indigent,
SUM(Barangay = '_64524012_BARANGAY_III_(POB.)' AND Consent = '01_Yes' AND Category = '05_A5: Poor Population') 01_BARANGAY_III_Indigent,
SUM(Barangay = '_64524013_BARANGAY_IV_(POB.)' AND Consent = '01_Yes' AND Category = '05_A5: Poor Population') 01_BARANGAY_IV_Indigent,
SUM(Barangay = '_64524014_BARANGAY_V_(POB.)' AND Consent = '01_Yes' AND Category = '05_A5: Poor Population') 01_BARANGAY_V_Indigent,
SUM(Barangay = '_64524015_BARANGAY_VI_(POB.)' AND Consent = '01_Yes' AND Category = '05_A5: Poor Population') 01_BARANGAY_VI_Indigent,
SUM(Barangay = '_64524001_BAGONBON' AND Consent = '01_Yes' AND Category = '05_A5: Poor Population') 01_BAGONBON_Indigent,
SUM(Barangay = '_64524002_BULUANGAN' AND Consent = '01_Yes' AND Category = '05_A5: Poor Population') 01_BULUANGAN_Indigent,
SUM(Barangay = '_64524004_CODCOD' AND Consent = '01_Yes' AND Category = '05_A5: Poor Population') 01_CODCOD_Indigent,
SUM(Barangay = '_64524005_ERMITA' AND Consent = '01_Yes' AND Category = '05_A5: Poor Population') 01_ERMITA_Indigent,
SUM(Barangay = '_64524006_GUADALUPE' AND Consent = '01_Yes' AND Category = '05_A5: Poor Population') 01_GUADALUPE_Indigent,
SUM(Barangay = '_64524008_NATABAN' AND Consent = '01_Yes' AND Category = '05_A5: Poor Population') 01_NATABAN_Indigent,
SUM(Barangay = '_64524009_PALAMPAS' AND Consent = '01_Yes' AND Category = '05_A5: Poor Population') 01_PALAMPAS_Indigent,
SUM(Barangay = '_64524016_PROSPERIDAD' AND Consent = '01_Yes' AND Category = '05_A5: Poor Population') 01_PROSPERIDAD_Indigent,
SUM(Barangay = '_64524017_PUNAO' AND Consent = '01_Yes' AND Category = '05_A5: Poor Population') 01_PUNAO_Indigent,
SUM(Barangay = '_64524018_QUEZON' AND Consent = '01_Yes' AND Category = '05_A5: Poor Population') 01_QUEZON_Indigent,
SUM(Barangay = '_64524019_RIZAL' AND Consent = '01_Yes' AND Category = '05_A5: Poor Population') 01_RIZAL_Indigent,
SUM(Barangay = '_64524020_SAN_JUAN' AND Consent = '01_Yes' AND Category = '05_A5: Poor Population') 01_SAN_JUAN_Indigent,


SUM(Barangay = '_64524010_BARANGAY_I_(POB.)' AND Category = '01_A1: Health Care Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 01_TOTAL_BARANGAY_I,
SUM(Barangay = '_64524011_BARANGAY_II_(POB.)' AND Category = '01_A1: Health Care Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 01_TOTAL_BARANGAY_II,
SUM(Barangay = '_64524012_BARANGAY_III_(POB.)' AND Category = '01_A1: Health Care Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 01_TOTAL_BARANGAY_III,
SUM(Barangay = '_64524013_BARANGAY_IV_(POB.)' AND Category = '01_A1: Health Care Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 01_TOTAL_BARANGAY_IV,
SUM(Barangay = '_64524014_BARANGAY_V_(POB.)' AND Category = '01_A1: Health Care Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 01_TOTAL_BARANGAY_V,
SUM(Barangay = '_64524015_BARANGAY_VI_(POB.)' AND Category = '01_A1: Health Care Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 01_TOTAL_BARANGAY_VI,
SUM(Barangay = '_64524001_BAGONBON' AND Category = '01_A1: Health Care Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 01_TOTAL_BAGONBON,
SUM(Barangay = '_64524002_BULUANGAN' AND Category = '01_A1: Health Care Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 01_TOTAL_BULUANGAN,
SUM(Barangay = '_64524004_CODCOD' AND Category = '01_A1: Health Care Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 01_TOTAL_CODCOD,
SUM(Barangay = '_64524005_ERMITA' AND Category = '01_A1: Health Care Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 01_TOTAL_ERMITA,
SUM(Barangay = '_64524006_GUADALUPE' AND Category = '01_A1: Health Care Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 01_TOTAL_GUADALUPE,
SUM(Barangay = '_64524008_NATABAN' AND Category = '01_A1: Health Care Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 01_TOTAL_NATABAN,
SUM(Barangay = '_64524009_PALAMPAS' AND Category = '01_Health_Care_Worker' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 01_TOTAL_PALAMPAS,
SUM(Barangay = '_64524016_PROSPERIDAD' AND Category = '01_A1: Health Care Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 01_TOTAL_PROSPERIDAD,
SUM(Barangay = '_64524017_PUNAO' AND Category = '01_A1: Health Care Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 01_TOTAL_PUNAO,
SUM(Barangay = '_64524018_QUEZON' AND Category = '01_A1: Health Care Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 01_TOTAL_QUEZON,
SUM(Barangay = '_64524019_RIZAL' AND Category = '01_A1: Health Care Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 01_TOTAL_RIZAL,
SUM(Barangay = '_64524020_SAN_JUAN' AND Category = '01_A1: Health Care Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 01_TOTAL_SAN_JUAN,

SUM(Barangay = '_64524010_BARANGAY_I_(POB.)' AND HealthWorker = '01_Public_and_Private_Health_Facilities' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 01_BARANGAY_I,
SUM(Barangay = '_64524011_BARANGAY_II_(POB.)' AND HealthWorker = '01_Public_and_Private_Health_Facilities' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 01_BARANGAY_II,
SUM(Barangay = '_64524012_BARANGAY_III_(POB.)' AND HealthWorker = '01_Public_and_Private_Health_Facilities' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 01_BARANGAY_III,
SUM(Barangay = '_64524013_BARANGAY_IV_(POB.)' AND HealthWorker = '01_Public_and_Private_Health_Facilities' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 01_BARANGAY_IV,
SUM(Barangay = '_64524014_BARANGAY_V_(POB.)' AND HealthWorker = '01_Public_and_Private_Health_Facilities' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 01_BARANGAY_V,
SUM(Barangay = '_64524015_BARANGAY_VI_(POB.)' AND HealthWorker = '01_Public_and_Private_Health_Facilities' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 01_BARANGAY_VI,
SUM(Barangay = '_64524001_BAGONBON' AND HealthWorker = '01_Public_and_Private_Health_Facilities' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 01_BAGONBON,
SUM(Barangay = '_64524002_BULUANGAN' AND HealthWorker = '01_Public_and_Private_Health_Facilities' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 01_BULUANGAN,
SUM(Barangay = '_64524004_CODCOD' AND HealthWorker = '01_Public_and_Private_Health_Facilities' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 01_CODCOD,
SUM(Barangay = '_64524005_ERMITA' AND HealthWorker = '01_Public_and_Private_Health_Facilities' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 01_ERMITA,
SUM(Barangay = '_64524006_GUADALUPE' AND HealthWorker = '01_Public_and_Private_Health_Facilities' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 01_GUADALUPE,
SUM(Barangay = '_64524008_NATABAN' AND HealthWorker = '01_Public_and_Private_Health_Facilities' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 01_NATABAN,
SUM(Barangay = '_64524009_PALAMPAS' AND HealthWorker = '01_Public_and_Private_Health_Facilities' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 01_PALAMPAS,
SUM(Barangay = '_64524016_PROSPERIDAD' AND HealthWorker = '01_Public_and_Private_Health_Facilities' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 01_PROSPERIDAD,
SUM(Barangay = '_64524017_PUNAO' AND HealthWorker = '01_Public_and_Private_Health_Facilities' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 01_PUNAO,
SUM(Barangay = '_64524018_QUEZON' AND HealthWorker = '01_Public_and_Private_Health_Facilities' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 01_QUEZON,
SUM(Barangay = '_64524019_RIZAL' AND HealthWorker = '01_Public_and_Private_Health_Facilities' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 01_RIZAL,
SUM(Barangay = '_64524020_SAN_JUAN' AND HealthWorker = '01_Public_and_Private_Health_Facilities' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 01_SAN_JUAN,

SUM(Barangay = '_64524010_BARANGAY_I_(POB.)' AND HealthWorker = '02_Public_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 02_BARANGAY_I,
SUM(Barangay = '_64524011_BARANGAY_II_(POB.)' AND HealthWorker = '02_Public_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 02_BARANGAY_II,
SUM(Barangay = '_64524012_BARANGAY_III_(POB.)' AND HealthWorker = '02_Public_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 02_BARANGAY_III,
SUM(Barangay = '_64524013_BARANGAY_IV_(POB.)' AND HealthWorker = '02_Public_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 02_BARANGAY_IV,
SUM(Barangay = '_64524014_BARANGAY_V_(POB.)' AND HealthWorker = '02_Public_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 02_BARANGAY_V,
SUM(Barangay = '_64524015_BARANGAY_VI_(POB.)' AND HealthWorker = '02_Public_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 02_BARANGAY_VI,
SUM(Barangay = '_64524001_BAGONBON' AND HealthWorker = '02_Public_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 02_BAGONBON,
SUM(Barangay = '_64524002_BULUANGAN' AND HealthWorker = '02_Public_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 02_BULUANGAN,
SUM(Barangay = '_64524004_CODCOD' AND HealthWorker = '02_Public_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 02_CODCOD,
SUM(Barangay = '_64524005_ERMITA' AND HealthWorker = '02_Public_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 02_ERMITA,
SUM(Barangay = '_64524006_GUADALUPE' AND HealthWorker = '02_Public_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 02_GUADALUPE,
SUM(Barangay = '_64524008_NATABAN' AND HealthWorker = '02_Public_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 02_NATABAN,
SUM(Barangay = '_64524009_PALAMPAS' AND HealthWorker = '02_Public_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 02_PALAMPAS,
SUM(Barangay = '_64524016_PROSPERIDAD' AND HealthWorker = '02_Public_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 02_PROSPERIDAD,
SUM(Barangay = '_64524017_PUNAO' AND HealthWorker = '02_Public_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 02_PUNAO,
SUM(Barangay = '_64524018_QUEZON' AND HealthWorker = '02_Public_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 02_QUEZON,
SUM(Barangay = '_64524019_RIZAL' AND HealthWorker = '02_Public_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 02_RIZAL,
SUM(Barangay = '_64524020_SAN_JUAN' AND HealthWorker = '02_Public_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 02_SAN_JUAN,

SUM(Barangay = '_64524010_BARANGAY_I_(POB.)' AND HealthWorker = '03_Barangay_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 03_BARANGAY_I,
SUM(Barangay = '_64524011_BARANGAY_II_(POB.)' AND HealthWorker = '03_Barangay_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 03_BARANGAY_II,
SUM(Barangay = '_64524012_BARANGAY_III_(POB.)' AND HealthWorker = '03_Barangay_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 03_BARANGAY_III,
SUM(Barangay = '_64524013_BARANGAY_IV_(POB.)' AND HealthWorker = '03_Barangay_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 03_BARANGAY_IV,
SUM(Barangay = '_64524014_BARANGAY_V_(POB.)' AND HealthWorker = '03_Barangay_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 03_BARANGAY_V,
SUM(Barangay = '_64524015_BARANGAY_VI_(POB.)' AND HealthWorker = '03_Barangay_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 03_BARANGAY_VI,
SUM(Barangay = '_64524001_BAGONBON' AND HealthWorker = '03_Barangay_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 03_BAGONBON,
SUM(Barangay = '_64524002_BULUANGAN' AND HealthWorker = '03_Barangay_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 03_BULUANGAN,
SUM(Barangay = '_64524004_CODCOD' AND HealthWorker = '03_Barangay_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 03_CODCOD,
SUM(Barangay = '_64524005_ERMITA' AND HealthWorker = '03_Barangay_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 03_ERMITA,
SUM(Barangay = '_64524006_GUADALUPE' AND HealthWorker = '03_Barangay_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 03_GUADALUPE,
SUM(Barangay = '_64524008_NATABAN' AND HealthWorker = '03_Barangay_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 03_NATABAN,
SUM(Barangay = '_64524009_PALAMPAS' AND HealthWorker = '03_Barangay_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 03_PALAMPAS,
SUM(Barangay = '_64524016_PROSPERIDAD' AND HealthWorker = '03_Barangay_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 03_PROSPERIDAD,
SUM(Barangay = '_64524017_PUNAO' AND HealthWorker = '03_Barangay_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 03_PUNAO,
SUM(Barangay = '_64524018_QUEZON' AND HealthWorker = '03_Barangay_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 03_QUEZON,
SUM(Barangay = '_64524019_RIZAL' AND HealthWorker = '03_Barangay_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 03_RIZAL,
SUM(Barangay = '_64524020_SAN_JUAN' AND HealthWorker = '03_Barangay_Health_Workers' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 03_SAN_JUAN,

SUM(Barangay = '_64524010_BARANGAY_I_(POB.)' AND HealthWorker = '04_Other_NGAs' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 04_BARANGAY_I,
SUM(Barangay = '_64524011_BARANGAY_II_(POB.)' AND HealthWorker = '04_Other_NGAs' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 04_BARANGAY_II,
SUM(Barangay = '_64524012_BARANGAY_III_(POB.)' AND HealthWorker = '04_Other_NGAs' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 04_BARANGAY_III,
SUM(Barangay = '_64524013_BARANGAY_IV_(POB.)' AND HealthWorker = '04_Other_NGAs' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 04_BARANGAY_IV,
SUM(Barangay = '_64524014_BARANGAY_V_(POB.)' AND HealthWorker = '04_Other_NGAs' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 04_BARANGAY_V,
SUM(Barangay = '_64524015_BARANGAY_VI_(POB.)' AND HealthWorker = '04_Other_NGAs' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 04_BARANGAY_VI,
SUM(Barangay = '_64524001_BAGONBON' AND HealthWorker = '04_Other_NGAs' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 04_BAGONBON,
SUM(Barangay = '_64524002_BULUANGAN' AND HealthWorker = '04_Other_NGAs' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 04_BULUANGAN,
SUM(Barangay = '_64524004_CODCOD' AND HealthWorker = '04_Other_NGAs' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 04_CODCOD,
SUM(Barangay = '_64524005_ERMITA' AND HealthWorker = '04_Other_NGAs' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 04_ERMITA,
SUM(Barangay = '_64524006_GUADALUPE' AND HealthWorker = '04_Other_NGAs' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 04_GUADALUPE,
SUM(Barangay = '_64524008_NATABAN' AND HealthWorker = '04_Other_NGAs' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 04_NATABAN,
SUM(Barangay = '_64524009_PALAMPAS' AND HealthWorker = '04_Other_NGAs' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 04_PALAMPAS,
SUM(Barangay = '_64524016_PROSPERIDAD' AND HealthWorker = '04_Other_NGAs' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 04_PROSPERIDAD,
SUM(Barangay = '_64524017_PUNAO' AND HealthWorker = '04_Other_NGAs' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 04_PUNAO,
SUM(Barangay = '_64524018_QUEZON' AND HealthWorker = '04_Other_NGAs' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 04_QUEZON,
SUM(Barangay = '_64524019_RIZAL' AND HealthWorker = '04_Other_NGAs' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 04_RIZAL,
SUM(Barangay = '_64524020_SAN_JUAN' AND HealthWorker = '04_Other_NGAs' AND Consent = '01_Yes' AND Category = '01_A1: Health Care Workers') 04_SAN_JUAN


FROM tbl_vaccine where Consent = '01_Yes' ";

$PHPJasperXML->transferDBtoArray($host, $username, $password, $db_name);
$PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file



?>