<?php

session_start();
include ('../../config/db_config.php');
include ('aside.php');
if (!isset($_SESSION['id'])) {
  header('location:../index.php');
}

$user_id = $_SESSION['id'];



$alert_msg = ''; 


//querry to select current user's information
$get_user_sql = "SELECT * FROM tbl_users WHERE user_id = :id";
$get_user_data = $con->prepare($get_user_sql);
$get_user_data->execute([':id'=>$user_id]);
while ($result = $get_user_data->fetch(PDO::FETCH_ASSOC)) {
  $user_name   = $result['username'];
  $department      = $result['department'];

  
}


$get_all_users_sql = "";


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BAC | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- Custom CSS -->
  <link rel="stylesheet" href="../dist/css/custom.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <!-- Pace style -->
  <link rel="stylesheet" href="../bower_components/pace/pace.css">
  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  


  <!-- Left side column. contains the logo and sidebar -->
  
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <b>PR SUMMARY</b>&nbsp;&nbsp;&nbsp;&nbsp;
    </h1>
    
      <ol class="breadcrumb">
        <li><a href="add_pr_info" target="blank" accesskey="n" style="font-size: 1.5rem; background-color: yellow"><i class="fa fa-edit"></i><b>New PR</b></a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">

 -->          <div class="box box-primary">
            <div class="box-header with-border">
            
            </div>
           
            <form role="form" method="get" action="<?php htmlspecialchars("PHP_SELF");?>">
              <div class="box-body">
                <table id = "pr" class= "table table-bordered table-striped" line-height="1.0">
                    <thead>
                      <tr style="font-size: 1.75rem">
                          <th> PR No. </th>
                          <th> Date </th>
                          <th> SAI No. </th>
                          <th> Date </th>
                          <th> Department </th>
                          <th> Section </th>
                          <th> Requested By </th>
                          <th> Checked By </th>
                          <th> PR_Objid </th>
                          <th> R </th>
                          <th> Options </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($user_data = $get_all_user_data->fetch(PDO::FETCH_ASSOC)){ 
                    ?>
                      <tr style="font-size: 1.75rem">






                        <td><?php echo ($user_data['pr_info_no']);?></td>
                        <td><?php echo ($user_data['pr_info_date']);?></td>
                        <td><?php echo ($user_data['pr_info_sai_no']);?></td>
                        <td><?php echo ($user_data['pr_info_sai_date']);?></td>
                        <td><?php echo ($user_data['pr_info_dept']);?></td>
                        <td><?php echo ($user_data['pr_info_section']);?></td> 
                        <td><?php echo ($user_data['pr_info_reqby']);?></td>
                        <td><?php echo ($user_data['pr_info_checkedby']);?></td>
                        <td align="center"><?php echo ($user_data['prinfoobjid']);?></td>
                        <td align="center"><?php echo ($user_data['icount']);?></td>
                        <td>
                       
                        
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
        </div>
        <div class="col-md-1"></div>
      </div>
    </section>
    <!-- /.content -->
    <!-- modals here -->
        <!-- modal here delete -->
        <div class="modal fade" id="deleteuser_Modal" role="dialog" data-backdrop="static" data-keyboard="false">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Confirm Delete</h4>
              </div>
              <form method="POST" action="<?php htmlspecialchars("PHP_SELF")?>">
                <div class="modal-body">  
                  <div class="box-body">
                    <div class="form-group">
                    <label>Delete Record?</label>
                    <input type="text" name="office_id" id="office_id" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left bg-olive" data-dismiss="modal">No</button>
                  <!-- <button type="submit" name="delete_user" class="btn btn-danger">Yes</button> -->
                  <input type="submit" name=" " class="btn btn-danger" value="Yes">
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
<!-- DataTables -->
<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<script>
     $('#pr').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
    $(document).on('click', 'button[data-role=confirm_delete]', function(event){
      event.preventDefault();
      var user_id = ($(this).data('id'));
      $('#user_id').val(user_id);
      $('#deleteuser_Modal').modal('toggle');
    })
</script> 
</body>
</html>