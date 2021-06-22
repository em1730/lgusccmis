<?php


session_start();

$first_name = $middle_name = $userpass = $location = $last_name = $email = $userpass = $status  = $contact_no = $username = $position = $account_type = $btnStatus = $get_department = $users_id = '';
$btnNew = 'disabled';

if (!isset($_SESSION['id'])) {
  header('location:../index');
}
$users_id = $_SESSION['id'];

include('../config/db_config.php');
include('update_for_user.php');

//select users
$get_users_sql = "SELECT * FROM tbl_users WHERE user_id = :user_id";
$users_data = $con->prepare($get_users_sql);
$users_data->execute([':user_id' => $users_id]);
while ($result = $users_data->fetch(PDO::FETCH_ASSOC)) {
  $users_id = $result['user_id'];
  $first_name = $result['first_name'];
  $middle_name = $result['middle_name'];
  $last_name = $result['last_name'];
  $contact_no = $result['contact_no'];
  $position = $result['position'];
  $email = $result['email'];
  $username = $result['username'];
  $userpass = $result['userpass'];
  $account_type = $result['account_type'];
  $get_department = $result['department'];
  $location = $result['location'];
  $status = $result['status'];
}
$get_all_department_sql = "SELECT * FROM tbl_department";
$get_all_department_data = $con->prepare($get_all_department_sql);
$get_all_department_data->execute();


if (isset($_GET['id'])) {
  $user_id = $_GET['id'];

  $get_users_sql = "SELECT * FROM tbl_users WHERE user_id = :id";
  $users_data = $con->prepare($get_users_sql);
  $users_data->execute([':id' => $user_id]);
  while ($result = $users_data->fetch(PDO::FETCH_ASSOC)) {
    $user_id = $result['user_id'];
    $first_name = $result['first_name'];
    $middle_name = $result['middle_name'];
    $last_name = $result['last_name'];
    $contact_number = $result['contact_no'];
    $position = $result['position'];
    $email = $result['email'];
    $username = $result['username'];
    $userpass = $result['userpass'];
    $account_type = $result['account_type'];
    $get_department = $result['department'];
    $location = $result['location'];
    $status = $result['status'];
  }
}

$title = "LGUSCC | View Users"
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title ?></title>
  <?php include('head.php') ?>

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php include('sidebar.php') ?>

    <div class="content-wrapper">
      <div class="content-header"></div>


      <!-- Main content -->
      <section class="content">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Update Users</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">

            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="<?php htmlspecialchars("PHP_SELF"); ?>">
              <div class="box-body">


                <div class="row">

                  <div class="col-md-10">
                    <input type="hidden" class="form-control" name="user_id" placeholder="Type N/A if not applicable" value="<?php echo $user_id ?>" required>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>First Name</label>
                  </div><br>
                  <div class="col-md-10">
                    <input type="text" class="form-control" name="first_name" placeholder="Firstname" value="<?php echo $first_name ?>" required>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Middle Name</label>
                  </div>
                  <div class="col-md-10">
                    <input type="text" class="form-control" name="middle_name" placeholder="Middlename" value="<?php echo $middle_name ?>" required>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Last Name</label>
                  </div>
                  <div class="col-md-10">
                    <input type="text" class="form-control" name="last_name" placeholder="Lastname" value="<?php echo $last_name ?>" required>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Contact Number</label>
                  </div>
                  <div class="col-md-10">
                    <input type="text" class="form-control" name="contact_no" placeholder="Contact Number" value="<?php echo $contact_no ?>" required>
                  </div><br>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Position</label>
                  </div>
                  <div class="col-md-10">
                    <input type="text" class="form-control" name="position" placeholder="Position" value="<?php echo $position ?>" required>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Email</label>
                  </div>
                  <div class="col-md-10">
                    <input type="text" class="form-control" name="address" placeholder="Email" value="<?php echo $email ?>">
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Username</label>
                  </div>
                  <div class="col-md-10">
                    <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $username ?>">
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>User Password</label>
                  </div>
                  <div class="col-md-10">
                    <input type="text" class="form-control" name="userpass" placeholder="User Password" value="<?php echo $userpass ?>">
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Account Type</label>
                  </div>
                  <div class="col-md-10">
                    <input type="text" class="form-control" name="account_type" placeholder="Account Type" value="<?php echo $account_type ?>" required>
                  </div>
                </div><br>



                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Department:</label>
                  </div>
                  <div class="col-md-10">
                    <select class="form-control select2" style="width: 100%;" name="department" value="">
                      <option>Please select...</option>
                      <?php while ($get_dept = $get_all_department_data->fetch(PDO::FETCH_ASSOC)) { ?>
                        <?php $selected = ($get_department == $get_dept['objid']) ? 'selected' : ''; ?>
                        <option <?= $selected; ?> value="<?php echo $get_dept['objid']; ?>"><?php echo $get_dept['department']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                </br>



                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Location</label>
                  </div>
                  <div class="col-md-10">
                    <input type="text" class="form-control" name="location" placeholder="Location" value="<?php echo $location ?>" required>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Status</label>
                  </div>
                  <div class="col-md-10">

                    <select class="form-control select2" style="width: 100%;" name="status" value="<?php echo
                                                                                                    $status; ?>">
                      <option>Please select...</option>
                      <option <?php if ($status == 'Active') echo 'selected'; ?> value="Active">Active </option>
                      <option <?php if ($status == 'Inactive') echo 'selected'; ?> value="Inactive">Inactive </option>

                    </select>
                  </div>
                </div><br>
                <div class="box-footer" align="center">
                    <input type="submit" <?php echo $btnStatus; ?> name="update_for_user.php" class="btn btn-success" value="Update">
                  </a>

                  <a href="list_users.php">
                    <input type="button" name="cancel" class="btn btn-danger" value="Cancel">
                  </a>
                </div>

                <!-- /.box-body -->
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
      </section>
    </div>
    <!-- /.content -->
  </div>
  </div>
  <!-- /.content-wrapper -->

  <!-- footer here -->



  <!-- footer here -->
  <?php include('footer.php') ?>
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