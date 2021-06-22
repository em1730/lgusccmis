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


$alert_msg = $btnEdit = $btnSave =
    $get_department = $get_itemuser = $get_computer =
    $get_ipaddress = $get_videocard = $get_processor =
    $hardDisk = $get_memory = $get_dvd = $get_monitor =
    $get_ups = $get_avr = $get_printer = $get_switch =
    $get_others = $get_idno = ' ';


$get_all_department_sql = "SELECT * FROM tbl_department";
$get_all_department_data = $con->prepare($get_all_department_sql);
$get_all_department_data->execute();


if (isset($_GET['objid'])) {
    $user_id = $_GET['id'];

    $get_sql = "SELECT * FROM tbl_holder WHERE idno = :id";
    $get_data = $con->prepare($get_sql);
    $get_data->execute([':id' => $user_id]);
    while ($result = $get_data->fetch(PDO::FETCH_ASSOC)) {
        $get_department     = $result['department'];
        $get_itemuser       = $result['user'];
        $get_computer       = $result['computername'];
        $get_ipaddress      = $result['ipaddress'];
        $get_videocard      = $result['videocard'];
        $get_processor      = $result['processor'];
        $get_harddisk       = $result['harddisk'];
        $get_memory         = $result['memory'];
        $get_dvd            = $result['dvddrive'];
        $get_monitor        = $result['monitor'];
        $get_ups            = $result['ups'];
        $get_avr            = $result['avr'];
        $get_printer        = $result['printer'];
        $get_switch         = $result['switch'];
        $get_others         = $result['others'];
        $get_idno           = $result['idno'];
    }
}




?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> HM SYSTEM | Update Item Holder</title>
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
                        <h4>Update Item Holder</h4>
                    </div>
                    <div class="card-body" align="left">
                        <div class="box box-primary">
                            <form role="form" method="POST" action="">
                                <div class="box-body">

                                    <?php echo $alert_msg; ?>

                                    <input type="hidden" readonly class="form-control" name="idno" placeholder="idno" value="<?php echo $get_idno; ?>" required>
                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                            <label>Department:</label>
                                        </div>
                                        <div class="col-md-7">
                                            <select class="form-control select2" readonly style="width: 100%;" name="get_department" value="<?php echo $type; ?>">
                                                <option>Please select...</option>
                                                <?php while ($get_dept = $get_all_department_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                    <?php $selected = ($get_department == $get_dept['objid']) ? 'selected' : ''; ?>
                                                    <option <?= $selected; ?> value="<?php echo $get_dept['objid']; ?>"><?php echo $get_dept['department']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                            <label>Item User:</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" readonly class="form-control" name="get_itemUser" placeholder="Item User" value="<?php echo $get_itemuser; ?>" required>
                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                            <label>Computer Name:</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" readonly class="form-control" name="get_compName" placeholder="Computer Name" value="<?php echo $get_computer; ?>" required>
                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                            <label>IP Address:</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" readonly class="form-control" name="get_ipAdd" placeholder="IP Address" value="<?php echo $get_ipaddress; ?>" required>
                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                            <label>Video Card:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" readonly class="form-control" name="get_videoCard" placeholder="Video Card" value="<?php echo $get_videocard; ?>" required>
                                        </div>
                                        <div class="col-md-1" style="text-align: right;padding-top: 5px;">
                                            <label>Processor:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" readonly class="form-control" name="get_processor" placeholder="Processor" value="<?php echo $get_processor; ?>" required>
                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                            <label>Hard Disk:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" readonly class="form-control" name="get_hardDisk" placeholder="Hard Disk" value="<?php echo $get_harddisk; ?>" required>
                                        </div>
                                        <div class="col-md-1" style="text-align: right;padding-top: 5px;">
                                            <label>Memory:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" readonly class="form-control" name="get_memory" placeholder="Memory" value="<?php echo $get_memory; ?>" required>
                                        </div>
                                    </div><br>


                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                            <label>CD / DVD Drive:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" readonly class="form-control" name="get_dvdDrive" placeholder="CD / DVD Drive" value="<?php echo $get_dvd; ?>" required>
                                        </div>
                                        <div class="col-md-1" style="text-align: right;padding-top: 5px;">
                                            <label>Monitor:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" readonly class="form-control" name="get_monitor" placeholder="Monitor" value="<?php echo $get_monitor; ?>" required>
                                        </div>
                                    </div><br>


                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                            <label>UPS:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" readonly class="form-control" name="get_ups" placeholder="UPS" value="<?php echo $get_ups; ?>" required>
                                        </div>
                                        <div class="col-md-1" style="text-align: right;padding-top: 5px;">
                                            <label>AVR:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" readonly class="form-control" name="get_avr" placeholder="AVR" value="<?php echo $get_avr; ?>" required>
                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                            <label>Printer:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" readonly class="form-control" name="get_printer" placeholder="Printer" value="<?php echo $get_printer; ?>" required>
                                        </div>
                                        <div class="col-md-1" style="text-align: right;padding-top: 5px;">
                                            <label>Switch:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" readonly class="form-control" name="get_switch" placeholder="Last Name" value="<?php echo $get_switch; ?>" required>
                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                            <label>Others:</label>
                                        </div>
                                        <div class="col-md-7">
                                            <textarea rows="2" class="form-control" id="get_others" name="get_others" placeholder="Others" required><?php echo $get_others; ?></textarea>
                                        </div>
                                    </div><br>


                                    <div class="box-footer" align="center">
                                        <button type="button" <?php echo $btnEdit; ?> name="edit" id="btnEdit" class="btn btn-info">
                                            <i class="fa fa-edit fa-fw"> </i> </button>
                                        <button type="submit" <?php echo $btnSave; ?> name="update_holder" id="btnSave" class="btn btn-success">
                                            <i class="fa fa-check fa-fw"> </i> </button>
                                        <a href="list_holder">
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

                $("input[name='get_itemUser']").removeAttr("readonly");
                $("input[name='get_ipAdd']").removeAttr("readonly");
                $("input[name='get_compName']").removeAttr("readonly");
                $("input[name='get_videoCard']").removeAttr("readonly");
                $("input[name='get_processor']").removeAttr("readonly");
                $("input[name='get_hardDisk']").removeAttr("readonly");
                $("input[name='get_memory']").removeAttr("readonly");
                $("input[name='get_dvdDrive']").removeAttr("readonly");
                $("input[name='get_monitor']").removeAttr("readonly");
                $("input[name='get_ups']").removeAttr("readonly");
                $("input[name='get_avr']").removeAttr("readonly");
                $("input[name='get_printer']").removeAttr("readonly");
                $("input[name='get_switch']").removeAttr("readonly");

                $("#get_others").attr("disabled", false);
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