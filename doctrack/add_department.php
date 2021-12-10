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
  <title>LGUSCC DTS | Add Department</title>
  <?php include('heading.php') ?>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php include('sidebar.php') ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <div class="content-header"></div>


      <!-- Main content -->
      <section class="content">
        <div class="card">
          <div class="card-header bg-success">
            <h3 class="card-title">Add Department</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">

            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="<?php htmlspecialchars("PHP_SELF"); ?>">
              <div class="box-body">
                <?php echo $alert_msg; ?>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>ID:</label>
                  </div>
                  <div class="col-md-10">
                    <input type="text" class="form-control" name="code" placeholder="Department/Office ID" value="<?php echo
                                                                                                                  $objid; ?>" required>
                  </div>
                </div><br>


                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Department/Office:</label>
                  </div>
                  <div class="col-md-10">
                    <textarea rows="5" class="form-control" name="department" placeholder="Full name of Department/Office" required><?php echo
                                                                                                                                    $department; ?></textarea>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <!-- <div class="form-group"> -->
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



                <!-- /.box-body -->
                <div class="box-footer" align="center">
                  <input type="submit" <?php echo $btnNew; ?> name="add" class="btn btn-primary" value="New">
                  <input type="submit" <?php echo $btnStatus; ?> name="insert_department" class="btn btn-primary" value="Save">
                  <a href="department">
                    <input type="button" name="cancel" class="btn btn-default" value="Cancel">
                  </a>
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

  <?php include('footer.php') ?>


  <?php include('scripts.php') ?>

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