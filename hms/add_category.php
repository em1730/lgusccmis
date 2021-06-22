<?php


session_start();

if (!isset($_SESSION['id'])) {
    header('location:../index.php');
}

$btnSave = $btnNew = $btnEdit =  $alert_msg = $itemcode = $category='';

// $btnSave = 'disabled';
include('../config/db_config.php');
include('sql_querries.php');

$user_id = $_SESSION['id'];

$get_user_sql = "SELECT * FROM tbl_users WHERE user_id = :id";
$get_user_data = $con->prepare($get_user_sql);
$get_user_data->execute([':id' => $user_id]);
while ($result = $get_user_data->fetch(PDO::FETCH_ASSOC)) {
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
    <title>HM SYSTEM | Add Item Category</title>
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
                        <h4> Add Item Category</h4>
                    </div>
                    <div class="card-body" align="left">
                        <div class="box box-primary">
                            <form role="form" method="post">
                                <div class="box-body">
                             

                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                            <label>Item Code:</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" readonly onkeyup="this.value = this.value.toUpperCase();" class="form-control" id="itemcode" name="itemcode" placeholder="Item Code" value="<?php echo $itemcode; ?>" required>
                                        </div>
                                    </div><br>


                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                            <label>Category:</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" onkeyup="this.value = this.value.toUpperCase();" readonly id="itemcategory" class="form-control" name="itemcategory" placeholder="Item Category" value="<?php echo $category; ?>" required>
                                        </div>
                                    </div><br>

                                    <div class="box-footer" align="center">
                                        <button type="button" <?php echo $btnEdit; ?> name="edit" id="btnEdit" class="btn btn-info">
                                            <i class="fa fa-edit fa-fw"> </i> </button>
                                        <button type="submit" <?php echo $btnSave; ?> name="add_category" id="btnSave" class="btn btn-success">
                                            <i class="fa fa-check fa-fw"> </i> </button>
                                        <a href="list_category">
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
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- datepicker -->
    <script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- CK Editor -->
    <script src="../../plugins/ckeditor/ckeditor.js"></script>
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
    <!-- textarea wysihtml style -->
    <script>
        $('.select2').select2();



        $("#btnSave").attr("disabled", true);
        // $(".select2").attr("disabled", true);

        $(document).ready(function() {
            $('#btnEdit').click(function() {
                $("input[name='itemcategory']").removeAttr("readonly");
                $("input[name='itemcode']").removeAttr("readonly");
                // $(".select2").attr("disabled", false);
                $("#btnSave").attr("disabled", false);
                $("#btnEdit").attr("disabled", true);
            });
        });
    </script>


</body>

</html>