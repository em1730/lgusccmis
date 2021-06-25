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
$xml = $PHPJasperXML->load_xml_file("eligible_population.jrxml");
// $PHPJasperXML->xml_dismantle($xml);
// $PHPJasperXML->sql = "SELECT r.trace_no,r.date,t.fullname from tbl_tracehistory r inner join tbl_individual t on t.entity_no = r.trace_no where  r.entity_no ='" . $entity_no . "'";

$PHPJasperXML->sql = "SELECT
SUM(Category = '01_A1: Health Care Workers') AS A1,
SUM(Category = '02_A2: Senior Citizens') AS A2,
SUM(Category = '03_A3: Adult with Comorbidity') AS A3,
SUM(Category = '04_A4: Frontline Personnel in Essential Sector') AS A4,
SUM(Category = '05_A5: Poor Population') AS A5,

SUM(Category = '06_B1: Teachers and Social Workers') AS B1,
SUM(Category = '07_B2: Other Government Workers') AS B2,
SUM(Category = '08_B3: Other Essential Workers') AS B3,
SUM(Category = '09_B4: Socio-demographic Groups') AS B4,
SUM(Category = '10_B5: Overseas Filipino Workers') AS B5,
SUM(Category = '11_B6: Other Remaining Workforce') AS B6,

SUM(Category = '12_C: Rest of the Population') AS C1
FROM tbl_vaccine ";

$PHPJasperXML->transferDBtoArray($host, $username, $password, $db_name);
$PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file



?>