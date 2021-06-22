<?php



include ('../config/db_config.php');


$user_id = $_SESSION['id'];

if (!isset($_SESSION['id'])) {
    header('location:../index.php');
} else {

}



$sql="SELECT itemcode, itemname FROM tbl_items";
$row=$con->prepare($sql);
$row->execute();
$result=$row->fetchAll(PDO::FETCH_ASSOC);


echo json_encode(array('data'=>$result));


?>


