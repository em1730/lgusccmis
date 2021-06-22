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
  $db_first_name = $result['first_name'];
  $db_middle_name = $result['middle_name'];
  $db_last_name = $result['last_name'];
  $db_email_ad = $result['email'];
  $db_contact_number = $result['contact_no'];
  $db_user_name = $result['username'];
}


//select all users
$get_all_users_sql = "SELECT * FROM tbl_users WHERE user_id != :id";
$get_all_users_data = $con->prepare($get_all_users_sql);
$get_all_users_data->execute([':id' => $user_id]);


//select all document
$get_all_document_sql = "SELECT * FROM document_type";
$get_all_document_data = $con->prepare($get_all_document_sql);
$get_all_document_data->execute();

$title = 'LGUSCC | List of Document Type';

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title> <?php echo $title; ?> </title>

  <?php include('head.php'); ?>
</head>


<body class="hold-transition sidebar-mini">
  <div class="wrapper">


    <?php include('sidebar.php') ?>

    <div class="content-wrapper">


      <?php
      // include('dashboard.php')
      ?>

<div class="content-header"></div>
      <section class="content">



        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">List of Documents
              <a href="add_document.php" id="add_document" style="float:right;" type="button" class="btn btn-info bg-gradient-info" style="border-radius: 0px;">
                <i class="nav-icon fa fa-plus-square"></i></a>
            </h3>


          </div>
          
          <form role="form" method="get" action="<?php htmlspecialchars("PHP_SELF"); ?>">
            <div class="box-body">
              <table id="users" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Document Code</th>
                    <!-- <th>Middlename</th>
                      <th>Lastname</th> -->
                    <th>Type</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Options</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($document_data = $get_all_document_data->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                      <td><?php echo ($document_data['objid']) ?></td>
                      <td><?php echo $document_data['type']; ?></td>
                      <td><?php echo $document_data['description']; ?></td>
                      <td><?php echo $document_data['status']; ?></td>
                      <td>
                        <a class="btn btn-outline-success btn-xs" href="view_document.php?id=<?php echo
                                                                                                  $document_data['objid']; ?>"><i class="fa fa-check-square-o"></i>
                        </a>
                        <a class="btn btn-outline-success btn-xs" href="view_pdf.php?orno=<?php echo
                                                                                          $document_data['objid']; ?>"><i class="fa fa-search"></i>
                        </a>

                        <button class="btn btn-outline-danger btn-xs" data-role="confirm_delete" data-id="<?php 
                        // echo $user_data["user_id"]; ?>"><i class="fa fa-trash-o"></i></button>
                      </td>
                    </tr>
           

                    <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </form>
        </div>
        <!-- /.box -->
      </section>
      <br>

    </div>
    <?php include('footer.php'); ?>





  </div>
  <!-- <div class="modal fade" id="deleteuser_Modal" role="dialog" data-backdrop="static" data-keyboard="false">
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
          
            <input type="submit" name="delete_user" class="btn btn-danger" value="Yes">
          </div>
        </form>
      </div>
    
    </div>


  </div> -->





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

  <script>
    $(document).on('click', 'button[data-role=confirm_delete]', function(event) {
      event.preventDefault();

      var user_id = ($(this).data('id'));

      $('#user_id').val(user_id);
      $('#deleteuser_Modal').modal('toggle');

    })
  </script>

</body>

</html>