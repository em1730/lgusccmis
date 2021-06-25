<?php

session_start();

$alert_msg = '';
$db_user_name = $db_first_name = $db_middle_name = $db_last_name = $db_email_ad = $db_contact_number = '';

if (!isset($_SESSION['id'])) {
  header('location:../index.php');
}

$user_id = $_SESSION['id'];

include('../config/db_config.php');
include('send_email_now.php');

$get_all_user_sql = "SELECT * FROM tbl_users WHERE user_id = :id";
$get_all_user_data = $con->prepare($get_all_user_sql);
$get_all_user_data->execute([':id' => $user_id]);
while ($result = $get_all_user_data->fetch(PDO::FETCH_ASSOC)) {

  $db_user_name = $result['username'];
  $db_first_name = $result['first_name'];
  $db_middle_name = $result['middle_name'];
  $db_last_name = $result['last_name'];
  $db_email_ad = $result['email'];
  // $db_contact_number = $result['contact_number'];

}


//select all users
$get_users_sql = "SELECT * FROM tbl_users WHERE user_id != :id";
$get_users_data = $con->prepare($get_users_sql);
$get_users_data->execute(['id' => $user_id]);

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

   <?php include('sidebar.php')?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="content-header"></div>
      <!-- Content Header (Page header) -->
     
      <!-- Main content -->
      <section class="content">
        


        <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-10">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Send Message</h3>
              </div>

              <!-- /.box-header -->
              <!-- form start -->
              <form role="form" method="post" action="<?php htmlspecialchars("PHP_SELF"); ?>">
                <div class="box-body">
                  <?php echo $alert_msg; ?>
                  <div class="row">
                    <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                      <label></label>
                    </div>

                  </div><br>
                  <div class="row">
                    <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                      <label>From</label>
                    </div>
                    <div class="col-md-10">
                      <input readonly type="text" class="form-control" name="sender_fullname" value="<?php echo ucfirst($db_first_name) . ' ' . ucwords($db_middle_name[0]) . '. ' . ucfirst($db_last_name); ?>">
                    </div>
                  </div><br>
                  <div class="row">
                    <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                      <label>Email</label>
                    </div>
                    <div class="col-md-10">
                      <input readonly type="text" class="form-control" name="sender_email" value="<?php echo $db_email_ad; ?>">
                    </div>
                  </div><br>
                  <hr>
                  <div class="row">
                    <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                      <label>To</label>
                    </div>
                    <div class="col-md-10">
                      <select class="form-control select2" id="select_receiver" style="width: 100%;" onchange="get_email()" name="receiver_email">
                        <option selected="selected" value="Choose recipient">Choose</option>
                        <?php while ($users = $get_users_data->fetch(PDO::FETCH_ASSOC)) { ?>
                          <option value="<?php echo $users['user_id']; ?>"><?php echo $users['first_name'] . ' ' . $users['middle_name'] . ' ' . $users['last_name']; ?></option>
                        <?php } ?>
                      </select>

                    </div>
                  </div><br>
                  <!-- <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Email</label>
                  </div>
                  <div class="col-md-10">
                      <input readonly type="text" id="receiver_email" class="form-control" name="this_receiver_email" placeholder="Choose recipient">
                  </div>
                </div><br> -->
                  <div class="row">
                    <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                      <label>Subject</label>
                    </div>
                    <div class="col-md-10">
                      <input type="text" class="form-control" name="email_subject" placeholder="Email Subject" required="">
                    </div>
                  </div><br>
                  <div class="row">
                    <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                      <label>Message</label>
                    </div>
                    <div class="col-md-10">
                      <textarea class="form-control" name="message" rows="4" cols="50" placeholder="Your message" required></textarea>

                    </div>
                  </div><br>

                </div>
                <!-- /.box-body -->
                <div class="box-footer" align="center">

                  <input type="submit" name="send_message" class="btn btn-primary" value="Send Message">
                </div>
              </form>
            </div>
            <!-- /.box -->
          </div>
          <div class="col-md-1"></div>
        </div>

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- footer here -->
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
      </div>
      <strong>Copyright &copy; <?php echo 2018; ?>.</strong> All rights
      reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

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
  <script src="../dist/js/adminlte.min.js"></script>

  <script type="text/javascript">
    function get_email() {
      var contact_number = document.getElementById("select_receiver").value;
      $('#receiver_email').val(contact_number);
    }

    $(document).ready(function() {

      $(document).ajaxStart(function() {
        Pace.restart()
      })

      //select 2
      $('.select2').select2();


    });
  </script>


</body>

</html>