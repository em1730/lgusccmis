<?php

session_start();

if (!isset($_SESSION['id'])) {
  header('location:../index.php');
}


$db_first_name = $db_last_name = $type = $db_middle_name =
  $itemcode = $itemname = $category = $itemunit = $status =
  $quantity = $price = $itemunit =
  $btnSave = $btnNew = $description = '';

$user_id = $_SESSION['id'];

include('../config/db_config.php');
include('sql_querries.php');
// include('insert_item.php');
// include('generate_serial.php');

$get_user_sql = "SELECT * FROM tbl_users WHERE user_id = :id";
$get_user_data = $con->prepare($get_user_sql);
$get_user_data->execute([':id' => $user_id]);
while ($result = $get_user_data->fetch(PDO::FETCH_ASSOC)) {
  $db_first_name = $result['first_name'];
  $db_middle_name = $result['middle_name'];
  $db_last_name = $result['last_name'];
}

//select all users
$get_all_items_sql = "SELECT * FROM tbl_items WHERE status = 'Active' ORDER BY idno DESC";
$get_all_items_data = $con->prepare($get_all_items_sql);
$get_all_items_data->execute();




?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HM SYSTEM | List of Items</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="../plugins/select2/select2.min.css">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php include('sidebar.php'); ?>
    <div class="content-wrapper">
      <div class="content-header"></div>

      <section class="content">
        <div class="card card-info">
          <div class="card-header">
            <h4>List of Products / Items
              <a href="add_item" style="float:right;" type="button" class="btn btn-success bg-gradient-success" style="border-radius: 0px;">
                <i class="nav-icon fa fa-plus"></i></a>
            </h4>

          </div>

          <div class="card-body">
            <div class="box box-primary">
              <form role="form" method="get" action="">
                <div class="box-body">
                  <table id="users" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Options</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while ($items_data = $get_all_items_data->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                          <!-- <td><input type="checkbox" value ="" name="" /> -->

                          <td><?php echo $items_data['itemcode']; ?></td>
                          <td><?php echo $items_data['itemname']; ?></td>
                          <td><?php echo $items_data['category']; ?></td>
                          <td><?php echo $items_data['description']; ?></td>

                          <td>
                            <a class="btn btn-success btn-sm" href="view_item.php?objid=<?php echo $items_data['objid']; ?>&id=<?php echo $items_data['itemcode']; ?> ">
                              <i class="fa fa-eye"></i>
                            </a>
                            <!-- <button class="btn btn-danger btn-sm" data-role="confirm_delete" data-id="<?php echo $items_data["idno"]; ?>"><i class="fa fa-trash-o"></i>
                            </button> -->
                            <!-- <button class="btn btn-success btn-sm" data-role="confirm_view" data-id="<?php echo $items_data["idno"]; ?>"><i class="fa fa-eye"></i></button> -->
                            <button class="btn btn-danger btn-sm" data-role="confirm_delete" data-id="<?php echo $items_data["idno"]; ?>"><i class="fa fa-trash-o"></i>
                            </button>
                            &nbsp;

                          </td>
                        </tr>
                      <?php } ?>

                    </tbody>

                  </table>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>

    </div>


    <?php include('footer.php'); ?>

  </div>





  <!-- DELETE MODAL -->
  <div class="modal fade" id="delete_PUMl" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Confirm Delete</h4>
        </div>
        <form method="POST" action="">
          <div class="modal-body">
            <div class="box-body">
              <div class="form-group">
                <label>Delete Record?</label>
                <input readonly="true" type="text" name="user_id" id="user_id" class="form-control">
              </div>
            </div>
          </div>
          <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left bg-olive" data-dismiss="modal">No</button>
            <!-- <button type="submit" name="delete_user" class="btn btn-danger">Yes</button> -->
            <input type="submit" name="delete_item" class="btn btn-danger" value="Yes">
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>










  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Morris.js charts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="../plugins/morris/morris.min.js"></script>
  <!-- Sparkline -->
  <script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
  <!-- jvectormap -->
  <script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="../plugins/knob/jquery.knob.js"></script>
  <!-- daterangepicker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
  <script src="../plugins/daterangepicker/daterangepicker.js"></script>
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
  <script src="../plugins/select2/select2.full.min.js"></script>
  <script>
    $('#users').DataTable({
      'paging': true,
      'lengthChange': true,
      'searching': true,
      'ordering': false,
      'info': true,
      'autoWidth': true
    });




    $(document).on('click', 'button[data-role=confirm_delete]', function(event) {
      event.preventDefault();

      var user_id = ($(this).data('id'));

      $('#user_id').val(user_id);
      $('#delete_PUMl').modal('toggle');

    });
  </script>
</body>

</html>