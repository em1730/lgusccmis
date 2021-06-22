<?php

session_start();
include ('../config/db_config.php');

$btnNew = 'disabled';
if (!isset($_SESSION['id'])) {
    header('location:../index');
}
$department =  '';

$user_id = $_SESSION['id'];

//querry to select current user's information
$get_user_sql = "SELECT * FROM tbl_users WHERE user_id = :id";
$get_user_data = $con->prepare($get_user_sql);
$get_user_data->execute([':id'=>$user_id]);
while ($result = $get_user_data->fetch(PDO::FETCH_ASSOC)) {
  $user_name   = $result['username'];
  $department  = $result['department'];
}

$get_all_prinfo_sql = "SELECT * FROM pr_info WHERE pr_info_dept  =  '$department' ";
$get_all_prinfo_data = $con->prepare($get_all_prinfo_sql);
$get_all_prinfo_data->execute(); 


?>

<!DOCTYPE html> 
<html >
<head>


<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BAC | Purchase Request</title>

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
  <link rel="stylesheet" href="../plugins/select2/select2.min.css">
  <!-- Daterange picker
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css"> -->
  <!-- bootstrap wysihtml5 - text editor -->
  <!-- <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"> -->
  <!-- Google Font: Source Sans Pro -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
   <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap4.css">
     <!-- Select2 -->
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

  <link href="../plugin/bootstrap-dialog.css" rel="stylesheet" type="text/css" />

  <script src="js/bootstrap-dialog.js"></script>

</head>

<body class="hold-transition sidebar-mini">

<div class="wrapper">
  
  <!-- Left side column. contains the logo and sidebar -->
  <?php include('sidebar.php');?>

 
    <div class="content-wrapper">
      <div class="content-header"></div>

      
      
      <section class="content">
    
          <div class="card card-info">
            <div class="card-header">
              <h4 style="float:left;" >List of PRsssszssss</h4>
              <a href="add_purchaseReq" style="text-decoration:none;">
                <button  style="float:right; "type="button" class="btn btn-success" >Add PR</button>
              </a>
              
            </div>
          
            <div class="card-body">

              <div class="box box-primary">
                <form role="form" method="get" action="<?php htmlspecialchars("PHP_SELF");?>">

                  <div class="box-body">
                  
                    <table id="users" class="table table-bordered table-striped">
                      <thead>
                      
                        <tr style="font-size: 1.10rem">
                            <th> ID </th>
                            <th> Control No </th>
                            <th> PR No. </th>
                            <th> Date & Time</th>                                      
                            <th> Options </th>
                          </tr>
                          
                      </thead>

                      <tbody>
                        <?php while($pr_data = $get_all_prinfo_data->fetch(PDO::FETCH_ASSOC)){  ?>
                          <tr style="font-size: 1rem">
                            <td><?php echo $pr_data['pr_info_objid'];?> </td>
                            <td><?php echo $pr_data['pr_info_control_no'];?> </td>
                            <td><?php echo $pr_data['pr_info_no'];?> </td>
                            <td><?php echo $pr_data['pr_info_date'];?> <?php echo " ";?><?php echo $pr_data['pr_info_time'];?> </td>
                            <td>
                            <a class="btn btn-outline-success btn-xs" 
                            href="add_purchase.php?objid=<?php echo $pr_data['pr_info_control_no'];?>&id=<?php echo $pr_data['pr_info_objid'];?>">
                            <i class="fa fa-search"></i>
                             </a>
                            &nbsp;                           
                            
                          </td>


                          </tr>
                        <?php   } ?>
                      </tbody>
                    </table>
                  </div>
                </form>
              </div>       
         
          </div>
      </section>
      
      
      
     



    </div>

  <!-- footer here -->
    <?php include('footer.php');?>
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