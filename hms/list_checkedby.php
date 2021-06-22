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
$get_all_sql = "SELECT * FROM tbl_checkedby where status = 'Active' ORDER BY idno DESC ";
$get_all_data = $con->prepare($get_all_sql);
$get_all_data->execute();

$get_all_position_sql = "SELECT * FROM tbl_position";
$get_all_position_data = $con->prepare($get_all_position_sql);
$get_all_position_data->execute();

$alert_msg = $btnEdit = $btnSave = $add_check_firstname =
  $add_check_middlename = $add_check_lastname = $add_check_position = ' ';

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HM SYSTEM | List of Checked by</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
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
        <div class="card card-dark">
          <div class="card-header">
            <h4>List of Checked by

              <button type="button" style="float:right;" class="btn btn-dark bg-gradient-dark" data-toggle="modal" data-target="#AddModal">
                <i class="nav-icon fa fa-plus-square"></i>
              </button>
            </h4>

          </div>

          <div class="card-body">
            <div class="box box-primary">
              <form role="form" method="get" action="">
                <div class="box-body">
                  <table id="users" class="table table-bordered table-striped">
                    <thead align="center">
                      <tr>
                        <th>ID No.</th>
                        <th>Full Name</th>
                        <th>Position</th>
                        <th>Options</th>
                      </tr>
                    </thead>
                    <tbody align="center">
                      <?php while ($checkedby_data = $get_all_data->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                          <!-- <td><input type="checkbox" value ="" name="" /> -->

                          <td><?php echo $checkedby_data['idno']; ?></td>
                          <td><?php echo $checkedby_data['firstname'];
                              echo " ";
                              echo $checkedby_data['middlename'];
                              echo " ";
                              echo $checkedby_data['lastname']; ?></td>
                          <td><?php echo $checkedby_data['position']; ?></td>

                          <td>
                            <a class="btn btn-dark btn-sm" href="view_checkedby.php?objid=<?php echo $checkedby_data['objid']; ?>&id=<?php echo $checkedby_data['idno']; ?> ">
                              <i class="fa fa-eye"></i>
                            </a>
                            <!-- 
                            <button class="btn btn-danger btn-sm" data-role="confirm_delete" data-id="<?php echo $checkedby_data["idno"]; ?>"><i class="fa fa-trash-o"></i>
                            </button> -->
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






  <div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header  bg-dark">
          <h5 class="modal-title" id="exampleModalLabel "> Add Checked By</h5>
          <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> -->
        </div>

        <form method="POST" action="">
          <div class="modal-body">

            <?php echo $alert_msg; ?>
            <div class=" form-group">
              <label for="recipient-name" class="col-form-label">First Name:</label>
              <input type="text" class="form-control " name="firstName" value="<?php echo $add_check_firstname; ?>" required>
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Middle Name:</label>
              <input type="text" class="form-control " name="middleName" value="<?php echo $add_check_middlename; ?>" required>
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Last Name:</label>
              <input type="text" class="form-control " name="lastName" value="<?php echo $add_check_lastname; ?>" required>
            </div>
            <div class=" form-group">
              <label for="recipient-name" class="col-form-label">Position:</label>
              <select class="form-control select2" id="positions" style="width: 100%;" name="positions" value="<?php echo $add_check_position; ?>">
                <option selected="selected">Please select...</option>
                <?php while ($get_position = $get_all_position_data->fetch(PDO::FETCH_ASSOC)) { ?>
                  <option value="<?php echo $get_position['positions']; ?>"><?php echo $get_position['positions']; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="modal-footer">
              <button type="submit" name="add_checkedby" id="btnSave" class="btn btn-success">
                <i class="fa fa-check fa-fw"> </i> </button>
              <button type="button" name="cancel" class="btn btn-danger" data-dismiss="modal">
                <i class="fa fa-close fa-fw"> </i> </button>
            </div>

          </div>
        </form>

      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Morris.js charts -->
  <script src="../plugins/morris/morris.min.js"></script>
  <!-- Sparkline -->
  <script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
  <!-- jvectormap -->
  <script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="../plugins/knob/jquery.knob.js"></script>
  <!-- daterangepicker -->
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
    $('.select2').select2();
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