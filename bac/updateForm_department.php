<?php


session_start();

$code = $dept =  $status  =  $btnNew ='';
// $btnNew = 'disabled';
$btnSave = '';

if (!isset($_SESSION['id'])) {
    header('location:../index');
}
$user_id = $_SESSION['id'];

include ('../config/db_config.php');
include ('update_department.php');

//select user
$get_user_sql = "SELECT * FROM tbl_users WHERE user_id = :id";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {
    $db_first_name = $result['first_name'];
    $db_middle_name = $result['middle_name'];
    $db_last_name = $result['last_name'];

}
$get_code = $get_dept =$get_status = '';



if (isset($_GET['objid'])) {
  
  $user_id = $_GET['id'];

  $get_items_sql = "SELECT * FROM tbl_department WHERE idno = :id";
  $get_items_data = $con->prepare($get_items_sql);
  $get_items_data->execute([':id' => $user_id]);
  while ($result = $get_items_data->fetch(PDO::FETCH_ASSOC)) {
    
    $get_code = $result['objid'];
  
    $get_dept = $result['department'];

    $get_status = $result['status'];
    $get_idno = $result['idno'];
    
     
    
   

  }

}
$get_all_status_sql = "SELECT * FROM tbl_status";
$get_all_status_data = $con->prepare($get_all_status_sql);
$get_all_status_data->execute(); 


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BAC | Update Department</title>
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
      
      
    </ul>

    <!-- SEARCH FORM -->
   

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <div class = "pull-right">
        
      </div>
    
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="../dist/img/scclogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: ">
      <span class="brand-text font-weight-light">ITCSO | HMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="profile.php" class="d-block"><?php echo $db_first_name . " " . $db_middle_name . " " . $db_last_name ?> </a>
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
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
         
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
    <div class="card">
        <div class="card-header">
        <h3 class="card-title">Update Department</h3>
        </div>
            <!-- /.card-header -->
      <div class="card-body">
            <form role="form" method="post" action="<?php htmlspecialchars("PHP_SELF"); ?>">
              <div class ="box-body">
              <?php echo $alert_msg; ?>

              <div class="row" hidden>
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>ID No.:</label>
                  </div>
                  <div class="col-md-10">
                      <input type="text"  readonly onkeyup="this.value = this.value.toUpperCase();" class="form-control" name="idno" placeholder="ID No" value="<?php echo $get_idno; ?>" required>
                  </div>
              </div><br>


              <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Code:</label>
                  </div>
                  <div class="col-md-10">
                      <input type="text"  readonly onkeyup="this.value = this.value.toUpperCase();" id="code"  class="form-control" name="code" placeholder="Code" value="<?php echo $get_code; ?>" required>
                  </div>
              </div><br>
              <div class="row"> 
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Department:</label>
                  </div>
                  <div class="col-md-10">
                      <input type="text" readonly onkeyup="this.value = this.value.toUpperCase();" id="deparment" class="form-control" name="department" placeholder="Department" value="<?php echo $get_dept; ?>" required>
                  </div>
              </div><br>
           


              <div class="row">
                   <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                      <!-- <div class="form-group"> -->
                    <label>Status:</label>
                   </div>
                <div class="col-md-10">
                    <select class="form-control select2" readonly id="status" style="width: 100%;" name="status" value="<?php echo $type; ?>">
                       <option>Please select...</option>
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




              <div class="box-footer" align="center">
            <input type="submit"  <?php echo $btnNew; ?> id="btnEdit"class="btn btn-primary" value="Edit">
          
            <input type="submit" <?php echo $btnSave; ?> id = "btnSubmit" name="update_department" class="btn btn-primary" value="Update">       
        
              <a href="list_department">
                 <input type="button" name="close" class="btn btn-default" value="close">       
              </a>
              </div>


              </div>
            </form>
      </div>
          <!-- /.box -->
      </div>
    </section>
    </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2019 ITCSO <a href="http://lguscc.gov.ph">Local Government of San Carlos City</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 2.0.0-alpha
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
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
    $('#btnEdit').click(function()
    {
      $("input[name='code']").removeAttr("readonly");
      // $("select[name='itemunit']").removeAttr("readonly");
      $("input[name='department']").removeAttr("readonly");
      // $("input[name='quantity']").removeAttr("readonly");
      // $("input[name='price']").removeAttr("readonly");  
      // $("textarea[name='description']").removeAttr("readonly"); 
      $("select[name='status']").removeAttr("readonly");
      


      $("#btnSubmit").attr("disabled", false);
      $("#btnEdit").attr("disabled", true);





    });

    });


</script>


</body>
</html>