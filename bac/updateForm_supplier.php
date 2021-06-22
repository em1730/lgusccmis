<?php


session_start();

$objid = $code = $name_supplier = $owner  = $address = $contact_no = $contact_person= $fax_no = $others = $product_lines= '';
$btnNew = 'disabled';
$btnStatus = '';

if (!isset($_SESSION['id'])) {
    header('location:../index');
}
$user_id = $_SESSION['id'];
include ('../../config/db_config.php');
include ('update_supplier.php');

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

$get_contact_no = $get_name_supplier = $get_owner = $get_product_lines = $get_address =
$get_contact_person = $get_fax_no = $get_others = $get_code = $btnEdit = $get_status = $get_idno =' ';

if (isset($_GET['objid'])) {
  $user_id = $_GET['id'];

  $get_supplier_sql = "SELECT * FROM tbl_suppliers WHERE idno = :id";
  $get_supplier_data = $con->prepare($get_supplier_sql);
  $get_supplier_data->execute([':id' => $user_id]);
  while ($result = $get_supplier_data->fetch(PDO::FETCH_ASSOC)) {
    $get_idno = $result['idno'];
    $get_code = $result['code'];
    $get_name_supplier = $result['name_supplier'];
    $get_owner = $result['owner'];
    $get_product_lines = $result['product_lines'];
    $get_address = $result['address'];
    $get_contact_no = $result['contact_no'];
    $get_contact_person = $result['contact_person'];
    $get_fax_no = $result['fax_no'];
    $get_others = $result['others'];
    $get_status= $result['status'];

  }

}

$get_all_status_sql = "SELECT * FROM tbl_status";
$get_all_status_data = $con->prepare($get_all_status_sql);
$get_all_status_data->execute(); 





?>
<!DOCTYPE html>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BAC  | Update Supplier</title>
   <!-- Tell the browser to be responsive to screen width -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="../dist/css/ionicons.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
  <!-- Morris chart
  <link rel="stylesheet" href="../plugins/morris/morris.css">
  jvectormap -->
  <!-- <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css"> -->
  <!-- Date Picker -->
  <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
  <!-- Daterange picker
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css"> -->
  <!-- bootstrap wysihtml5 - text editor -->
  <!-- <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"> -->
  <!-- Google Font: Source Sans Pro -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
   <!-- DataTables -->
   <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap4.css">
     <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/select2.min.css">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
  

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="../dist/img/scclogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: ">
      <span class="brand-text font-weight-light">BAC | SYSTEM</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="profile.php" class="d-block"><?php echo $db_first_name . " " . $db_middle_name . " " . $db_last_name ?>  </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         
        </ul>
          
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


  <!-- Content Wrapper. Contains page content -->
 

 <div class="content-wrapper">


 <div class="content-header">

 </div>



<section class="content">
    <div class="card">
            <div class="card-header">
              <h3 class="card-title">Update Supplier</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
          
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="<?php htmlspecialchars("PHP_SELF"); ?>">
              <div class="box-body">
                <?php echo $alert_msg; ?>
                
                <div class="row" hidden>
                  <div class="col-md-2"  style="text-align: right;padding-top: 5px;">
                   <label>ID No.:</label>
                  </div>
                  <div class="col-md-10">
                      <input type="text"  readonly onkeyup="this.value = this.value.toUpperCase();" class="form-control" id="idno" name="idno" placeholder="ID Number" value="<?php echo
$get_idno; ?>" required>
                  </div>
                </div><br>
                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Code:</label>
                  </div>
                  <div class="col-md-10">
                      <input type="text" readonly onkeyup="this.value = this.value.toUpperCase();" class="form-control" id="code" name="code" placeholder="Supplier Code" value="<?php echo
$get_code; ?>" required>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Name of Supplier:</label>
                  </div>
                  <div class="col-md-10">
                      <input type="text" readonly  onkeyup="this.value = this.value.toUpperCase();" class="form-control" id="supplier" name="supplier" placeholder="Name of Supplier" value="<?php echo
$get_name_supplier; ?>" required>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Propritor/Owner</label>
                  </div>
                  <div class="col-md-10">
                      <input type="text"  readonly onkeyup="this.value = this.value.toUpperCase();" class="form-control" id="owner" name="owner" placeholder="Propritor/Owner" value="<?php echo
$get_owner; ?>" required>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Product_lines</label>
                  </div>
                  <div class="col-md-10">
                      <input type="text" readonly onkeyup="this.value = this.value.toUpperCase();" class="form-control" id="product_lines" name="product_lines" placeholder="Product Lines" value="<?php echo
$get_product_lines; ?>" required>
                  </div>
                </div><br>

                
                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Address:</label>
                  </div>
                  <div class="col-md-10">
                      <textarea rows="2" readonly onkeyup="this.value = this.value.toUpperCase();" class="form-control" id="address" name="address" placeholder="Business Address"  required><?php echo
$get_address; ?></textarea>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Contact No.:</label>
                  </div>


                  <div class="col-md-10">
                      <input type="text"  readonly onkeyup="this.value = this.value.toUpperCase();" class="form-control" id="contact_no" name="contact_no" placeholder="Contact Number" value="<?php echo
$get_contact_no; ?>" required>
                  </div>
                </div><br>


                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Contact Person:</label>
                  </div>


                  <div class="col-md-10">
                      <input type="text"  readonly onkeyup="this.value = this.value.toUpperCase();" class="form-control" id="contact_person" name="contact_person" placeholder="Contact Person" value="<?php echo
$get_contact_person; ?>" required>
                  </div>
                </div><br>


                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Fax No.:</label>
                  </div>


                  <div class="col-md-10">
                      <input type="text" readonly onkeyup="this.value = this.value.toUpperCase();" class="form-control" id="fax_no" name="fax_no" placeholder="Fax No." value="<?php echo
$get_fax_no; ?>" required>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Others:</label>
                  </div>
                  <div class="col-md-10">
                      <textarea rows="2" readonly onkeyup="this.value = this.value.toUpperCase();" class="form-control"  id="others" name="others" placeholder="Others"  required><?php echo
$get_others; ?></textarea>
                  </div>
                </div><br>
                <div class="row">
                   <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                      <!-- <div class="form-group"> -->
                    <label>Status:</label>
                   </div>
                <div class="col-md-10">
                    <select class="form-control select2" readonly style="width: 30%;" id="status" name="status" value="<?php echo $type; ?>">
                       <!-- <option>Please select...</option>
                    <?php while ($get_status_data = $get_all_status_data->fetch(PDO::FETCH_ASSOC)) { ?> -->
                <?php
                    //if $get_author naa value, check nato if equals sa $get_author1['fullname']
                    //if equals, put 'selected' sa option
                    $selected = ($get_status == $get_status_data['status'])? 'selected':'';

                ?>
                <option <?=$selected;?> value="<?php echo $get_status_data['status']; ?>"><?php echo $get_status_data['status']; ?></option>
                  <?php } ?>
                 </select>
                </div>
                </div><br>

        
             
              <!-- /.box-body -->
              <div class="box-footer" align="center">
                <input type="button"  <?php echo $btnEdit; ?> name = "edit" id="edit_supplier" class="btn btn-primary" value="Edit">
                <input type="submit"  <?php echo $btnStatus; ?> name="update_supplier" id="btnSubmit" class="btn btn-primary" value="Update">
               
                <a href="list_supplier">
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






 </div>
  <!-- /.content-wrapper -->

  <!-- footer here -->
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
      </div>
      <strong>Copyright &copy; <?php echo 2019; ?>.</strong> All rights
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

<script>

$("#btnSubmit").attr("disabled", true);


</script>

<script>
    $(document).ready(function()
    {
    $('#edit_supplier').click(function()
    {
      
      $("input[name='supplier']").removeAttr("readonly");
      $("input[name='owner']").removeAttr("readonly");
      $("input[name='product_lines']").removeAttr("readonly");
      $("textarea[name='address']").removeAttr("readonly");
      $("input[name='contact_no']").removeAttr("readonly");
      $("input[name='contact_person']").removeAttr("readonly");
      $("select[name='status']").removeAttr("readonly");
      $("input[name='fax_no']").removeAttr("readonly");
      $("textarea[name='others']").removeAttr("readonly");
      
      


      $("#btnSubmit").attr("disabled", false);
      $("#edit_supplier").attr("disabled", true);





    });

    });


</script>

</body>
</html>