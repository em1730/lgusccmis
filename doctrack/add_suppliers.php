<?php


session_start();

$objid = $code = $name_supplier = $owner  = $address = $contact_no = $contact_person= $fax_no =$telephone_no = $others = $product_lines= '';
$btnNew = 'disabled';
$btnStatus = '';

if (!isset($_SESSION['id'])) {
    header('location:../index');
}
$user_id = $_SESSION['id'];

include ('../config/db_config.php');
include ('insert_suppliers.php');



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

    $title = "LGUSCC | Add Supplier";

}


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
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div class="content-header"></div>
  

    <!-- Main content -->
    <section class="content">
    <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Add Supplier</h3>
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
                      <input type="text" class="form-control" name="code" placeholder="Supplier Code" value="<?php echo $code; ?>" required>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Name of Supplier:</label>
                  </div>
                  <div class="col-md-10">
                      <input type="text" class="form-control" name="name_supplier" placeholder="Name of Supplier" value="<?php echo $name_supplier; ?>" required>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Proprietor/Owner</label>
                  </div>
                  <div class="col-md-10">
                      <input type="text" class="form-control" name="owner" placeholder="Proprietor/Owner" value="<?php echo $owner; ?>" required>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Product Line:</label>
                  </div>
                  <div class="col-md-10">
                      <textarea rows="5" class="form-control" name="product_line" placeholder="Product Line"  required><?php echo $product_lines; ?></textarea>
                  </div>
                </div><br>


                
                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Address:</label>
                  </div>
                  <div class="col-md-10">
                      <textarea rows="2" class="form-control" name="address" placeholder="Business Address"  required><?php echo $address; ?></textarea>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Authorized Representative:</label>
                  </div>
                  <div class="col-md-10">
                      <input type="text" class="form-control" name="contact_person" placeholder="Authorized Representative" value="<?php echo $contact_person; ?>" required>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Mobile No.:</label>
                  </div>


                  <div class="col-md-10">
                      <input type="text" class="form-control" name="contact_no" placeholder="Mobile Number" value="<?php echo $contact_no; ?>" required>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Telephone No.:</label>
                  </div>
                  <div class="col-md-10">
                      <input type="text" class="form-control" name="telephone_no" placeholder="Telephone Number" value="<?php echo $telephone_no; ?>" required>
                  </div>
                </div><br>
              


                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Fax No.:</label>
                  </div>


                  <div class="col-md-10">
                      <input type="text" class="form-control" name="fax_no" placeholder="Fax No." value="<?php echo $fax_no; ?>" required>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Others:</label>
                  </div>
                  <div class="col-md-10">
                      <textarea rows="5" class="form-control" name="others" placeholder="Others"  required><?php echo $others; ?></textarea>
                  </div>
                </div><br>

        
             
              <!-- /.box-body -->
              <div class="box-footer" align="center">
              <input type="submit"  <?php echo $btnNew; ?> name="add" class="btn btn-primary" value="New">
                <input type="submit"  <?php echo $btnStatus; ?> name="insert_suppliers" class="btn btn-primary" value="Save">
               
                <a href="list_suppliers.php">
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

  <!-- footer here -->
    <?php include('footer.php');?>
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
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'autoHeight'  : true
    })
  </script>

<script type="text/javascript">

  $(document).ready(function() {

    $(document).ajaxStart(function () {
      Pace.restart()
    })  

  });


</script>


</body>
</html>