 <?php
    include('../config/db_config.php');


  $alert_msg = '';
  $alert_msg1 ='';

 if (isset($_GET['Fullname'])) {

    //select filename
    $fname = $_GET['Fullname'];
    $get_fname_sql = "SELECT * FROM employee where fullname = :fname";
    $get_fname_data = $con->prepare($get_fname_sql);
    $get_fname_data->execute([':fname' => $fname]);
    while ($result = $get_fname_data->fetch(PDO::FETCH_ASSOC)) {
        $update_fname = $result['fullname'];
        $get_post = $result['position'];
        $get_div = $result['division'];
       
    }
}
?>