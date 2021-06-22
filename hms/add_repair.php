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

date_default_timezone_set('Asia/Manila');
$now = date('Y-m-d ');
$time = date('H:i:s a');

$alert_msg = $othersItem = $btnEdit = $btnSave =
    $received = $diagnostics =  $description = ' ';

//select all data type
$get_all_requestedby_sql = "SELECT * FROM tbl_requestedby where status='Active'";
$get_all_requestedby_data = $con->prepare($get_all_requestedby_sql);
$get_all_requestedby_data->execute();

//select all departments
$get_all_departments_sql = "SELECT * FROM tbl_department";
$get_all_departments_data = $con->prepare($get_all_departments_sql);
$get_all_departments_data->execute();


$get_all_items_sql = "SELECT * FROM tbl_items";
$get_all_items_data = $con->prepare($get_all_items_sql);
$get_all_items_data->execute();



$get_all_tech_sql = "SELECT * FROM hms_technician";
$get_all_tech_data = $con->prepare($get_all_tech_sql);
$get_all_tech_data->execute();


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>HM SYSTEM | Add Hardware Repair</title>


    <?php include('heading.php') ?>

</head>


<body class="hold-transition sidebar-mini ">
    <div class="wrapper">

        <?php include('sidebar.php'); ?>
        <div class="content-wrapper" align="center">
            <div class="content-header"></div>

            <div class="topright col-md-3 ">
                <?php echo $alert_msg; ?>
            </div>
            <section class="content  col-md-10">
                <div class="card card-danger">
                    <div class="card-header" align="left">
                        <h4>Add Hardware Repair</h4>
                    </div>

                    <div class="card-body" align="left">
                        <div class="box box-primary">
                            <form role="form" method="POST" action="">
                                <div class="box-body">

                                    <?php echo $alert_msg; ?>

                                    <div class="row">
                                        <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                                            <label>Date:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" readonly class="form-control" name="repairDate" placeholder="Date" value="<?php echo $now; ?>" required>
                                        </div>
                                        <div class="col-md-1" style="text-align: right;padding-top: 5px;">
                                            <label>Time:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" readonly class="form-control" name="repairTime" placeholder="Supplier Code" value="<?php echo $time; ?>" required>
                                        </div>

                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                                            <label>Item Received:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <select class=" form-control select2" style="width: 100%;" name="itemrecieved" value="<?php echo $items; ?>">
                                                <option selected="selected">Please select...</option>
                                                <?php while ($get_items = $get_all_items_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                    <option value="<?php echo $get_items['itemname']; ?>">
                                                        <?php echo $get_items['itemname'];
                                                        echo " || ";
                                                        echo $get_items['specifications'];  ?>

                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>



                                        <div class="col-md-1" style="text-align: right;padding-top: 5px;">
                                            <label>Others:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" readonly class="form-control" name="others" placeholder="Other Items" value="<?php echo $othersItem; ?>" required>
                                        </div>
                                    </div><br>
                                    <div class="row">


                                        <div>



                                        </div>
                                    </div><br>

                                    <input type="hidden" readonly class="form-control" name="itemdescription" placeholder="Supplier Code" value="<?php echo $description; ?>" required>

                                    <div class="row">
                                        <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                                            <label>Department:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <select class=" form-control select2" id="requested" style="width: 100%;" name="department" value="<?php echo $department; ?>">
                                                <option selected="selected">Please select...</option>
                                                <?php while ($get_department = $get_all_departments_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                    <option value="<?php echo $get_department['objid']; ?>"> <?php echo $get_department['department']; ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                                            <label>Recieved From:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" readonly class="form-control" name="receivedFrom" placeholder="Received From" value="<?php echo $received; ?>" required>
                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                                            <label>Technician</label>
                                        </div>
                                        <div class="col-md-8">
                                            <select class=" form-control select2" id="technician" style="width: 100%;" name="technician" value="<?php echo $technician; ?>">
                                                <option selected="selected">Please select...</option>
                                                <?php while ($get_technician = $get_all_tech_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                    <option value="<?php echo $get_technician['firstname'];
                                                                    echo " ";
                                                                    echo $get_technician['middlename'];
                                                                    echo " ";
                                                                    echo $get_technician['lastname'];  ?>">
                                                        <?php echo $get_technician['firstname'];
                                                        echo " ";
                                                        echo $get_technician['middlename'];
                                                        echo " ";
                                                        echo $get_technician['lastname']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                                            <label>Diagnostics:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <textarea rows="2" class="form-control" name="diagnostics" id="diagnostics" placeholder="Diagnostics" required><?php echo $diagnostics; ?></textarea>
                                        </div>
                                    </div><br>

                                    <div class="box-footer" align="center">
                                        <button type="button" <?php echo $btnEdit; ?> name="edit" id="btnEdit" class="btn btn-info">
                                            <i class="fa fa-edit fa-fw"> </i> </button>
                                        <button type="submit" <?php echo $btnSave; ?> name="add_repair" id="btnSave" class="btn btn-success">
                                            <i class="fa fa-check fa-fw"> </i> </button>
                                        <a href="list_pending">
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

    <?php include('scripts.php'); ?>



    <script>
        $('.select2').select2();



        // $("#btnSave").attr("disabled", true);
        // $(".select2").attr("disabled", true);
        // $("#diagnostics").attr("disabled", true);

        // $(document).ready(function() {
        //     $('#btnEdit').click(function() {
        //         $("input[name='others']").removeAttr("readonly");
        //         $("input[name='receivedFrom']").removeAttr("readonly");

        //         $("#diagnostics").attr("disabled", false);
        //         $(".select2").attr("disabled", false);

        //         $("#btnSave").attr("disabled", false);
        //         $("#btnEdit").attr("disabled", true);
        //     });
        // });
    </script>

</body>

</html>