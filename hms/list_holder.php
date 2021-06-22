<?php


include('../config/db_config.php');
session_start();
$user_id = $_SESSION['id'];

if (!isset($_SESSION['id'])) {
    header('location:../index.php');
} else {
}



include('sql_querries.php');

//fetch user from database
$get_user_sql = "SELECT * FROM tbl_users where user_id = :id";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {
    $db_first_name = $result['first_name'];
    $db_middle_name = $result['middle_name'];
    $db_last_name = $result['last_name'];
}



$get_all_holder_sql = "SELECT * FROM tbl_holder WHERE status = 'Active' ORDER BY idno DESC";
$get_all_holder_data = $con->prepare($get_all_holder_sql);
$get_all_holder_data->execute();





?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> HM SYSTEM | List of Item Holder</title>
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
                        <h4>List of Item Holder
                            <a href="add_holder" style="float:right;" type="button" class="btn btn-dark bg-gradient-dark" style="border-radius: 0px;">
                                <i class="nav-icon fa fa-plus-square"></i></a>
                        </h4>
                    </div>

                    <div class="card-body">
                        <div class="box box-primary">
                            <form role="form" method="get" action="">
                                <div class="box-body">

                                    <div class="row">
                                        <div class="col-md-3" id="combo"></div>
                                    </div>
                                    <br>
                                    <table id="users" class="table table-bordered table-striped">
                                        <thead align="center">
                                            <tr>
                                                <th>ID No.</th>
                                                <th>User</th>
                                                <th>Computer Name</th>
                                                <th>IP Address</th>
                                                <th>Department</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>

                                        <tbody align="center">
                                            <?php while ($holder_data = $get_all_holder_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                <tr>
                                                    <td><?php echo $holder_data['idno']; ?></td>
                                                    <td><?php echo $holder_data['user']; ?></td>
                                                    <td><?php echo $holder_data['computername']; ?></td>
                                                    <td><?php echo $holder_data['ipaddress']; ?></td>
                                                    <td><?php echo $holder_data['department']; ?></td>
                                                    <td>
                                                        <a class="btn btn-dark btn-sm" href="view_holder.php?objid=<?php echo $holder_data['objid']; ?>&id=<?php echo $holder_data['idno']; ?> ">
                                                            <i class="fa fa-eye"></i>
                                                        </a>

                                                        <button class="btn btn-danger btn-sm" data-role="confirm_delete" data-id="<?php echo $holder_data["idno"]; ?>"><i class="fa fa-trash-o"></i>
                                                        </button>
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




    <!-- DELETE MODAL -->
    <div class="modal fade" id="delete_PUMl" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Confirm Delete</h4>
                </div>
                <form method="POST" action="">
                    <div class="modal-body">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Delete Record?</label>
                                <input readonly="true" type="text" name="user_id" id="user_id" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-default pull-left bg-olive" data-dismiss="modal">No</button>
                        <!-- <button type="submit" name="delete_user" class="btn btn-danger">Yes</button> -->
                        <input type="submit" name="delete_holder" class="btn btn-danger" value="Yes">
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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
            'autoWidth': true,
            initComplete: function() {
                this.api().columns([4]).every(function() {
                    var column = this;
                    var select = $('<select class="form-control select2"><option value="">show all</option></select>')
                        .appendTo('#combo')
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });
                    column.data().unique().sort().each(function(d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
            }
        });

        $('.select2').select2();



        $(document).on('click', 'button[data-role=confirm_delete]', function(event) {
            event.preventDefault();

            var user_id = ($(this).data('id'));

            $('#user_id').val(user_id);
            $('#delete_PUMl').modal('toggle');

        });
    </script>
</body>

</html>