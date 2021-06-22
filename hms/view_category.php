<?php


session_start();

if (!isset($_SESSION['id'])) {
    header('location:../index.php');
}


include('../config/db_config.php');
include('sql_querries.php');

$user_id = $_SESSION['id'];

$btnSave = $btnEdit = $get_idno = $get_code = $get_categ = $alert_msg = '';

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

    $get_sql = "SELECT * FROM tbl_itemcateg WHERE idno = :id";
    $get_data = $con->prepare($get_sql);
    $get_data->execute([':id' => $user_id]);
    while ($result = $get_data->fetch(PDO::FETCH_ASSOC)) {
        $get_idno = $result['idno'];
        $get_code = $result['code'];
        $get_categ = $result['itemcategory'];
    }
}


$get_all_category_sql = "SELECT * FROM tbl_itemcateg where status = 'Active' ";
$get_all_category_data = $con->prepare($get_all_category_sql);
$get_all_category_data->execute(); 


$get_all_unit_sql = "SELECT * FROM tbl_itemunit where status = 'Active' ";
$get_all_unit_data = $con->prepare($get_all_unit_sql);
$get_all_unit_data->execute(); 


?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>HM SYSTEM  | Update Item Category</title>
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

                <section class="content col-md-10"  >
                    <div class="card card-dark">
                        <div class="card-header" align="left">
                            <h4>Update Item Category</h4>
                        </div>
                        <div class="card-body" align="left">
                            <div class="box box-primary">
                                <form role="form" method="post" >
                                    <div class="box-body">
                                        


                                        <div class="row">
                                            <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                                <label>ID No:</label>
                                            </div>
                                            <div class="col-md-7">
                                                <input type="text" readonly  class="form-control" id="idno" name="idno"  placeholder="Item Code" value="<?php echo $get_idno; ?>" required>
                                            </div>
                                        </div><br>

                                        <div class="row">
                                            <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                                <label>Code:</label>
                                            </div>
                                            <div class="col-md-7">
                                                <input type="text" readonly  onkeyup="this.value = this.value.toUpperCase();" class="form-control" id="itemcode" name="itemcode"  placeholder="Item Code" value="<?php echo $get_code; ?>" required>
                                            </div>
                                        </div><br>

                                        <div class="row">
                                            <div class="col-md-3" style="text-align: right;padding-top: 5px;">
                                                <label>Category:</label>
                                            </div>
                                            <div class="col-md-7">
                                            <input type="text" readonly  onkeyup="this.value = this.value.toUpperCase();" class="form-control" id="itemcateg" name="itemcateg"  placeholder="Item Category" value="<?php echo $get_categ; ?>" required>
                                              
                                            </div>
                                        </div><br>

                                        <div class="box-footer" align="center">
                                            <button type="button" <?php echo $btnEdit; ?> name="edit" id="btnEdit" class="btn btn-info">
                                                <i class="fa fa-edit fa-fw"> </i> </button>
                                            <button type="submit" <?php echo $btnSave; ?> name="update_category" id="btnSave" class="btn btn-success">
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
        // $(".select2").attr("disabled", true);

        $(document).ready(function() {
            $('#btnEdit').click(function() {
                $("input[name='itemcode']").removeAttr("readonly");
                $("input[name='itemcateg']").removeAttr("readonly");
                // $(".select2").attr("disabled", false);
                $("#btnSave").attr("disabled", false);
                $("#btnEdit").attr("disabled", true);
            });
        });




    </script>


</body>

</html>