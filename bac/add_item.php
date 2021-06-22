<?php


session_start();

$db_first_name = $db_last_name = $type = $db_middle_name =
$itemcode = $itemname = $category = $itemunit = $status =
$quantity = $price =
$btnSave = $btnNew = $description ='';
$btnNew = 'disabled';

if (!isset($_SESSION['id'])) {
    header('location:../index');
}

$user_id = $_SESSION['id'];

include ('../config/db_config.php');
include ('insert_item.php');

$db_first_name = $db_last_name = $db_middle_name = '';
//select user
$get_user_sql = "SELECT * FROM tbl_users where user_id = :id";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {

    $db_first_name = $result['first_name'];
    $db_middle_name = $result['middle_name'];
    $db_last_name = $result['last_name'];

}

$get_all_status_sql = "SELECT * FROM tbl_status";
$get_all_status_data = $con->prepare($get_all_status_sql);
$get_all_status_data->execute(); 

$get_all_category_sql = "SELECT * FROM tbl_itemcategory where status = 'Active' ";
$get_all_category_data = $con->prepare($get_all_category_sql);
$get_all_category_data->execute(); 


$get_all_unit_sql = "SELECT * FROM tbl_itemunit where status = 'Active' ";
$get_all_unit_data = $con->prepare($get_all_unit_sql);
$get_all_unit_data->execute(); 




?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BAC SYSTEM | Add Item</title>
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

<?php include('sidebar.php')?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      
      </div>

    <!-- Main content -->
    <section class="content">
    <div class="card">
            <div class="card-header">
              <h3 class="card-title">Add Item</h3>
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
                   <label>Item Code.:</label>
                  </div>
                  <div class="col-md-10">
                      <input type="text" readonly onkeyup="this.value = this.value.toUpperCase();" class="form-control" id="code" name="code"  placeholder="Item Code " value="<?php echo $itemcode; ?>" required>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Item Name:</label>
                  </div>
                  <div class="col-md-10">
                      <input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" name="itemname" placeholder="Item Name" value="<?php echo $itemname; ?>" required>
                  </div>
                </div><br>



                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <!-- <div class="form-group"> -->
                    <label>Item Unit:</label>
                  </div>
                                                                                     
                   <div class="col-md-10">
                    <select class="form-control select2" id="unit" style="width: 100%;" name="itemunit" value="<?php echo $type; ?>">
                      <option selected="selected">Please select...</option>
                        <?php while ($get_unit = $get_all_unit_data->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $get_unit['code']; ?>"><?php echo $get_unit['itemunit']; ?></option>
                        <?php } ?>
                     </select>
                   </div>
                </div><br>

              
                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <!-- <div class="form-group"> -->
                    <label>Item Category:</label>
                  </div>
                                                                                     
                   <div class="col-md-10">
                    <select class="form-control select2" id="select_type" style="width: 100%;" name="category" value="<?php echo $type; ?>">
                      <option selected="selected">Please select...</option>
                        <?php while ($get_type = $get_all_category_data->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $get_type['code']; ?>"><?php echo $get_type['itemcategory']; ?></option>
                        <?php } ?>
                     </select>
                   </div>
                </div><br>

      


                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Description:</label>
                  </div>
                  <div class="col-md-10">
                  <textarea rows="5" onkeyup="this.value = this.value.toUpperCase();" class="form-control" name="description" placeholder="Item Description" required><?php echo $description; ?></textarea>
                  </div>
                </div><br>
                
                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Price:</label>
                  </div>
                  <div class="col-md-10">
                   <input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" name="price" placeholder="Price" value="<?php echo $price; ?>" required>
                  </div>
                </div><br>

                
                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <!-- <div class="form-group"> -->
                  <label>Status:</label>
                  </div>
                  <div class="col-md-10">
                    <select class="form-control select2" id="status" style="width: 100%;" name="status" value="<?php echo $status; ?>">
                      <option selected="selected">Please select...</option>
                      <?php while ($get_status =$get_all_status_data->fetch(PDO::FETCH_ASSOC)) { ?>
                      <option value="<?php echo $get_status['status']; ?>"><?php echo $get_status['status']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div><br>

              <!-- /.box-body -->
              <div class="box-footer" align="center">
              <input type="submit"  <?php echo $btnNew; ?> name="add" class="btn btn-primary" value="New">
                <input type="submit"  <?php echo $btnSave; ?> name="insert_item" class="btn btn-primary" value="Save">
                <a href="index">
                  <input type="button" name="cancel" class="btn btn-default" value="Cancel">       
                </a>
              </div>
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

  $(category).ready(function() {

    $(category).ajaxStart(function () {
      Pace.restart()
    })  

  });


</script>
        <script type="text/javascript">

        $(category).ready(function() {
            $(category).ajaxStart(function() {
                Pace.restart()
            })



        });


        } 
            
        });       

    </script> 


<script>


        $('#select_type').on('change',function(){
        var category = $(this).val();
        
        //  $('#doc_no').val(type);


          $.ajax({
          type:'POST',
          data:{category:category},
          url:'generate_serial.php',
          success:function(data){
        $('#code').val(data);


          } 
            
            });           
                    
          });


</script>


</body>
</html>