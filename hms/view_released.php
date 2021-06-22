<?php


session_start();

if (!isset($_SESSION['id'])) {
    header('location:../index.php');
}


include('../config/db_config.php');
include('sql_querries.php');

$user_id = $_SESSION['id'];

$btnSave = $btnEdit = $get_idno = $get_code = $get_categ = $alert_msg =
    $get_recommend = $get_actionTaken = $get_unique = '';

$get_user_sql = "SELECT * FROM tbl_users WHERE user_id = :id";
$get_user_data = $con->prepare($get_user_sql);
$get_user_data->execute([':id' => $user_id]);
while ($result = $get_user_data->fetch(PDO::FETCH_ASSOC)) {
    $db_first_name = $result['first_name'];
    $db_middle_name = $result['middle_name'];
    $db_last_name = $result['last_name'];
}


if (isset($_GET['objid'])) {
    $user_id = $_GET['id'];

    $get_sql = "SELECT * FROM tbl_repair WHERE idno = :id";
    $get_data = $con->prepare($get_sql);
    $get_data->execute([':id' => $user_id]);
    while ($result = $get_data->fetch(PDO::FETCH_ASSOC)) {
        $get_idno           = $result['idno'];
        $get_date           = $result['receiveddate'];
        $get_time           = $result['receivedtime'];
        $get_items          = $result['item_name'];
        $get_otheritem      = $result['other_item'];
        $get_deptss         = $result['departments'];
        $get_received       = $result['receivedfrom'];
        $get_technician     = $result['technician'];
        $get_diagss         = $result['diagnostics'];
        $get_remarks        = $result['remarks'];
        $get_unique         = $result['objid_no'];
        $released_date      = $result['releaseddate'];
        $released_time      = $result['releasedtime'];
        $action_taken       = $result['action_taken'];
        $recommend          = $result['recommendation'];
        $remarks            = $result['remarks'];
    }
}

date_default_timezone_set('Asia/Manila');

$releaseddate = date('Y-m-d ');
$releasedtime = date('H:i:s');


$get_all_department_sql = "SELECT * FROM tbl_department";
$get_all_department_data = $con->prepare($get_all_department_sql);
$get_all_department_data->execute();


$get_all_items_sql = "SELECT * FROM tbl_items";
$get_all_items_data = $con->prepare($get_all_items_sql);
$get_all_items_data->execute();



$get_all_tech_sql = "SELECT * FROM tbl_technician";
$get_all_tech_data = $con->prepare($get_all_tech_sql);
$get_all_tech_data->execute();


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>HM SYSTEM | Released Repair Hardware</title>
    <!-- Tell the browser to be responsive to screen width -->
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
    <!-- Daterange picker
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css"> -->
    <!-- bootstrap wysihtml5 - text editor -->
    <!-- <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"> -->
    <!-- Google Font: Source Sans Pro -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap4.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="../plugins/select2/select2.min.css">

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php include('sidebar.php'); ?>
        <div class="content-wrapper" align="center">
            <div class="content-header"> </div>

            <div class="topright col-md-3 ">
                <?php echo $alert_msg; ?>
            </div>

            <section class="content col-md-10">
                <div class="card card-dark">
                    <div class="card-header" align="left">
                        <h4>Repaired Hardware Details

                            <!-- <a href="#" style="float:right;" type="button" class="btn btn-danger bg-gradient-danger" style="border-radius: 0px;">
                                <i class="nav-icon fa fa-print"></i></a> -->


                            <!-- <a style="float:right;" target="blank" id="printlink" class="btn btn-danger bg-gradient-danger" href="../plugins/jasperreport/tsr.php?objidno=<?php echo $get_unique;  ?>">
                                <i class="nav-icon fa fa-print"></i></a>
 -->


                        </h4>
                    </div>
                    <div class="card-body" align="left">
                        <div class="box box-primary">
                            <form role="form" method="post">
                                <div class="box-body">

                                    <?php echo $alert_msg; ?>

                                    <input type="hidden" style="text-align:center; " readonly class="form-control" name="idno" placeholder="Date" value="<?php echo $get_idno; ?>" required>
                                    <input type="hidden" style="text-align:center; " readonly class="form-control" id="objid" name="objid" value="<?php echo $get_unique; ?>" required>

                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                            <label>Received Date & Time:</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" style="text-align:center;" readonly class="form-control" name="get_receivedDate" placeholder="Date" value="<?php echo $get_date . '      ' . $get_time; ?>" required>
                                        </div>

                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                            <label>Released Date & Time:</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" style="text-align:center;" readonly class="form-control" name="get_receivedDate" placeholder="Date" value="<?php echo $releaseddate . '      ' . $releasedtime; ?>" required>
                                        </div>

                                    </div><br>




                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                            <label>Item Received:</label>
                                        </div>
                                        <div class="col-md-7">
                                            <select class="form-control select2" readonly style="width: 100%;" name="get_itemsss" value="<?php echo $type; ?>">
                                                <option>Please select...</option>
                                                <?php while ($get_itemsss = $get_all_items_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                    <?php $selected = ($get_items == $get_itemsss['itemname']) ? 'selected' : ''; ?>
                                                    <option <?= $selected; ?> value="<?php echo $get_itemsss['itemname']; ?>">
                                                        <?php echo $get_itemsss['itemname'] . ' || ' . $get_itemsss['specifications']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                            <label>Others:</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" readonly class="form-control" name="get_otherItem" placeholder="Other Items" value="<?php echo $get_otheritem; ?>" required>
                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                            <label>Department:</label>
                                        </div>
                                        <div class="col-md-7">
                                            <select class="form-control select2" readonly style="width: 100%;" name="get_department" value="<?php echo $type; ?>">
                                                <option>Please select...</option>
                                                <?php while ($get_dept = $get_all_department_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                    <?php $selected = ($get_deptss == $get_dept['objid']) ? 'selected' : ''; ?>
                                                    <option <?= $selected; ?> value="<?php echo $get_dept['objid']; ?>"><?php echo $get_dept['department']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                            <label>Recieved From:</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" readonly class="form-control" name="get_receivedFrom" placeholder="Received From" value="<?php echo $get_received; ?>" required>
                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                            <label>Technician</label>
                                        </div>
                                        <div class="col-md-7">
                                            <select class="form-control select2" readonly style="width: 100%;" name="get_technicianss" value="<?php echo $get_technician; ?>">
                                                <?php while ($get_tech = $get_all_tech_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                    <?php $selected = ($get_technician == $get_tech['technician']) ? 'selected' : ''; ?>
                                                    <option <?= $selected; ?> value="<?php echo $get_tech['firstname'] . ' ' . $get_tech['middlename'] . ' ' . $get_tech['lastname']; ?>">
                                                        <?php echo $get_tech['firstname'] . ' ' . $get_tech['middlename'] . ' ' . $get_tech['lastname']; ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                            <label>Diagnostics:</label>
                                        </div>
                                        <div class="col-md-7">
                                            <textarea rows="2" class="form-control" name="get_diagnostics" id="diagnostics" placeholder="Diagnostics" required><?php echo $get_diagss; ?></textarea>
                                        </div>
                                    </div><br>


                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                            <label>Action Taken:</label>
                                        </div>
                                        <div class="col-md-7">
                                            <textarea rows="2" class="form-control" name="get_action" id="get_action" placeholder="Action Taken" required><?php echo $action_taken; ?></textarea>
                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                            <label>Recommendation:</label>
                                        </div>
                                        <div class="col-md-7">
                                            <textarea rows="2" class="form-control" name="get_recommendation" id="get_recommendation" placeholder="Recommendation" required><?php echo $recommend; ?></textarea>
                                        </div>
                                    </div><br>


                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                            <label>Remarks:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" readonly class="form-control" name="get_otherItem" placeholder="Other Items" value="<?php echo $remarks; ?>" required>
                                        </div>
                                    </div><br>


                                    <input type="hidden" style="text-align:center; " readonly class="form-control" name="releasedDate" placeholder="Date" value="<?php echo $releaseddate; ?>" required>
                                    <input type="hidden" style="text-align:center; " readonly class="form-control" name="releasedTime" placeholder="Supplier Code" value="<?php echo $releasedtime; ?>" required>



                                    <div class="box-footer" align="center">
                                        <!-- <button type="button" <?php echo $btnEdit; ?> name="edit" id="btnEdit" class="btn btn-info">
                                            <i class="fa fa-edit fa-fw"> </i> </button>
                                        <button type="submit" <?php echo $btnSave; ?> name="update_repair" id="btnSave" class="btn btn-success">
                                            <i class="fa fa-check fa-fw"> </i> </button> -->
                                        <a href="list_released ">
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
    <!-- Morris.js charts -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script> -->
    <!-- <script src="../plugins/morris/morris.min.js"></script> -->
    <!-- Sparkline -->
    <!-- <script src="../plugins/sparkline/jquery.sparkline.min.js"></script> -->
    <!-- jvectormap -->
    <!-- <script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script> -->
    <!-- <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script> -->
    <!-- jQuery Knob Chart -->
    <!-- <script src="../plugins/knob/jquery.knob.js"></script> -->
    <!-- daterangepicker -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script> -->
    <!-- <script src="../plugins/daterangepicker/daterangepicker.js"></script> -->
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
    <!-- Page script -->

    <script>
        $('.select2').select2();

        $("#btnSave").attr("disabled", true);
        $(".select2").attr("disabled", true);

        $("#diagnostics").attr("disabled", true);
        $("#get_action").attr("disabled", true);
        $("#get_recommendation").attr("disabled", true);

        $(document).ready(function() {
            $('#btnEdit').click(function() {
                $("input[name='get_otherItem']").removeAttr("readonly");
                $("input[name='get_receivedFrom']").removeAttr("readonly");

                $("#diagnostics").attr("disabled", false);
                $("#get_action").attr("disabled", false);
                $("#get_recommendation").attr("disabled", false);
                $(".select2").attr("disabled", false);
                $("#btnSave").attr("disabled", false);
                $("#btnEdit").attr("disabled", true);
            });
        });


        $(document).ready(function() {
            $('#print').click(function() {
                var objidno = $('#objid').val();
                console.log(objidno);

                $('#printlink').attr("href", "../plugins/jasperreport/tsr.php?objidno=" + objidno, '_parent');
            })
        });
    </script>


</body>

</html>