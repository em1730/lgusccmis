<?php


include('../config/db_config.php');

$docno = '';
// include ('includes/head.php');
$user_id = $_SESSION['id'];

if (!isset($_SESSION['id'])) {
    header('location:../login.php');
} else {
}

//fetch user from database
$get_user_sql = "SELECT * FROM tbl_users where user_id = :id";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {


    $db_first_name = $result['first_name'];
    $db_middle_name = $result['middle_name'];
    $db_last_name = $result['last_name'];
    $db_email_ad = $result['email'];
    $db_contact_number = $result['contact_no'];
    $db_user_name = $result['username'];
    $department = $result['department'];
}



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
                <div class="form-group" <?php if ($department != 'CBO') { ?> style="display:none" <?php } ?>>
                    <h6 class="modal-title">Update OBR No:</h6>
                    <input type="text" name="update_obr" id="update_obr" class="form-control" value="<?php echo
                                                                                                        $settings_obr; ?>" required>
                </div>

                <div class="box-body">
                    <div class="form-group" <?php if ($department != 'ACCTG') { ?> style="display:none" <?php } ?>>
                        <h6 class="modal-title">Update DV No:</h6>
                        <input type="text" name="update_dv" id="update_dv" class="form-control" value="<?php echo
                                                                                                        $settings_dv; ?>" required>
                    </div>



                </div>
            </div>
        </div>
    </aside>



    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <!-- <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-comments-o"></i>
                <?php if ($message_count != 0) { ?>
                    <span class="badge badge-danger navbar-badge"><?php echo $message_count ?> </span>
                <?php } ?>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <?php while ($messages_data = $get_all_messages_data->fetch(PDO::FETCH_ASSOC)) { ?>
                    <a href="read-mail.php?objid=<?php echo $messages_data['objid']; ?>" class="dropdown-item">




                        <div class="media">
                            <img src="../dist/img/logo.png" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    <?php echo $messages_data['sender']; ?>
                                    <span class="float-right text-sm text-danger"><i class="fa fa-star"></i></span>
                                </h3>
                                <p class="text-sm"> <?php echo $messages_data['subject']; ?></p>
                                <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> <?php echo $messages_data['date']; ?></p>
                            </div>
                        </div>

                    </a>

                <?php } ?>



                </a>

                <div class="dropdown-divider"></div>
                <a href="mailbox.php" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li> -->

        <!-- <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-bell-o"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fa fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fa fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fa fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li> -->
        <!-- <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i class="fa fa-th-large"></i></a>
        </li> -->
    </ul>



</nav>
<aside class="main-sidebar sidebar-light-primary elevation-4">

    <div class="greenBG">

        <div class="sidebar bg-success">
            <br>
            <img src="../dist/img/scclogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-4">
            <span class="brand-text font-weight-bold" style="font-size: 18px;">LGUSCCMIS | DTS</span>


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
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <div>
                    <!-- <br> -->

                    <label id="label1" style="font-size:18px; ">
                        &nbsp;
                        <!-- <i class="nav-icon fa fa-info-circle icons"></i> -->
                        <i class="fa fa-tasks nav-icon icons"></i>
                        &nbsp;
                        TRANSACTION
                    </label>


                    <!-- <li class="nav-item">
                        <a href="index.php" class="nav-link sidebar-link">
                            &nbsp;
                            <i class="fa fa-home nav-icon icons"></i>
                            <p> &nbsp; Dashboard</p>
                        </a>
                    </li> -->


                    <li class="nav-item">
                        <a href="list_outgoing.php" class="nav-link sidebar-link">
                            &nbsp;
                            <!-- <i class="fas fa-level-up-alt nav-icon icons  fa-rotate-90"></i> -->
                            <!-- <i class="nav-icon fa fa-question icons"></i> -->
                            <i class="fa fa-share  nav-icon icons  fa-rotate-horizontal-180"></i>
                            <p> &nbsp; Forward</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="receive_incoming_other.php" class="nav-link sidebar-link">
                            &nbsp;

                            <!-- <i class="fas fa-level-up-alt nav-icon icons  fa-rotate-90"></i> -->
                            <i class="fa fa-arrow-right nav-icon icons"></i>
                            <p> &nbsp; Receive</p>
                        </a>
                    </li>



                    <li class="nav-item">
                        <a href="release_document.php" class="nav-link sidebar-link">
                            &nbsp;

                            <!-- <i class="fas fa-level-up-alt nav-icon icons  fa-rotate-90"></i> -->
                            <i class="fa fa-arrow-right nav-icon icons"></i>
                            <p> &nbsp; Release</p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="track_documents.php" class="nav-link sidebar-link">
                            &nbsp;
                            <!-- <i class="fas fa-level-up-alt nav-icon icons  fa-rotate-90"></i> -->
                            <i class="fa fa-search nav-icon icons"></i>
                            <p> &nbsp; Track Documents</p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="force_receive.php" class="nav-link sidebar-link">
                            &nbsp;
                            <!-- <i class="fas fa-level-up-alt nav-icon icons  fa-rotate-90"></i> -->
                            <!-- <i class="fas fa-search nav-icon icons"></i> -->
                            <i class="fa fa-share-square nav-icon icons  fa-flip-horizontal"></i>
                            <p> &nbsp; Force Receive</p>
                        </a>
                    </li>




                </div><br>


                <div>
                    <label id="label1" style="font-size:18px; ">
                        &nbsp;
                        <!-- <i class="nav-icon fa fa-info-circle icons"></i> -->
                        <!-- <i class="fas fa-tasks nav-icon icons"></i> -->
                        <i class="fa fa-folder-open nav-icon icons"></i>
                        &nbsp;
                        MASTERLIST
                    </label>


                    <li class="nav-item">
                        <a href="list_document_type.php" class="nav-link sidebar-link">
                            &nbsp;
                            <!-- <i class="nav-icon fa fa-question icons"></i> -->
                            <i class="nav-icon fas fa-file-invoice icons"></i>
                            <p> &nbsp; Document Type</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="list_suppliers.php" class="nav-link sidebar-link">
                            &nbsp;
                            <i class="nav-icon fas fa-truck-loading icons"></i>
                            <!-- <i class="nav-icon fa fa-question icons"></i> -->
                            <p> &nbsp; Supplier</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="list_joborder.php" class="nav-link sidebar-link">
                            &nbsp;
                            <i class="nav-icon fas fa-user-friends icons"></i>
                            <p> &nbsp; Job Order</p>
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
                        <a href="edit_profile" class="nav-link sidebar-link">
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