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


$alert_msg = $btnEdit = $btnSave = $itemuser = $compName =
    $ipAdd = $videoCard =  $processor =  $hardDisk = $memory =
    $dvddrive = $monitor = $ups = $avr = $printer = $switch = $others = ' ';


$get_all_department_sql = "SELECT * FROM tbl_department";
$get_all_department_data = $con->prepare($get_all_department_sql);
$get_all_department_data->execute();


?>




<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> HM SYSTEM | Add Item Holder</title>
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
                        <h4>Add Item Holder</h4>
                    </div>
                    <div class="card-body" align="left">
                        <div class="box box-primary">
                            <form role="form" method="POST" action="">
                                <div class="box-body">

                                    <?php echo $alert_msg; ?>

                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                            <label>Department:</label>
                                        </div>
                                        <div class="col-md-7">
                                            <select class="form-control select2" id="department" name="department" value="<?php echo $department; ?>">
                                                <option selected="selected">Please select...</option>
                                                <?php while ($set_department = $get_all_department_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                    <option value="<?php echo $set_department['objid']; ?>"><?php echo $set_department['department']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                            <label>Item User:</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" readonly class="form-control" name="itemUser" placeholder="Item User" value="<?php echo $itemuser; ?>" required>
                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                            <label>Computer Name:</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" readonly class="form-control" name="compName" placeholder="Computer Name" value="<?php echo $compName; ?>" required>
                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                            <label>IP Address:</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" readonly class="form-control" name="ipAdd" placeholder="IP Address" value="<?php echo $ipAdd; ?>" required>
                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                            <label>Video Card:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" readonly class="form-control" name="videoCard" placeholder="Video Card" value="<?php echo $videoCard; ?>" required>
                                        </div>
                                        <div class="col-md-1" style="text-align: right;padding-top: 5px;">
                                            <label>Processor:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" readonly class="form-control" name="processor" placeholder="Processor" value="<?php echo $processor; ?>" required>
                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                            <label>Hard Disk:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" readonly class="form-control" name="hardDisk" placeholder="Hard Disk" value="<?php echo $hardDisk; ?>" required>
                                        </div>
                                        <div class="col-md-1" style="text-align: right;padding-top: 5px;">
                                            <label>Memory:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" readonly class="form-control" name="memory" placeholder="Memory" value="<?php echo $memory; ?>" required>
                                        </div>
                                    </div><br>


                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                            <label>CD / DVD Drive:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" readonly class="form-control" name="dvdDrive" placeholder="CD / DVD Drive" value="<?php echo $dvddrive; ?>" required>
                                        </div>
                                        <div class="col-md-1" style="text-align: right;padding-top: 5px;">
                                            <label>Monitor:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" readonly class="form-control" name="monitor" placeholder="Monitor" value="<?php echo $monitor; ?>" required>
                                        </div>
                                    </div><br>


                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                            <label>UPS:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" readonly class="form-control" name="ups" placeholder="UPS" value="<?php echo $ups; ?>" required>
                                        </div>
                                        <div class="col-md-1" style="text-align: right;padding-top: 5px;">
                                            <label>AVR:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" readonly class="form-control" name="avr" placeholder="AVR" value="<?php echo $avr; ?>" required>
                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                            <label>Printer:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" readonly class="form-control" name="printer" placeholder="Printer" value="<?php echo $printer; ?>" required>
                                        </div>
                                        <div class="col-md-1" style="text-align: right;padding-top: 5px;">
                                            <label>Switch:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" readonly class="form-control" name="switch" placeholder="Last Name" value="<?php echo $switch; ?>" required>
                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                            <label>Others:</label>
                                        </div>
                                        <div class="col-md-7">
                                            <textarea rows="2" class="form-control" id="others" name="others" placeholder="Others" required><?php echo $others; ?></textarea>
                                        </div>
                                    </div><br>


                                    <div class="box-footer" align="center">
                                        <button type="button" <?php echo $btnEdit; ?> name="edit" id="btnEdit" class="btn btn-info">
                                            <i class="fa fa-edit fa-fw"> </i> </button>
                                        <button type="submit" <?php echo $btnSave; ?> name="add_holder" id="btnSave" class="btn btn-success">
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
        $("#others").attr("disabled", true);

        $(document).ready(function() {
            $('#btnEdit').click(function() {

                $("input[name='itemUser']").removeAttr("readonly");
                $("input[name='ipAdd']").removeAttr("readonly");
                $("input[name='compName']").removeAttr("readonly");
                $("input[name='videoCard']").removeAttr("readonly");
                $("input[name='processor']").removeAttr("readonly");
                $("input[name='hardDisk']").removeAttr("readonly");
                $("input[name='memory']").removeAttr("readonly");
                $("input[name='dvdDrive']").removeAttr("readonly");
                $("input[name='monitor']").removeAttr("readonly");
                $("input[name='ups']").removeAttr("readonly");
                $("input[name='avr']").removeAttr("readonly");
                $("input[name='printer']").removeAttr("readonly");
                $("input[name='switch']").removeAttr("readonly");

                $("#others").attr("disabled", false);
                $(".select2").attr("disabled", false);
                $("#btnSave").attr("disabled", false);
                $("#btnEdit").attr("disabled", true);
            });
        });
    </script>

</body>

</html>