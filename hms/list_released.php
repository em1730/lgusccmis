<?php


include('../config/db_config.php');
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






$get_all_sql = "SELECT * FROM tbl_repair WHERE status = 'Active' AND remarks = 'Released' ORDER BY idno DESC";
$get_all_data = $con->prepare($get_all_sql);
$get_all_data->execute();








?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> HM SYSTEM | Repaired Hardware</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="../plugins/select2/select2.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap4.css">
    <!-- Bootstrap  -->
    <link href="../plugin/bootstrap-dialog.css" rel="stylesheet" type="text/css" />
    <!--  -->
    <script src="js/bootstrap-dialog.js"></script>

</head>


<body class="hold-transition sidebar-mini">

    <div class="wrapper">
        <?php include('sidebar.php'); ?>
        <div class="content-wrapper">
            <div class="content-header"></div>
            <section class="content">
                <div class="card card-dark">
                    <div class="card-header">
                        <h4>Masterlist of Repaired Hardware
                        </h4>
                    </div>

                    <div class="card-body">
                        <div class="box box-primary">
                            <form role="form" method="get" action="">
                                <div class="box-body">
                                    <table id="users" class="table table-bordered table-striped">
                                        <thead align="center">
                                            <tr>
                                                <th>ID No.</th>
                                                <th>Received Date and Time</th>
                                                <th>Item Name</th>
                                                <th>Received From</th>
                                                <th>Technician</th>
                                                <th>Released Date and Time</th>
                                                <th>Remarks</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php while ($repair_data = $get_all_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                <tr align="center">
                                                    <td> <?php echo $repair_data['idno']; ?></td>
                                                    <td><?php echo $repair_data['receiveddate'];
                                                        echo " ";
                                                        echo $repair_data['receivedtime']; ?></td>
                                                    <td><?php echo $repair_data['item_name']; ?></td>
                                                    <td><?php echo $repair_data['receivedfrom']; ?></td>
                                                    <td><?php echo $repair_data['technician']; ?></td>
                                                    <td><?php echo $repair_data['releaseddate'];
                                                        echo " ";
                                                        echo $repair_data['releasedtime']; ?></td>
                                                    <td><?php echo $repair_data['remarks']; ?></td>
                                                    <td>
                                                        <a class="btn btn-danger btn-sm" href="view_released.php?objid=<?php echo $repair_data['objid_no']; ?>&id=<?php echo $repair_data['idno']; ?> ">
                                                            <i class="fa fa-eye"></i>
                                                        </a>

                                                        <!-- <button class="btn btn-danger btn-sm" data-role="confirm_delete" data-id="<?php echo $repair_data["idno"]; ?>"><i class="fa fa-trash-o"></i>
                                                        </button> -->
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

        </div>

        <?php include('footer.php'); ?>
    </div>

    <!-- ./wrapper -->
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
    <!-- Select2 -->

    <script src="../plugins/select2/select2.full.min.js"></script>
    <script>
        $('#users').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': false,
            'info': true,
            'autoWidth': true
        });
    </script>
</body>

</html>