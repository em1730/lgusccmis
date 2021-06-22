<?php


session_start();

$get_objid = $get_code = $get_supplierName = $get_owner = $get_product = $get_address = $get_contact = $get_conPerson = $get_telNo = $get_faxNo = $get_others = '';
$btnNew = 'disabled';
$btnStatus = '';

if (!isset($_SESSION['id'])) {
  header('location:../index');
}
$user_id = $_SESSION['id'];

include('../config/db_config.php');
include('update_for_supplier.php');

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

$get_all_department_sql = "SELECT * FROM tbl_department";
$get_all_department_data = $con->prepare($get_all_department_sql);
$get_all_department_data->execute();

// $get_all_status_sql = "SELECT * FROM tbl_status";
// $get_all_status_data = $con->prepare($get_all_status_sql);
// $get_all_status_data->execute(); 


if (isset($_GET['id'])) {
  $get_objid = $_GET['id'];

  $get_supplier_sql = "SELECT * FROM tbl_suppliers WHERE objid = :id";
  $supplier_data = $con->prepare($get_supplier_sql);
  $supplier_data->execute([':id' => $get_objid]);
  while ($result = $supplier_data->fetch(PDO::FETCH_ASSOC)) {
    $get_objid        = $result['objid']; 
    $get_code         = $result['code']; 
    $get_supplierName = $result['name_supplier'];
    $get_owner        = $result['owner'];
    $get_product      = $result['product_lines']; 
    $get_address      = $result['address'];  
    $get_contact      = $result['contact_no'];
    $get_conPerson    = $result['contact_person'];
    $get_telNo        = $result['tel_no'];
    $get_faxNo        = $result['fax_no'];
    $get_others       = $result['others'];

  }
}


$title = 'LGUSCC | Supplier';

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

      <section class="content">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Update Supplier</h3>
          </div>

          <div class="card-body">
            <form role="form" method="post" action="<?php htmlspecialchars("PHP_SELF"); ?>">
              <div class="box-body">
                <?php echo $alert_msg; ?>

                <div class="row">
                  <div class="col-md-10">
                    <input type="hidden" class="form-control" name="sup_objid" placeholder="Employee Number" value="<?php echo $get_objid; ?>" required>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Supplier Code:</label>
                  </div>
                  <div class="col-md-10">
                    <input type="text" class="form-control" name="sup_code" placeholder="Supplier Code" value="<?php echo $get_code; ?>" required>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Supplier Name:</label>
                  </div>
                  <div class="col-md-10">
                    <input type="text" class="form-control" name="sup_name" placeholder="Suppplier Name" value="<?php echo $get_supplierName; ?>" required>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Owner:</label>
                  </div>
                  <div class="col-md-10">
                    <input type="text" class="form-control" name="sup_owner" placeholder="Owner" value="<?php echo $get_owner; ?>">
                  </div>
                </div><br>

              <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Product Lines:</label>
                  </div>
                  <div class="col-md-10">
                      <textarea rows="5" class="form-control" name="sup_product" placeholder="Product Lines"  required><?php echo $get_product; ?></textarea>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Address:</label>
                  </div>
                  <div class="col-md-10">
                      <textarea rows="2" class="form-control" name="sup_address" placeholder="Business Address"  required><?php echo $get_address; ?></textarea>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Contact Number:</label>
                  </div>
                  <div class="col-md-10">
                    <input type="text" class="form-control" name="sup_contact" placeholder="Contact Number of Supplier" value="<?php echo $get_contact; ?>">
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Contact Person:</label>
                  </div>
                  <div class="col-md-10">
                    <input type="text" class="form-control" name="sup_conPerson" placeholder="Authorized Representative" value="<?php echo $get_conPerson; ?>">
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Telephone Number:</label>
                  </div>
                  <div class="col-md-10">
                    <input type="text" class="form-control" name="sup_telNo" placeholder="Telephone Number" value="<?php echo $get_telNo; ?>">
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Fax Number:</label>
                  </div>
                  <div class="col-md-10">
                    <input type="text" class="form-control" name="sup_faxNo" placeholder="Fax Number" value="<?php echo $get_faxNo; ?>">
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Others:</label>
                  </div>
                  <div class="col-md-10">
                      <textarea rows="5" class="form-control" name="sup_others" placeholder="Other Information"  required><?php echo $get_others; ?></textarea>
                  </div>
                </div><br>



                <!-- /.box-body -->
                <div class="box-footer" align="center">
                  <!-- <input type="submit" <?php echo $btnNew; ?> name="add" class="btn btn-primary" value="New"> -->
                  <input type="submit" <?php echo $btnStatus; ?> name="update_supplier" class="btn btn-success" value="Update">
                  <a href="list_suppliers.php">
                    <input type="button" name="cancel" class="btn btn-danger" value="Cancel">
                  </a>
                </div>
            </form>
          </div>
          <!-- /.box -->
        </div>



      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <?php include('footer.php') ?>


    <!-- /.control-sidebar -->
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
    $(function() {
      //Initialize Select2 Elements
      $('.select2').select2()

      //Datemask dd/mm/yyyy
      $('#datemask').inputmask('dd/mm/yyyy', {
        'placeholder': 'dd/mm/yyyy'
      })
      //Datemask2 mm/dd/yyyy
      $('#datemask2').inputmask('mm/dd/yyyy', {
        'placeholder': 'mm/dd/yyyy'
      })
      //Money Euro
      $('[data-mask]').inputmask()

      //Date range picker
      $('#reservation').daterangepicker()
      //Date range picker with time picker
      $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        format: 'MM/DD/YYYY h:mm A'
      })
      //Date range as a button
      $('#daterange-btn').daterangepicker({
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function(start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        }
      )

      //Date picker
      $('#datepicker').datepicker({
        autoclose: true
      })

      //iCheck for checkbox and radio inputs
      $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
      })
      //Red color scheme for iCheck
      $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
        checkboxClass: 'icheckbox_minimal-red',
        radioClass: 'iradio_minimal-red'
      })
      //Flat red color scheme for iCheck
      $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
      })

      //Colorpicker
      $('.my-colorpicker1').colorpicker()
      //color picker with addon
      $('.my-colorpicker2').colorpicker()

      //Timepicker
      $('.timepicker').timepicker({
        showInputs: false
      })
    })
  </script>






</body>

</html>