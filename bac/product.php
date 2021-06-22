
<?php

include ('../config/db_config.php');
session_start();
$user_id = $_SESSION['id'];

if (!isset($_SESSION['id'])) {
    header('location:../index.php');
} else {

}


//fetch user from database
$get_user_sql = "SELECT * FROM tbl_users where user_id = :id";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {


    $db_first_name = $result['first_name'];
    $db_middle_name = $result['middle_name'];
    $db_last_name = $result['last_name'];

}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BAC | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
 <!-- Date Picker -->
  <link rel="stylesheet" href=".s./plugins/datepicker/datepicker3.css">
  <!-- DataTables -->
   <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap4.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <?php include('sidebar.php');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
    <div class="content-header"></div>

    <div class="container-fluid">      
        <div class="row" style="margin-left:15px;">
        <!-- list of products -->
            <div style="width: 20rem;">
                <div class="card shadow h-100">
                    <div class="card-body " style="width: 20rem;">
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto" >
                        <i class="fa fa-th-list fa-fw"></i> 
                        </div>
                        <div class="panel-heading"> Products / Items</div>


                        <div class="row no-gutters align-items-center mt-1">
                        <div class="col-auto">
                            <div class="h6 mb-0 mr-0 text-gray-800">
                            <div class="panel-body">
                                <div class="list-group">
                                <?php 
                                        $db = mysqli_connect('localhost', 'root', '1234', 'scc_bac');
                                        $products = "SELECT itemcode, itemname  FROM tbl_items order by idno DESC LIMIT 5";
                                        $result = mysqli_query($db, $products);  
                                        while ($row = mysqli_fetch_array($result)) {

                                            echo "<a  class='list-group-item text-gray-800' style='color: blue;'>
                                                <i class='fa fa-tasks fa-fw'></i> &nbsp; $row[0] &nbsp;  - &nbsp; $row[1] 
                                                </a>";
                                        }
                                ?>
                                    <a href="list_items.php" target="_blank" class="btn btn-default btn-block">View All Products / Items</a>

                                </div>
                        
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>   
                </div>
               




            
            </div>
           <div style ="margin-left: 5%;">
           </div>
 
        <!-- item category -->
            <div style="width: 22rem;">
                <div class="card shadow h-100">
                    <div class="card-body" style="width: 22rem;">
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto" >
                        <i class="fa fa-th-list fa-fw"></i> 
                        </div>
                        <div class="panel-heading" style="text-positon: center;" > Item Category</div>


                        <div class="row no-gutters align-items-center mt-1">
                            <div class="col-auto">
                                <div class="h6 mb-0 mr-0 text-gray-800">
                                    <div class="panel-body">
                                        <div class="list-group">
                                        <?php 
                                                $db = mysqli_connect('localhost', 'root', '1234', 'scc_bac');
                                                $categ = "SELECT code, itemcategory  FROM category order by idno DESC LIMIT 5";
                                                $result = mysqli_query($db, $categ);  
                                                while ($row = mysqli_fetch_array($result)) {

                                                    echo "<a  class='list-group-item text-gray-800' style='color: blue;'>
                                                        <i class='fa fa-tasks fa-fw'></i> &nbsp; $row[0] &nbsp; -&nbsp;   $row[1] 
                                                        </a>";
                                                }
                                        ?>
                                            <a href="list_category.php" target="_blank" class="btn btn-default btn-block">View All Item Category</a>

                                        </div>
                                
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>   
                </div>
            
            </div>
            <div style ="margin-left: 5%;">
           </div>
            
            
          <!-- list of items unit -->
            <div style="width: 20rem;">
                <div class="card shadow h-100">
                    <div class="card-body" style="width: 20rem;" >
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto" >
                        <i class="fa fa-th-list fa-fw"></i> 
                        </div>
                        <div class="panel-heading" style="text-positon: center;" > Units </div>


                        <div class="row no-gutters align-items-center mt-1">
                        <div class="col-auto">
                            <div class="h6 mb-0 mr-0 text-gray-800">
                            <div class="panel-body">
                                <div class="list-group">
                                <?php 
                                        $db = mysqli_connect('localhost', 'root', '1234', 'scc_bac');
                                        $unit = "SELECT unit, description  FROM tbl_itemunit order by idno DESC LIMIT 5";
                                        $result = mysqli_query($db, $unit);  
                                        while ($row = mysqli_fetch_array($result)) {

                                            echo "<a  class='list-group-item text-gray-800' style='color: blue;'>
                                                <i class='fa fa-tasks fa-fw'></i> &nbsp; $row[0] &nbsp; &nbsp; - &nbsp; &nbsp; $row[1] 
                                                </a>";
                                        }
                                ?>
                                    <a href="list_unit.php" target="_blank" class="btn btn-default btn-block">View All Units</a>

                                </div>
                        
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>   
                </div>
            
            </div>
           
         </div>

         <br><br></br>
         <!-- list of supplier -->
         <div class="row " style="margin-left:15px;">
            <div style="width: 30rem;">
                <div class="card shadow h-100">
                    <div class="card-body " style="width: 30rem;">
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto" >
                                <i class="fa fa-th-list fa-fw"></i> 
                            </div>
                            <div class="panel-heading" style="text-positon: center;" > Suppliers </div>


                            <div class="row no-gutters align-items-center mt-1">
                                <div class="col-auto">
                                    <div class="h6 mb-0 mr-0 text-gray-800">
                                        <div class="panel-body">
                                            <div class="list-group">
                                                <?php 
                                                $db = mysqli_connect('localhost', 'root', '1234', 'scc_bac');
                                                $suppliers = "SELECT code, name_supplier  FROM tbl_suppliers order by idno DESC LIMIT 5";
                                                $result = mysqli_query($db, $suppliers);  
                                                while ($row = mysqli_fetch_array($result)) {

                                                    echo "<a  class='list-group-item text-gray-800' style='color: blue;' >
                                                        <i class='fa fa-tasks fa-fw'></i> &nbsp; $row[0] &nbsp; -  &nbsp; $row[1] 
                                                        </a>";
                                                }
                                                ?>

                                                <a href="list_supplier.php" target="_blank" class="btn btn-default btn-block">View All Suppliers</a>

                                            </div>
                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>   
                </div>
               




            
            </div>
         
         
         </div>

    
      
    </div>
    
    <!-- end row -->

  </div>
  <!-- /.content-wrapper -->
 <?php include('footer.php')?>

</div>

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
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
</body>
</html>
