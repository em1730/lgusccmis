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


$alert_msg = $btnEdit = $btnSave = $get_firstname =
    $get_lastname = $get_middlename = $get_position = $get_idno = $type = ' ';


$get_all_position_sql = "SELECT * FROM tbl_position";
$get_all_position_data = $con->prepare($get_all_position_sql);
$get_all_position_data->execute();


if (isset($_GET['objid'])) {
    $user_id = $_GET['id'];

    $get_sql = "SELECT * FROM tbl_checkedby WHERE idno = :id";
    $get_data = $con->prepare($get_sql);
    $get_data->execute([':id' => $user_id]);
    while ($result = $get_data->fetch(PDO::FETCH_ASSOC)) {
        $get_firstname      = $result['firstname'];
        $get_middlename     = $result['middlename'];
        $get_lastname       = $result['lastname'];
        $get_position       = $result['position'];
        $get_idno           = $result['idno'];
    }
}




?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> HM SYSTEM | Update Checked By</title>
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
        <div class="content-wrapper" align="center">
            <div class="content-header"></div>

            <section class="content col-md-10">
                <div class="card card-dark">
                    <div class="card-header" align="left">
                        <h4>Update Checked By</h4>
                    </div>
                    <div class="card-body" align="left">
                        <div class="box box-primary">
                            <form role="form" method="POST" action="">
                                <div class="box-body">

                                    <?php echo $alert_msg; ?>

                                    <input type="hidden" readonly class="form-control" name="get_idno" placeholder="idno" value="<?php echo $get_idno; ?>" required>
                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                            <label>First Name:</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" readonly onkeyup="this.value = this.value.toUpperCase();" class="form-control" name="get_firstName" placeholder="First Name" value="<?php echo $get_firstname; ?>" required>
                                        </div>
                                    </div><br>


                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                            <label>Middle Name:</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" readonly onkeyup="this.value = this.value.toUpperCase();" class="form-control" name="get_middleName" placeholder="Middle Name" value="<?php echo $get_middlename; ?>" required>
                                        </div>
                                    </div><br>


                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                            <label>Last Name:</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" readonly onkeyup="this.value = this.value.toUpperCase();" class="form-control" name="get_lastName" placeholder="Middle Name" value="<?php echo $get_lastname; ?>" required>
                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                            <label>Position:</label>
                                        </div>
                                        <div class="col-md-7">
                                            <select class="form-control select2" readonly style="width: 100%;" name="get_position" value="<?php echo $type; ?>">
                                                <option>Please select...</option>
                                                <?php while ($get_poss = $get_all_position_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                    <?php $selected = ($get_position == $get_poss['positions']) ? 'selected' : ''; ?>
                                                    <option <?= $selected; ?> value="<?php echo $get_poss['positions']; ?>"><?php echo $get_poss['positions']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div><br>


                                    <div class="box-footer" align="center">
                                        <button type="button" <?php echo $btnEdit; ?> name="edit" id="btnEdit" class="btn btn-info">
                                            <i class="fa fa-edit fa-fw"> </i> </button>
                                        <button type="submit" <?php echo $btnSave; ?> name="update_checkedby" id="btnSave" class="btn btn-success">
                                            <i class="fa fa-check fa-fw"> </i> </button>
                                        <a href="list_checkedby">
                                            <button type="button" name="cancel" class="btn btn-danger">
                                                <i class="fa fa-close fa-fw"> </i> </button>
                                        </a>
                                    </div>

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
        $('.select2').select2();

        $("#btnSave").attr("disabled", true);
        $(".select2").attr("disabled", true);
        $("#get_others").attr("disabled", true);

        $(document).ready(function() {
            $('#btnEdit').click(function() {

                $("input[name='get_lastName']").removeAttr("readonly");
                $("input[name='get_middleName']").removeAttr("readonly");
                $("input[name='get_firstName']").removeAttr("readonly");

                $(".select2").attr("disabled", false);
                $("#btnSave").attr("disabled", false);
                $("#btnEdit").attr("disabled", true);
            });
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