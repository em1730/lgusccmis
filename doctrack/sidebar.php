<?php

include('../config/db_config.php');
//user-account details
include('user_account.php');

$docno = '';
// include ('includes/head.php');



// count new messages
$get_all_message_sql = "SELECT count(*) as total FROM tbl_message where receiver = $user_id and status = 'PENDING'";
$get_all_message_data = $con->prepare($get_all_message_sql);
$get_all_message_data->execute();
while ($result1 = $get_all_message_data->fetch(PDO::FETCH_ASSOC)) {
    $message_count =  $result1['total'];
}

// //select all messages for notification
$get_all_messages_sql = "SELECT * FROM tbl_message where (receiver = $user_id or receiver = '0') and status = 'PENDING' ";
$get_all_messages_data = $con->prepare($get_all_messages_sql);
$get_all_messages_data->execute();

// //select all messages for email
$get_all_messages1_sql = "SELECT * FROM tbl_message where receiver = $user_id or receiver ='0'";
$get_all_messages1_data = $con->prepare($get_all_messages1_sql);
$get_all_messages1_data->execute();

//select all from settings
$get_all_settings_sql = "SELECT * FROM tbl_settings";
$get_all_settings_data = $con->prepare($get_all_settings_sql);
$get_all_settings_data->execute();
$get_all_settings_data->setFetchMode(PDO::FETCH_ASSOC);
while ($result = $get_all_settings_data->fetch(PDO::FETCH_ASSOC)) {
    $settings_obr =  $result['obrno'];
    $settings_dv = $result['dvno'];
}














?>
<style>
    label,
    label2 {

        font-size: 16px;
        color: green;

    }

    .fas,
    .icons,
    #icons {
        color: black;
    }




    p {
        color: green;
    }

    .sidebar-link:hover,
    #lightgreen:hover {

        background-color: lightgreen;
    }


    /* .top-link{

  } */
    .top-link:hover {
        background-color: green;
        color: black;
    }

    #label1::after,
    .label3::before,
    .label3::after {
        content: '';
        display: block;
        position: absolute;

        background-color: black;
        width: 200px;
        height: 1px;


        /* bottom: -3px; */
    }

    /* i {
        margin-left: 10px;
        font-size: 20px;
        height: 30px;
        vertical-align: middle;
    } */
</style>

<nav class="main-header navbar navbar-expand bg-success navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
            <a href="index.php" class="nav-link">Dashboard </a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
            <a href="send_email.php" class="nav-link">Contact </a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
            <a href="it_support.php" class="nav-link">IT Support</a>
        </li>
    </ul>


    <aside class="control-sidebar control-sidebar-dark">
        <div class="modal-header">
            <h4 class="modal-title">SETTINGS</h4>
        </div>

        <div class="modal-body">

            <div class="box-body">
                <div class="form-group" <?php if ($db_department != 'CBO') { ?> style="display:none" <?php } ?>>
                    <h6 class="modal-title">Update OBR No:</h6>
                    <input type="text" name="update_obr" id="update_obr" class="form-control" value="<?php echo $settings_obr; ?>" required>
                </div>

                <div class="box-body">
                    <div class="form-group" <?php if ($db_department != 'ACCTG') { ?> style="display:none" <?php } ?>>
                        <h6 class="modal-title">Update DV No:</h6>
                        <input type="text" name="update_dv" id="update_dv" class="form-control" value="<?php echo $settings_dv; ?>" required>
                    </div>



                </div>
            </div>
        </div>
    </aside>



    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

       
    </ul>



</nav>
<aside class="main-sidebar sidebar-light-primary elevation-4">

    <div class="greenBG">

        <div class="sidebar bg-success">
            <br>
            <img src="../dist/img/scclogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-4">
            <span class="brand-text font-weight-bold" style="font-size: 18px;"> DOCTRACK </span>


            <br>
            <label style="color:white">
                <br>
                &nbsp; &nbsp;&nbsp;
                <?php echo strtoupper($db_first_name . ' ' . $db_middle_name . '. ' . $db_last_name) ?>

            </label>
            <br>



        </div>

    </div>


    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <div>
        

                    <label id="label1" style="font-size:18px; ">

                        <i class="fa fa-tasks nav-icon icons"></i>
                        &nbsp;
                        TRANSACTION
                    </label>



                    <li class="nav-item">
                        <a href="list_outgoing.php" class="nav-link sidebar-link">
                            &nbsp;
                            <i class="fa fa-share  nav-icon icons  fa-rotate-horizontal-180"></i>
                            <p> &nbsp; Forward</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="receive_incoming_other.php" class="nav-link sidebar-link">
                            &nbsp;
                            <i class="fa fa-arrow-right nav-icon icons"></i>
                            <p> &nbsp; Receive</p>
                        </a>
                    </li>



                    <li class="nav-item">
                        <a href="release_document.php" class="nav-link sidebar-link">
                            &nbsp;
                            <i class="fa fa-arrow-right nav-icon icons"></i>
                            <p> &nbsp; Release</p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="track_documents.php" class="nav-link sidebar-link">
                            &nbsp;
                            <i class="fa fa-search nav-icon icons"></i>
                            <p> &nbsp; Track Documents</p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="force_receive.php" class="nav-link sidebar-link">
                            &nbsp;
                            <i class="fa fa-share-square nav-icon icons  fa-flip-horizontal"></i>
                            <p> &nbsp; Force Receive</p>
                        </a>
                    </li>




                </div><br>


                <div>
                    <label id="label1" style="font-size:18px; ">
                        &nbsp;
                        <i class="fa fa-folder-open nav-icon icons"></i>
                        &nbsp;
                        MASTERLIST
                    </label>




                    <li class="nav-item">
                        <a href="list_suppliers.php" class="nav-link sidebar-link">
                            &nbsp;
                            <i class="nav-icon fas fa-truck-loading icons"></i>
                            <p> &nbsp; Supplier</p>
                        </a>
                    </li>



                </div><br>




                <div>

                    <label id="label1" style="font-size:18px; ">
                        &nbsp;
                        <i class="nav-icon fa fa-lock icons"></i>
                        &nbsp;
                        ACCOUNT
                    </label>



                    <li class="nav-item">
                        <a href="edit_profile.php" class="nav-link sidebar-link">
                            &nbsp;
                            <i class="nav-icon fa fa-pencil-square-o icons"></i>
                            <p> &nbsp; Edit Profile</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="../login.php" class="nav-link  sidebar-link">
                            &nbsp;
                            <i class="fa fa-sign-out nav-icon icons"></i>
                            <p> &nbsp; Sign Out</p>
                        </a>
                    </li>



                </div><br>


                <br><br><br><br>










            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->



</aside>