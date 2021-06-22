<?php

session_start();

date_default_timezone_set('Asia/Manila');  

$prno = $prdate = $dept = $pr_sai_no = $saidate = $pr_section= $prcontrolno = $reqby = $checkby = $purpose = $notes = '';
$currentDateTime = date('Y-m-d H:m');
// echo $currentDateTime;
$prdate = date('Y-m-d H:i');
$saidate = date('Y-m-d H:i');
$curYear = date('Y');
$reqby = '';
$reqbyposition = '';
$checkby = '';
$checkbyposition = '';



if (!isset($_SESSION['id'])) {
  header('location:../index');
}
$user_id = $_SESSION['id']; 

$alert_msg = '';  
include ('../../config/db_config.php');
include ('addprinfo.php');

//select user


$get_user_sql = "SELECT * FROM tbl_users WHERE user_id = :id";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {
  $first_name     = $result['first_name'];
  $middle_name    = $result['middle_name'];
  $last_name      = $result['last_name'];
  $email_ad       = $result['email'];
  $contact_number = $result['contact_no'];
  $user_name      = $result['username'];
  $department     = $result['department'];
  $userfullname   = $result['first_name']." ".$result['middle_name']." ".$result['last_name'];
  
}

$dept = "$department";

//select all departments
$get_all_department_sql = "SELECT * FROM tbl_department";
$get_all_department_data = $con->prepare($get_all_department_sql);
$get_all_department_data->execute(); 


$get_all_section_sql = "SELECT * FROM tbl_section";
$get_all_section_data = $con->prepare($get_all_section_sql);
$get_all_section_data->execute(); 

?>

<!DOCTYPE html>
<html >
<head>


<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BAC | Add PR</title>

 <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
   <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
    <!-- Date Picker -->
  <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="../plugins/select2/select2.min.css">
    <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap4.css">
     <!-- Select2 -->
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

  <link href="../plugin/bootstrap-dialog.css" rel="stylesheet" type="text/css" />

  <script src="js/bootstrap-dialog.js"></script>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include('sidebar.php');?>



  <!-- Left side column. contains the logo and sidebar -->
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><b>(PR)</b>&nbsp;&nbsp;&nbsp;&nbsp;
        <b>Add Info</b>
        <!-- <small>Version 2.0</small> -->
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="../index"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">


      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="box box-primary">
            <div class="box-header with-border">
              <!-- <h3 class="box-title">Info</h3> -->
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="<?php htmlspecialchars("PHP_SELF");?>">
              <div class="box-body">
                <?php echo $alert_msg; ?>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                      <label>Department</label>
                  </div>
                    <div class="col-md-10">
                      <input type="text" readonly class="form-control" name="dept" placeholder="Department" style='text-transform:uppercase' value="<?php echo $dept; ?>">
                    </div><!-- /.col -->
                </div><br> 

                  
                                        
  

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                      <label>PR No.</label>
                  </div>
                    <div class="col-md-10">
                      <input type="text" class="form-control" name="prno" placeholder="PR No." style='text-transform:uppercase' value="<?php echo $prno; ?>">
                    </div><!-- /.col -->
                </div><br>                    

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                      <label>Date</label>
                  </div>
                    <div class="col-md-10">
                      <input type="text" class="form-control" name="prdate" placeholder="Date" style="width: 27%; text-transform:uppercase" value="<?php echo $prdate; ?>" required>
                    </div><!-- /.form-group
                  </div><!-- /.col -->
                </div><hr style="border-width: 1px 1px 0;
                           border-style: solid;
                           border-color: palevioletred; 
                           width: 100%;
                           margin-left: auto;
                           margin-right: auto;">

                  <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">                      
                          <label>Section</label>
                      </div>
                      <div class="col-md-4 " > 
                          <select class=" form-control select2" id="section" style="width: 100%;" name="section" value="<?php echo $section; ?>">
                          <option selected="selected">Please select...</option>
                          <?php while ($get_section = $get_all_section_data->fetch(PDO::FETCH_ASSOC)) { ?>
                          <option value="<?php echo $get_section['section']; ?>"><?php echo $get_section['section']; ?></option>
                          <?php } ?>
                          </select>
                      </div>
                    </div> <br>                   

                <div class="row"> 
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>SAI No.</label>
                  </div>
                  <div class="col-md-10">
                      <input type="text" class="form-control" name="saino" placeholder="PR SAI No." style='text-transform:uppercase' value="<?php echo $pr_sai_no; ?>" > 
                      <!-- <input type="hidden" class="form-control" name="issuedby" value="<?php echo $db_userfullname; ?>" required>                        -->
                  </div>
                </div><br>                 

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                      <label>Date</label>
                  </div>
                    <div class="col-md-10">
                      <input type="text" class="form-control" name="saidate" placeholder="Date" style="width: 27%; text-transform:uppercase" value="<?php echo $saidate; ?>" >
          <!-- <input type="hidden" class="form-control" name="isdate" value="<?php echo $isdate; ?>" > -->
                    </div><!-- /.form-group
                  </div><!-- /.col -->
                </div><hr style="border-width: 1px 1px 0;
                           border-style: solid;
                           border-color: palevioletred; 
                           width: 100%;
                           margin-left: auto;
                           margin-right: auto;">


              

                <div class="row"> 
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Requested By</label>
                  </div>
                  <div class="col-md-10">
                      <input type="text" class="form-control" name="reqby" placeholder="Requested By" style='text-transform:uppercase' value="<?php echo $reqby; ?>" >  
                     
                    </select>  
                  </div>
                </div><br>

                <div class="row"> 
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Checked By</label>
                  </div>
                  <div class="col-md-10">
                      <input type="text" class="form-control" name="checkby" placeholder="Checked By" style='text-transform:uppercase' value="<?php echo $checkby; ?>" > 
                      <!-- <input type="hidden" class="form-control" name="issuedby" value="<?php echo $db_userfullname; ?>" required>                        -->
                  </div>
                </div><br>

                <div class="row"> 
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Purpose</label>
                  </div>
                  <div class="col-md-10">
                      <input type="text" class="form-control" name="purpose" placeholder="Purpose" style='text-transform:uppercase' value="<?php echo $purpose; ?>" > 
                      <!-- <input type="hidden" class="form-control" name="receivedby" value="<?php echo $receivedby; ?>" required>                        -->
                  </div>
                </div><br>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <input type="submit" name="addprinfo" class="btn btn-primary" value="Save">
                <a href="pr">
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

<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- PACE -->
<script src="../bower_components/pace/pace.min.js"></script>
<!-- Select2 -->
<script src="../bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

<script>
      $('.select2').select2();

      $('#users').DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : false,
            'info'        : true,
            'autoWidth'   : false,
            'autoHeight'  : false
      });


      $(document).ready(function() { 
        $("#data_items").click(function() { 
          var value = $("#myselection option:selected"); 

 $('#unit').val($('#unit').val() + value);
           // alert(value.text()); 
        }); 
      });
      




</script>

<script>
$(document).ready(function(){
    $('#dept').on('change', function(){
        var deptID = $(this).val();
        if(deptID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'idno='+deptID,
                success:function(html){
                    $('#status').html(html);
                }
            }); 
        }else{
            $('#personnel').html('<option value="">Select area first</option>');
        }
    });
    
    $('#personnel').on('change', function(){
        var personnelID = $(this).val();
        if(personnelID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'personnel_id='+personnelID;
                }
            }); 
        }
    });
});
</script>



</body>
</html>