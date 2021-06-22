<?php


session_start();



include('../config/db_config.php');

if (!isset($_SESSION['id'])) {
    header('location:../index');
}


include('sql_querries.php');


$user_id = $_SESSION['id'];
//select user
$get_user_sql = "SELECT * FROM tbl_users WHERE user_id = :id";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {
    $db_first_name = $result['first_name'];
    $db_middle_name = $result['middle_name'];
    $db_last_name = $result['last_name'];
    $db_email_ad = $result['email'];
    $db_contact_number = $result['contact_no'];
    $user_name = $result['username'];
    $department = $result['department'];
}



//select all users
$get_all_sql = "SELECT * FROM hms_technician WHERE status = 'Active' ORDER BY idno DESC";
$get_all_data = $con->prepare($get_all_sql);
$get_all_data->execute();






$alert_msg = $btnEdit = $btnSave = $firstname = $middlename = $lastname = ' ';



?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> HM SYSTEM | List of Technician</title>
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
                        <h4>List of Technician

                            <button type="button" style="float:right;" class="btn btn-dark bg-gradient-dark" data-toggle="modal" data-target="#AddModal">
                                <i class="nav-icon fa fa-plus-square"></i>
                            </button>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="box box-primary">
                            <form role="form" method="POST" action="">
                                <div class="box-body">
                                    <table class="table table-bordered table-striped" id="users">
                                        <thead align="center">
                                            <tr>
                                                <th>ID No.</th>
                                                <th>Full Name</th>
                                                <th>Status</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($tech_data = $get_all_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                <tr align="center">
                                                    <!-- <td><input type="checkbox" value ="" name="" /> -->

                                                    <td><?php echo $tech_data['idno']; ?></td>
                                                    <td><?php echo $tech_data['firstname'];
                                                        echo " ";
                                                        echo $tech_data['middlename'];
                                                        echo " ";
                                                        echo $tech_data['lastname']; ?></td>
                                                    <td><?php echo $tech_data['status']; ?></td>

                                                    <td>
                                                        <a class="btn btn-dark btn-sm" href="view_technician.php?objid=<?php echo $tech_data['objid']; ?>&id=<?php echo $tech_data['idno']; ?> ">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <!-- <button class="btn btn-danger btn-sm" data-role="confirm_delete" data-id="<?php echo $tech_data["idno"]; ?>"><i class="fa fa-trash-o"></i>
                                                        </button> -->

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







    <div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-dark">
                    <h5 class="modal-title" id="exampleModalLabel "> Add Technician</h5>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> -->
                </div>

                <form method="POST" action="">
                    <div class="modal-body">

                        <?php echo $alert_msg; ?>
                        <div class=" form-group">
                            <label for="recipient-name" class="col-form-label">First Name:</label>
                            <input type="text" class="form-control " name="firstname" value="<?php echo $firstname; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Middle Name:</label>
                            <input type="text" class="form-control " name="middlename" value="<?php echo $middlename; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Last Name:</label>
                            <input type="text" class="form-control " name="lastname" value="<?php echo $lastname; ?>" required>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" name="add_technician" id="btnSave" class="btn btn-success">
                                <i class="fa fa-check fa-fw"> </i> </button>
                            <button type="button" name="cancel" class="btn btn-danger" data-dismiss="modal">
                                <i class="fa fa-close fa-fw"> </i> </button>
                        </div>

                    </div>
                </form>

            </div>
        </div>
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
            'autoWidth': true
        });


        $(document).on('click', 'button[data-role=confirm_delete]', function(event) {
            event.preventDefault();

            var user_id = ($(this).data('id'));

            $('#user_id').val(user_id);
            $('#delete_PUMl').modal('toggle');

        });
    </script>
</body>

</html>