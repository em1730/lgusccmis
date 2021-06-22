<?php

session_start();

if (!isset($_SESSION['id'])) {
  header('location:../index.php');
}

$user_id = $_SESSION['id'];

include('../config/db_config.php');
// include('ch_delete_item.php');
include('tbl_users.php');

// // updating all account balance
// $update_all_accounts_sql = "UPDATE accounts, account_details SET account_balance = 
//                           (SELECT account_appropriation - sum(account_detail_allotment) 
//                           FROM account_details WHERE account_parentid = account_id and account_detail_state = 'ACTIVE')
//                           WHERE account_id = account_parentid and account_detail_state = 'ACTIVE'";
// $update_all_accounts_data = $connect_db->prepare($update_all_accounts_sql);
// $update_all_accounts_data->execute();

//querry to select current user's information
// $get_user_sql = "SELECT * FROM tbl_users WHERE user_id = :id";
// $get_user_data = $connect_db->prepare($get_user_sql);
// $get_user_data->execute([':id'=>$user_id]);
// while ($result = $get_user_data->fetch(PDO::FETCH_ASSOC)) {
//   $user_name   = $result['username'];
//   $office      = $result['office'];
// }

$prinfoid      = $_GET['prinfoid']; 
// $irno          = $_GET['irno']; 
// $irdate        = $_GET['irdate']; 
// $irofficecode  = $_GET['irofficecode']; 
// $irofficename  = $_GET['irofficename']; 
// $issuedby      = $_GET['issuedby']; 

$get_all_issue_sql = "SELECT * FROM pr_info where pr_info_objid = :probjid
                      and pr_info_state = 'ACTIVE'";
$get_all_issue_data = $con->prepare($get_all_issue_sql);
$get_all_issue_data->execute([':probjid'=>$prinfoid]);
while ($result = $get_all_issue_data->fetch(PDO::FETCH_ASSOC)) {
  $dept        = $result['pr_info_dept'];
  $prno        = $result['pr_info_no'];
  $prdate      = $result['pr_info_date'];
  $section     = $result['pr_info_section'];
  $saino       = $result['pr_info_sai_no'];
  $saidate     = $result['pr_info_sai_date'];

}
//querry for displaying accounts 

// echo "user id ".$user_id. " user name ".$user_name." irinfoid == ".$irinfoid;

$get_all_users_sql = "SELECT * FROM pr_items 
                      inner join items on items.item_code = pr_items.pr_item_code
                      where pr_item_state = 'ACTIVE' 
                      and pr_info_objid = :infoid order by pr_item_linenum";
$get_all_user_data = $con->prepare($get_all_users_sql);
$get_all_user_data->execute([':infoid'=>$prinfoid]);


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
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
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
      <h1><b>PR ITEMS</b>&nbsp;&nbsp;
          Department&nbsp;<b><?php echo $dept;?></b>&nbsp;&nbsp;
          PR No.&nbsp;<b><?php echo $prno;?></b>&nbsp;&nbsp;
          Date&nbsp;<b><?php echo $prdate;?></b></br>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Section&nbsp;<b><?php echo $section;?></b>&nbsp;&nbsp;
          SAI No.&nbsp;<b><?php echo $saino;?></b>&nbsp;&nbsp;
          Date&nbsp;<b><?php echo $saidate;?></b>
<!--         <a href="add_account" target="blank"><i class="fa fa-envelope-o"></i> New Account</a>
 -->        <!-- <small>Version 2.0</small> -->
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="../index"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol> -->


      <!-- <ol class="breadcrumb">
        <li><a href="ch_add_pr_item.php?prinfoid=<?php echo $prinfoid;?>
            &dept=<?php echo $dept;?>
            &section=<?php echo $section;?>
            &prdate=<?php echo $prdate;?>
            " target="blank" accesskey="n" style="font-size: 1.5rem; background-color: yellow"><i class="fa fa-edit"></i><b>Add Item</b></a></li>
      </ol> -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
<!--         <div class="col-md-3">
          <a href="add_user">
            <button class="btn btn-primary btn-block margin-bottom" >
              Add User
            </button>                      
          </a>
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Folders</h3>
              <div class="box-tools">
 -->             <!--    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button> -->
<!--               </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="../bower_components/TCPDF/User/blank" target="blank"><i class="fa fa-envelope-o"></i> Generate PDF</a></li>
                <li><a href="../bower_components/PHPExcel/Examples/blank"><i class="fa fa-envelope-o"></i> Export Data</a></li>
                <li><a href="import_data"><i class="fa fa-file-text-o"></i> Import Data</a></li>
              </ul>
            </div>
 -->            <!-- /.box-body -->
<!--           </div>
        </div>
        <div class="col-md-9">
 -->          <div class="box box-primary">
            <div class="box-header with-border">
              <!-- <h3 class="box-title">Accounts</h3> -->
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="get" action="<?php htmlspecialchars("PHP_SELF");?>">
              <div class="box-body">
                <table id = "ch_pr_items" class= "table table-bordered table-striped" line-height="1.0">
                    <thead>
                        <tr style="font-size: 1.75rem">
                            <th> ID</th>
                            <th> Item<br>No.</th>
                            <th> Code&nbsp;&nbsp;&nbsp;&nbsp;Unit </th>
                            <th> Lot No.</th>
                            <th> Description </th>
                            <th> Quantity </th>
                            <th> Unit Cost </th>
                            <th> Total Cost </th>
                            <th> Remarks </th>
                            <th> Options </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($user_data = $get_all_user_data->fetch(PDO::FETCH_ASSOC)){ 
                    ?>
                    <tr style="font-size: 1.75rem">
                        <td><?php echo ($user_data['pr_info_objid']);?></td>
                        <td><?php echo ($user_data['pr_item_linenum']);?></td>
                        <td><?php echo ($user_data['pr_item_code']);?>&nbsp;&nbsp;&nbsp;<?php echo ($user_data['pr_item_unit']);?></td>
                        <td><?php echo ($user_data['pr_item_lotno'])."-".($user_data['pr_item_lotname']);?></td>
                        <td><b><?php echo substr($user_data['item_procurement_mode'],0,3);?></b><?php echo "-".$user_data['item_description'];?></td>                        
                        <td align="right"><?php echo number_format(($user_data['pr_item_qty']),0);?></td>
                        <td align="right"><?php echo number_format(($user_data['pr_item_unitcost']),2);?></td>
                        <td align="right"><?php echo number_format(($user_data['pr_item_totalcost']),2);?></td>
                        <td><?php echo ($user_data['pr_item_remarks']);?></td>
                        <td>
                        <?php  if ($user_data['pr_item_remarks'] != 'COMPLETE') { ?>
                          <a style="background-color:red;color:yellow" class="btn btn-outline-success btn-xs" title="Update HERE" 
                              href="ch_update_pr_item.php?itemid=<?php echo $user_data['pr_item_objid'];?>
                            "><i class="fa fa-check-square-o"></i>
                          </a>
                        <?php } ?>      
<!--                           &nbsp; 
                          <button class="btn btn-outline-danger btn-xs" data-role="confirm_delete" data-id="<?php echo $user_data["item_objid"]; ?>"><i class="fa fa-trash-o"></i></button> -->
                          <a style="background-color:green;color:yellow" title="Details" class="btn btn-outline-primary btn-xs" 
                              href="ch_item_details_all.php?
                              itemcode=<?php echo $user_data['item_code'];?> 
                              ">
                            <i class="fa fa-list"></i></a>
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
     $('#ch_pr_items').DataTable({
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