<?php

session_start();

if (!isset($_SESSION['id'])) {
  header('location:../index.php');
}

$user_id = $_SESSION['id'];

include('../config/db_config.php');


$get_user_sql = "SELECT * FROM tbl_users WHERE user_id = :id";
$get_user_data = $con->prepare($get_user_sql);
$get_user_data->execute([':id' => $user_id]);
while ($result = $get_user_data->fetch(PDO::FETCH_ASSOC)) {
  $db_first_name = $result['first_name'];
  $db_middle_name = $result['middle_name'];
  $db_last_name = $result['last_name'];
}


// //select all users
// $get_all_items_sql = "SELECT * FROM tbl_items WHERE status = 'ACTIVE'";
// $get_all_items_data = $con->prepare($get_all_items_sql);
// $get_all_items_data->execute();  

// //select all users
// $get_all_categ_sql = "SELECT * FROM tbl_itemcategory WHERE status = 'ACTIVE'";
// $get_all_categ_data = $con->prepare($get_all_categ_sql);
// $get_all_categ_data->execute();  


// //select all users
// $get_all_unit_sql = "SELECT * FROM tbl_itemunit where status='ACTIVE'";
// $get_all_unit_data = $con->prepare($get_all_unit_sql);
// $get_all_unit_data->execute();  

$get_all_requestedby_sql = "SELECT * FROM tbl_requestedby where status='ACTIVE'";
$get_all_requestedby_data = $con->prepare($get_all_requestedby_sql);
$get_all_requestedby_data->execute();




?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> BAC | List of Requested by</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap4.css">
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
          <a href="" class="nav-link">Document Tracking</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="index" class="nav-link">Dashboard</a>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto">
        <li class="nav-item d-none d-sm-inline-block">
          <a href="" class="nav-link">Lock Screen</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="" class="nav-link">Log Out</a>
        </li>
      </ul>



    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="" class="brand-link">
        <img src="../dist/img/scclogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
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
            <a href="profile.php" class="d-block"><?php echo $db_first_name . " " . $db_middle_name . " " . $db_last_name ?> </a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <li class="nav-item">
              <a href="index" class="nav-link active">
                <i class="nav-icon fa fa-th"></i>
                <p>
                  Dashboard

                </p>
              </a>
            </li>
            <li class="nav-item has-treeview" style="font-size:16px">
              <a href="" class="nav-link ">
                <i class="nav-icon fa fa-exchange"></i>
                <p>
                  TRANSACTIONS
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="add_purchaseReq" class="nav-link">
                    <i class="fa fa-minus nav-icon"></i>
                    <p>Purchase Request</p>
                  </a>
                </li>
              </ul>
            <li class="nav-item has-treeview" style="font-size:16px">
              <a href="" class="nav-link ">
                <i class="nav-icon fa fa-product-hunt"></i>
                <p>
                  PRODUCTS
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="list_items" class="nav-link">
                    <i class="fa fa-minus nav-icon"></i>
                    <p>Items</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="list_unit" class="nav-link">
                    <i class="fa fa-minus nav-icon"></i>
                    <p>Units</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="list_category" class="nav-link">
                    <i class="fa fa-minus nav-icon"></i>
                    <p>Category</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="list_supplier" class="nav-link">
                    <i class="fa fa-minus nav-icon"></i>
                    <p>Supplier</p>
                  </a>
                </li>

              </ul>

            <li class="nav-item has-treeview" style="font-size:16px">
              <a href="#" class="nav-link ">
                <i class="nav-icon fa fa-list"></i>
                <p>
                  MASTER LIST
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="list_department" class="nav-link">
                    <i class="fa fa-minus nav-icon"></i>
                    <p>Department</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="list_position" class="nav-link">
                    <i class="fa fa-minus nav-icon"></i>
                    <p>Position</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="list_section" class="nav-link">
                    <i class="fa fa-minus nav-icon"></i>
                    <p>Section</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="list_employee" class="nav-link">
                    <i class="fa fa-minus nav-icon"></i>
                    <p>Employee</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="list_approvedby" class="nav-link">
                    <i class="fa fa-minus nav-icon"></i>
                    <p>Approved by</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="list_preparedby" class="nav-link">
                    <i class="fa fa-minus nav-icon"></i>
                    <p>Prepared by</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="list_requestedby" class="nav-link">
                    <i class="fa fa-minus nav-icon"></i>
                    <p>Requested by</p>
                  </a>
                </li>

              </ul>


            <li class="nav-item has-treeview" style="font-size:16px">
              <a href="#" class="nav-link ">
                <i class="nav-icon fa fa-cogs"></i>
                <p>
                  SYSTEM
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>Lock Screen</p>
                  </a>
                <li class="nav-item">
                  <a href="" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>Log Out</p>
                  </a>

              </ul>

        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Requested by
          <!-- <small>Version 2.0</small> -->
        </h1>
        <div class="row">
          <div class="col-md-2">
            <a href="add_requestedby">
              <button class="btn btn-primary btn-block margin-bottom">
                Add Requested by
              </button>
            </a>
          </div>
        </div>

      </section>


      <!-- Main content -->
      <section class="content">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Requested by Details</h3>
          </div>

          <div class="card-body">
            <div class="box box-primary">
              <form role="form" method="get" action="<?php htmlspecialchars("PHP_SELF"); ?>">
                <div class="box-body">
                  <table id="users" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>ID No.</th>
                        <th>Fullname</th>
                        <th>Department</th>
                        <th>Position</th>

                        <th>Status</th>
                        <th>Options</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while ($requestedby_data = $get_all_requestedby_data->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                          <!-- <td><input type="checkbox" value ="" name="" /> -->
                          <td><?php echo $requestedby_data['idno']; ?></td>
                          <td><?php echo $requestedby_data['firstname']; ?> <?php echo " "; ?><?php echo $requestedby_data['middlename']; ?> <?php echo " "; ?><?php echo $requestedby_data['lastname']; ?></td>
                          <td><?php echo $requestedby_data['department']; ?></td>
                          <td><?php echo $requestedby_data['position']; ?></td>
                          <td><?php echo $requestedby_data['status']; ?></td>

                          <td>
                            <a class="btn btn-outline-success btn-xs" href="updateForm_requestedby.php?objid=<?php echo $requestedby_data['objid']; ?>&id=<?php echo $requestedby_data['idno']; ?> "><i class="fa fa-search"></i>
                            </a>
                            &nbsp;

                          </td>
                        </tr>
                      <?php } ?>

                    </tbody>

                  </table>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
      <!-- /.content -->

    </div>
  
    
  </div>


</body>

</html>