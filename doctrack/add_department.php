<?php


session_start();

$objid = $department =  $status  = '';
$btnNew = 'disabled';
$btnStatus = '';

if (!isset($_SESSION['id'])) {
  header('location:../index');
}
$user_id = $_SESSION['id'];

include('../config/db_config.php');
include('insert_department.php');

//select user
$get_user_sql = "SELECT * FROM tbl_users WHERE user_id = :id";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {
  $db_first_name = $result['first_name'];
  $db_middle_name = $result['middle_name'];
  $db_last_name = $result['last_name'];
  $db_email_ad = $result['email'];
  $db_contact_number = $result['contact_no'];
  $db_user_name = $result['username'];
}


?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LGUSCC DTS | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php include('heading.php') ?>

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php include('sidebar.php') ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="content-header"></div>

      <!-- Content Header (Page header) -->


      <!-- Main content -->
      <section class="content">


      </section>

    </div>

 
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2019 ITCSO <a href="http://lguscc.gov.ph">Local Government of San Carlos City</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 2.0.0-alpha
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->


  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <!-- <script src="../dist/css/jquery-ui.min.js"></script> -->
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    // $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Morris.js charts -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script> -->
  <!-- <script src="../plugins/morris/morris.min.js"></script> -->
  <!-- Sparkline -->
  <!-- <script src="../plugins/sparkline/jquery.sparkline.min.js"></script> -->
  <!-- jvectormap -->
  <!-- <script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script> -->
  <!-- <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script> -->
  <!-- jQuery Knob Chart -->
  <!-- <script src="../plugins/knob/jquery.knob.js"></script> -->
  <!-- daterangepicker -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script> -->
  <!-- <script src="../plugins/daterangepicker/daterangepicker.js"></script> -->
  <!-- datepicker -->
  <script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  <!-- Slimscroll -->
  <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="../plugins/fastclick/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="../dist/js/pages/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js"></script>
  <!-- DataTables -->
  <script src="../plugins/datatables/jquery.dataTables.js"></script>
  <script src="../plugins/datatables/dataTables.bootstrap4.js"></script>
  <!-- Select2 -->
  <script src="../plugins/select2/select2.full.min.js"></script>
  <!-- Page script -->

  <script>
    $('#users').DataTable({
      'paging': true,
      'lengthChange': true,
      'searching': true,
      'ordering': true,
      'info': true,
      'autoWidth': true,
      'autoHeight': true
    })
  </script>

  <script type="text/javascript">
    $(document).ready(function() {

      $(document).ajaxStart(function() {
        Pace.restart()
      })

    });
  </script>


</body>

</html>