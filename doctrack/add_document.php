<?php


session_start();

$objid = $type = $description = $status  = '';
$btnNew = 'disabled';
$btnStatus = '';

if (!isset($_SESSION['id'])) {
  header('location:../index');
}
$user_id = $_SESSION['id'];

include('../config/db_config.php');
include('insert_document.php');

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
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Add Document Type</h3>
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
                    <label>Code:</label>
                  </div>
                  <div class="col-md-10">
                    <input type="text" class="form-control" name="doc_code" placeholder="Document Code" value="<?php echo
                                                                                                                $objid; ?>" required>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Type:</label>
                  </div>
                  <div class="col-md-10">
                    <input type="text" class="form-control" name="type" placeholder="Document Type" value="<?php echo
                                                                                                            $type; ?>" required>
                  </div>
                </div><br>


                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Description:</label>
                  </div>
                  <div class="col-md-10">
                    <textarea rows="5" class="form-control" name="description" placeholder="Description" required><?php echo
                                                                                                                  $description; ?></textarea>
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
                  <input type="submit" <?php echo $btnStatus; ?> name="insert_document" class="btn btn-primary" value="Save">
                  <a href="committee">
                    <input type="button" name="cancel" class="btn btn-default" value="Cancel">
                  </a>
                </div><br>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>



      </section>
      <!-- /.content -->
    </div>
    <?php include('footer.php') ?>

  </div>
  <!-- /.content-wrapper -->


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



</body>

</html>