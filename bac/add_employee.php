<?php


session_start();

$idnumber = $objid = $firstname = $middlename = $lastname = $address = $birthdate =
$position = $department = $contact_no = $status = $datecreated = $department = $section= '';
$btnNew = 'disabled';
$btnStatus = '';

$now = new DateTime();

if (!isset($_SESSION['id'])) {
    header('location:../index');
}
$user_id = $_SESSION['id'];

include ('../config/db_config.php');
include ('insert_employee.php');


//select user
$get_user_sql = "SELECT * FROM tbl_users WHERE user_id = :id";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]); 	
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {
    $db_first_name = $result['first_name'];
    $db_middle_name = $result['middle_name'];
    $db_last_name = $result['last_name'];


}

//select all departments
$get_all_department_sql = "SELECT * FROM tbl_department";
$get_all_department_data = $con->prepare($get_all_department_sql);
$get_all_department_data->execute(); 

$get_all_status_sql = "SELECT * FROM tbl_status";
$get_all_status_data = $con->prepare($get_all_status_sql);
$get_all_status_data->execute(); 

$get_all_position_sql = "SELECT * FROM tbl_position";
$get_all_position_data = $con->prepare($get_all_position_sql);
$get_all_position_data->execute(); 


$get_all_section_sql = "SELECT * FROM tbl_section";
$get_all_section_data = $con->prepare($get_all_section_sql);
$get_all_section_data->execute(); 

?>
<!DOCTYPE html>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BAC | Add Employee</title>
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

  <?php include('sidebar.php');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      
      </div>

    <!-- Main content -->
    <section class="content">
    <div class="card">
            <div class="card-header">
              <h3 class="card-title">Add Employee</h3>
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
                      <label>Date Created:</label>
                  </div>
                  <div class="col-md-2"> 
                                                <!-- Date -->
                  <div class="form-group">
                    <div class="input-group date" data-provide="datepicker" >
                        <div class="input-group-addon">
                           <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker" name="datecreated" placeholder="Date Created" value="<?php echo $now->format('m/d/Y');; ?>">
                    </div>
                  </div>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Emplyee ID No.:</label>
                  </div>
                  <div class="col-md-10">
                      <input type="text" readonly onkeyup="this.value = this.value.toUpperCase();" class="form-control" id="idnumber" name="idnumber" placeholder="ID Number" value="<?php echo $idnumber; ?>" required>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>First Name:</label>
                  </div>
                  <div class="col-md-10">
                      <input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" name="firstname" placeholder="First Name" value="<?php echo $firstname; ?>" required>
                  </div>
                </div><br>

     
                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Middle Name:</label>
                  </div>
                  <div class="col-md-10">
                      <input type="text"  onkeyup="this.value = this.value.toUpperCase();" class="form-control" name="middlename" placeholder="Middle Name" value="<?php echo $middlename; ?>" required>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Last Name:</label>
                  </div>
                  <div class="col-md-10">
                      <input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" name="lastname" placeholder="Last Name" value="<?php echo $lastname; ?>" required>
                  </div>
                </div><br>
   
                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Address:</label>
                  </div>
                  <div class="col-md-10">
                      <textarea rows="2"  onkeyup="this.value = this.value.toUpperCase();" class="form-control" name="address" placeholder="Employee Address"  required><?php echo $address; ?></textarea>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Birth Date:</label>
                  </div>

                  <div class="col-md-10">
                                                <!-- Date -->
                    <div class="form-group">
                      <div class="input-group date" data-provide="datepicker" >
                        <div class="input-group-addon">
                           <i class="fa fa-calendar"></i>
                        </div>
                           <input type="text" class="form-control pull-right" id="datepicker" name="birthdate" placeholder="Birth Date" value="<?php echo $now->format('m/d/Y');; ?>">
                      </div>
                    </div>
                  </div>
                </div><br>


                

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <!-- <div class="form-group"> -->
                    <label>Department:</label>
                  </div>
                  <div class="col-md-10">
                  <select class="form-control select2" id="department" style="width: 100%;" name="department" value="<?php echo $department; ?>">
                    <option selected="selected">Please select...</option>
                    <?php while ($get_department = $get_all_department_data->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $get_department['objid']; ?>"><?php echo $get_department['department']; ?></option>
                    <?php } ?>
                    </select>
                  </div>
                </div><br>


                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <!-- <div class="form-group"> -->
                    <label>Position:</label>
                  </div>
                  <div class="col-md-10">
                  <select class="form-control select2" id="positions" style="width: 100%;" name="positions" value="<?php echo $position; ?>">
                    <option selected="selected">Please select...</option>
                    <?php while ($get_position = $get_all_position_data->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $get_position['position']; ?>"><?php echo $get_position['position']; ?></option>
                    <?php } ?>
                    </select>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <!-- <div class="form-group"> -->
                    <label>Section:</label>
                  </div>
                  <div class="col-md-10">
                  <select class="form-control select2" id="section" style="width: 100%;" name="section" value="<?php echo $section; ?>">
                    <option selected="selected">Please select...</option>
                    <?php while ($get_section = $get_all_section_data->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $get_section['section']; ?>"><?php echo $get_section['section']; ?></option>
                    <?php } ?>
                    </select>
                  </div>
                </div><br>


                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Contact No.:</label>
                  </div>
                  <div class="col-md-10">
                      <input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" name="contact" placeholder="Contact Number" value="<?php echo $contact_no; ?>" required>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
            
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
                <input type="submit"  <?php echo $btnStatus; ?> name="insert_employee" class="btn btn-primary" value="Save">
                <a href="list_employee">
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
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
      </div>
      <strong>Copyright &copy; <?php echo 2018; ?>.</strong> All rights
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


        $('#department').on('change',function(){
        var department = $(this).val();
        
        //  $('#doc_no').val(type);


          $.ajax({
          type:'POST',
          data:{department:department},
          url:'generate_employee.php',
          success:function(data){
        $('#idnumber').val(data);


          } 
            
            });           
                    
          });


</script>
</body>
</html>