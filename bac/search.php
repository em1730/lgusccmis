<?php



session_start();

include ('../config/db_config.php');
// $id= N
$id = $_GET['q'];
$sql = "SELECT itemcategory from tbl_itemcategory where itemcategory like '%".$id."%' ";
$result = $con->query($sql);


if($result->num_rows > 1){
    while($row = $result->fetch_assoc()){
        echo $row["itemcategory"]. "\n";
    }

}else {
    echo "0 results.";
}
$con->close();


?>