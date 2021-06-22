<?php

session_start();


if (!isset($_SESSION['id'])) {
  header('location:../index.php');
}

$user_id = $_SESSION['id'];

include('../config/db_config.php');
include('delete.php');


$get_user_sql = "SELECT * FROM tbl_users WHERE user_id = :id";
$get_user_data = $con->prepare($get_user_sql);
$get_user_data->execute([':id' => $user_id]);
while ($result = $get_user_data->fetch(PDO::FETCH_ASSOC)) {

  $user_name = $result['username'];
  $GLOBALS['department'] = $result['department'];
  $db_first_name = $result['first_name'];
  $db_middle_name = $result['middle_name'];
  $db_last_name = $result['last_name'];
  $db_email_ad = $result['email'];
  $db_contact_number = $result['contact_no'];
  $db_user_name = $result['username'];
}


// //select all outgoing documents
$get_all_document_sql = "SELECT * FROM tbl_documents where destination = '$department' and status in ('CREATED','FORWARDED')";
$get_all_document_data = $con->prepare($get_all_document_sql);
$get_all_document_data->execute();

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

//select all employees
$get_all_employee_sql = "SELECT EmployeeNo, CONCAT(LastName, ', ', FirstName,' ', MiddleName) as FULLNAME,EmploymentType, DesignationCode, DepartmentCode, Status FROM tbl_employee  order by lastname LIMIT 500";
$get_all_employee_data = $con->prepare($get_all_employee_sql);
$get_all_employee_data->execute();


// count new messages
$get_all_message_sql = "SELECT count(*) as total FROM tbl_message where receiver = $user_id and status = 'PENDING'";
$get_all_message_data = $con->prepare($get_all_message_sql);
$get_all_message_data->execute();
while ($result1 = $get_all_message_data->fetch(PDO::FETCH_ASSOC)) {
  $message_count =  $result1['total'];
}

// //select all messages for notification
$get_all_messages_sql = "SELECT * FROM tbl_message where (receiver = $user_id or receiver = '0') and status = 'PENDING' ";
$get_all_messages_data = $con->prepare($get_all_messages_sql);
$get_all_messages_data->execute();

// //select all messages for email
$get_all_messages1_sql = "SELECT * FROM tbl_message where receiver = $user_id or receiver ='0'";
$get_all_messages1_data = $con->prepare($get_all_messages1_sql);
$get_all_messages1_data->execute();

$title = 'LGUSCC | List of Regular Employees';



?>




<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?></title>

  <?php include('head.php') ?>

</head>




<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php include('sidebar.php'); ?>
    <div class="content-wrapper">
      <section class="content">
        <?php include('dashboard.php'); ?>
        <div class="card card-info">
          <div class="card-header">
            <h4> List of Employees

              <a href="add_employee.php" id="add_employee" style="float:right;" type="button" class="btn btn-info bg-gradient-info" style="border-radius: 0px;">
                <i class="nav-icon fa fa-plus-square"></i></a>
              <!-- <a href="../cameracapture/capture.php" style="float:right;" type="button" class="btn btn-info bg-gradient-info" style="border-radius: 0px;">
                <i class="nav-icon fa fa-plus-square"></i></a> -->
            </h4>

          </div>
          <form role="form" method="get" action="<?php htmlspecialchars("PHP_SELF"); ?>">
          <div class="box-body">
            <table id="users" class="table table-bordered table-striped">
                <thead>
                  <tr>
                  <th>Employee Number</th>
                  <th>Fullname</th>
                  <th>Employment Type</th>
                  <th>Designation</th>
                  <th>Department/ Office</th>
                  <th>Status</th>
                  <th>Options</th>
                  </tr>
                </thead>
                <tbody>
                <?php while($employee_data = $get_all_employee_data->fetch(PDO::FETCH_ASSOC)){?>
                  <tr>
                  <td><?php echo $employee_data['EmployeeNo'] ?></td>
                  <td><?php echo $employee_data['FULLNAME'] ?></td>
                  <td><?php echo $employee_data['EmploymentType'] ?></td>
                  <td><?php echo $employee_data['DesignationCode'] ?></td>
                  <td><?php echo $employee_data['DepartmentCode'] ?></td>
                  <td><?php echo $employee_data['Status'] ?></td>
                  <td>
                        <a class="btn btn-outline-success btn-xs" href="view_employee.php?id=<?php echo
                                                                                                  $employee_data['EmployeeNo']; ?>"><i class="fa fa-check-square-o"></i>
                        </a>
                        <a class="btn btn-outline-success btn-xs" href="view_pdf.php?orno=<?php echo
                                                                                          $employee_data['objid']; ?>"><i class="fa fa-search"></i>
                        </a>

                        <button class="btn btn-outline-danger btn-xs" data-role="confirm_delete" data-id="<?php 
                        // echo $user_data["user_id"]; ?>"><i class="fa fa-trash-o"></i></button>
                      </td>
                  </tr>
                <?php }?>

              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
</form>
        </div>




      </section>


      <!-- Main content -->

      <!-- /.box -->
    </div>
  </div>
  <!-- /.content -->


  <!-- modals here -->
  <!-- modal here delete -->
  <div class="modal fade" id="deleteuser_Modal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Confirm Delete</h4>
        </div>
        <form method="POST" action="<?php htmlspecialchars("PHP_SELF") ?>">
          <div class="modal-body">
            <div class="box-body">
              <div class="form-group">
                <label>Delete Record?</label>
                <input type="text" name="user_id" id="user_id" class="form-control">
              </div>
            </div>
          </div>
          <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left bg-olive" data-dismiss="modal">No</button>
            <!-- <button type="submit" name="delete_user" class="btn btn-danger">Yes</button> -->
            <input type="submit" name="delete_user" class="btn btn-danger" value="Yes">
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->


  </div>
  <!-- /.content-wrapper -->

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
  <!-- <script src="../dist/js/demo.js"></script> -->
  <!-- DataTables -->
  <script src="../plugins/datatables/jquery.dataTables.js"></script>
  <script src="../plugins/datatables/dataTables.bootstrap4.js"></script>

  <script>

$('#users').DataTable({
      'paging': true,
      'lengthChange': true,
      'searching': true,
      'ordering': true,
      'info': true,
      'autoWidth': true,
      'autoHeight': true
    });

</script>

  <script>
    // $(document).ready(function() {
    //   var dataTable = $('#users').DataTable({


    //     "processing": true,
    //     "serverSide": true,
    //     "ajax": {
    //       url: "track_joborder.php", // json datasource
    //       type: "post", // method  , by default get
    //       error: function() { // error handling
    //         $("#users-error").html("");
    //         $("#users").append('<tbody class="users-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
    //         $("#users_processing").css("display", "none");

    //       }
    //     },

    //     "columnDefs": [{
    //       "targets": -1,
    //       "data": null,
    //       "defaultContent": '<button class=\"receive btn btn-outline-success btn-xs \" ><i class="fa fa-download" aria-hidden= "true"></i></button>'


    //     }],

    //   });


    //   $('#users tbody').on('click', 'button.edit', function() {
    //     // alert ('hello');
    //     // var row = $(this).closest('tr');
    //     var table = $('#users').DataTable();
    //     var data = table.row($(this).parents('tr')).data();
    //     //  alert (data[0]);
    //     //  var data = $('#users').DataTable().row('.selected').data(); //table.row(row).data().docno;
    //     var objid = data[0];


    //     window.open("update_joborder.php?objid=" + objid, '_parent');

    //   });
    // });

    $(document).on('click', 'button[data-role=confirm_delete]', function(event) {
      event.preventDefault();

      var user_id = ($(this).data('id'));

      $('#user_id').val(user_id);
      $('#deleteuser_Modal').modal('toggle');

    })
  </script>

</body>

</html>