<?php


include('../config/db_config.php');

$docno = '';
// include ('includes/head.php');
$user_id = $_SESSION['id'];

if (!isset($_SESSION['id'])) {
    header('location:../index.php');
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
    label {

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

    #label1::after {
        content: '';
        display: block;
        position: absolute;

        background-color: black;
        width: 200px;
        height: 1px;


        /* bottom: -3px; */
    }
</style>

<nav class="main-header navbar navbar-expand bg-success navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
            <a href="index.php" class="nav-link "> Dashboard </a>
        </li>
  
        <li class="nav-item d-none d-sm-inline-block">
            <a href="send_email.php" class="nav-link">Contact </a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
            <a href="it_support.php" class="nav-link">IT Support</a>
        </li>
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown">
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
        </li>

        <li class="nav-item dropdown">
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
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i class="fa fa-th-large"></i></a>
        </li>
    </ul>



</nav>
<aside class="main-sidebar sidebar-light-primary elevation-4">

    <div class="greenBG">

        <div class="sidebar bg-success">
            <br>
            <img src="../dist/img/scclogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-4">
            <span class="brand-text font-weight-bold" style="font-size: 20px;">LGUSSC | DTS</span>


            <br>
            <label style="color:white">
                <br>
                &nbsp; &nbsp;&nbsp;
                <?php echo strtoupper($db_first_name . ' ' . $db_middle_name . ' ' . $db_last_name) ?>

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



                <li class="nav-item">

                </li>
                <div>

                    <label id="label1" style="font-size:18px; ">
                        &nbsp;
                        <i class="nav-icon fa fa-info-circle icons"></i>
                        &nbsp;
                        TRANSACTION
                    </label>

                    <li class="nav-item">
                        <a href="add_outgoing.php" class="nav-link sidebar-link">
                            &nbsp;
                            <i class="nav-icon fa fa-question icons"></i>
                            <p> &nbsp; Forward</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="release_document.php" class="nav-link sidebar-link">
                            &nbsp;
                            <i class="nav-icon fa fa-question icons"></i>
                            <p> &nbsp; Release</p>
                        </a>
                    </li>

                    <li class="nav-item">

                        <a href="archive_document.php" class="nav-link sidebar-link">
                            &nbsp;
                            <i class="nav-icon fa fa-question icons"></i>
                            <p> &nbsp; Archive</p>
                        </a>
                    </li>




                </div><br>


                <div>

                    <label id="label1" style="font-size:18px; ">
                        &nbsp;
                        <i class="nav-icon fa fa-info-circle icons"></i>
                        &nbsp;
                        ABOUT US
                    </label>


                    <li class="nav-item">
                        <a href="information" class="nav-link sidebar-link">
                            &nbsp;
                            <i class="nav-icon fa fa-question icons"></i>
                            <p> &nbsp; Information</p>
                        </a>
                    </li>




                </div> <br>

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
                        <a href="../index" class="nav-link  sidebar-link">
                            &nbsp;
                            <i class="fa fa-sign-out nav-icon icons"></i>
                            <p> &nbsp; Sign Out</p>
                        </a>
                    </li>



                </div><br>

                <!-- <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-dashboard"></i>
                        <p>
                            TRANSACTIONS
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="add_outgoing" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Forward</p>
                            </a>
                        </li>
                     
                        <li class="nav-item">
                            <a href="release_document" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Release</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="archive_document" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Archive</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="track_documents" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Track Documents</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="force_receive" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Force Receive</p>
                            </a>
                        </li>
                    </ul>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-dashboard"></i>
                        <p>
                            MASTER LISTS
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="list_joborder" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Job Orders</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="list_suppliers" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Suppliers</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="list_document_type" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Document Types</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="list_department" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Departments</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="list_document_type" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                    </ul>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fa fa-dashboard"></i>
                        <p>
                            REPORTS
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="receiving_copy" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Receiving Copy</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#myModal" data-toggle="modal" data-target="#myModal" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Routing Slip</p>
                            </a>
                        </li>
                    </ul>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fa fa-dashboard"></i>
                        <p>
                            SETTINGS
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="add_document" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Add Document Type</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="add_department" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Add Department</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="add_user " class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Add User</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="add_suppliers " class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Add Suppliers</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="add_regular " class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Add Regular Employee</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="add_joborder " class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Add Job Order</p>
                            </a>
                        </li>


                    </ul> -->









            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->



</aside>