<?php

include('../config/db_config.php');



$docno = '';


if (!isset($_SESSION['id'])) {
  header('location:../index.php');
} else {
}

$user_id = $_SESSION['id'];

$get_user_sql = "SELECT * FROM tbl_users where user_id = :id";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {


  $db_first_name = $result['first_name'];
  $db_middle_name = $result['middle_name'];
  $db_last_name = $result['last_name'];
  $db_email_ad = $result['email'];
  $db_contact_number = $result['contact_no'];
  $db_user_name = $result['username'];
  $department = $result['department'];
}





$get_noofdocs_sql = "SELECT COUNT(`docno`) as total FROM `tbl_documents` WHERE status in ('CREATED','FORWARDED') and destination = '$department'";
$get_noofdocs_data = $con->prepare($get_noofdocs_sql);
$get_noofdocs_data->execute();
$get_noofdocs_data->setFetchMode(PDO::FETCH_ASSOC);
while ($result1 = $get_noofdocs_data->fetch(PDO::FETCH_ASSOC)) {
  $incoming_count =  $result1['total'];
}

//count incoming documents
$get_noofdocs_sql = "SELECT COUNT(`docno`) as total FROM `tbl_documents` WHERE status in ('CREATED','FORWARDED') and destination = '$department'";
$get_noofdocs_data = $con->prepare($get_noofdocs_sql);
$get_noofdocs_data->execute();
$get_noofdocs_data->setFetchMode(PDO::FETCH_ASSOC);
while ($result1 = $get_noofdocs_data->fetch(PDO::FETCH_ASSOC)) {
  $incoming_count =  $result1['total'];
}


//count incoming documents
$get_noofdocs_sql = "SELECT COUNT(`docno`) as total FROM `tbl_documents` WHERE status = 'RECEIVED' and destination = '$department'";
$get_noofdocs_data = $con->prepare($get_noofdocs_sql);
$get_noofdocs_data->execute();
$get_noofdocs_data->setFetchMode(PDO::FETCH_ASSOC);
while ($result1 = $get_noofdocs_data->fetch(PDO::FETCH_ASSOC)) {
  $received_count =  $result1['total'];
}

$get_noofdocs_sql = "SELECT COUNT(`docno`) as total FROM `tbl_documents` where origin = '$department'";
$get_noofdocs_data = $con->prepare($get_noofdocs_sql);
$get_noofdocs_data->execute();
$get_noofdocs_data->setFetchMode(PDO::FETCH_ASSOC);
while ($result1 = $get_noofdocs_data->fetch(PDO::FETCH_ASSOC)) {
  $outgoing_count =  $result1['total'];
}

$get_noofdocs_sql = "SELECT COUNT(`docno`) as total FROM `tbl_documents` WHERE status = 'ARCHIVED' and destination = '$department'";
$get_noofdocs_data = $con->prepare($get_noofdocs_sql);
$get_noofdocs_data->execute();
$get_noofdocs_data->setFetchMode(PDO::FETCH_ASSOC);
while ($result1 = $get_noofdocs_data->fetch(PDO::FETCH_ASSOC)) {
  $archived_count =  $result1['total'];
}

?>


<div class="container-fluid">
  <!-- Info boxes -->
  <div class="row">
    <!-- <div class="col-12 col-sm-6 col-md-2">
      <div class="info-box bg-info-gradient">

        <span class="info-box-icon bg-info elevation-1"> <a href="list_incoming.php"> <i class="fa fa-search"></i></a></span>

        <div class="info-box-content">

          <span class="info-box-text">Track Document</span>
          <span class="info-box-number">
            <?php echo $incoming_count ?>

          </span>
        </div>

      </div>

    </div> -->
    <div class="col-12 col-sm-6 col-md-2">
      <div class="info-box bg-info-gradient">

        <span class="info-box-icon bg-info elevation-1"> <a href="list_incoming.php"> <i class="fa fa-arrow-circle-down"></i></a></span>

        <div class="info-box-content">

          <span class="info-box-text">Incoming</span>
          <span class="info-box-number">
            <?php echo $incoming_count ?>

          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-2">
      <div class="info-box bg-danger-gradient">
        <span class="info-box-icon bg-danger elevation-1"> <a href="list_received.php"> <i class="fa fa-folder-open"></i></a></span>

        <div class="info-box-content">
          <span class="info-box-text">Received</span>
          <span class="info-box-number">
            <?php echo $received_count ?>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>

    <div class="col-12 col-sm-6 col-md-2">
      <div class="info-box bg-success-gradient">
        <span class="info-box-icon bg-success elevation-1"><a href="list_outgoing.php"> <i class="fa fa-arrow-circle-up"></i></a></span>

        <div class="info-box-content">
          <span class="info-box-text">Outgoing</span>
          <?php echo $outgoing_count ?>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-2">
      <div class="info-box bg-warning-gradient">
        <span class="info-box-icon bg-warning elevation-1"> <a href="list_archived.php"> <i class="fa fa-archive"></i></a></span>

        <div class="info-box-content">
          <span class="info-box-text">Archive</span>
          <?php echo $archived_count ?>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  <!-- /.row -->
  <!-- Main row -->

  <!-- /.box -->
</div>