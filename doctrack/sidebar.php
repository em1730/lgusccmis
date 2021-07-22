<?php


include('../config/db_config.php');



$docno = '';
// include ('includes/head.php');

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






?>

<nav class="main-header navbar navbar-expand bg-success navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="send_email" class="nav-link">Contact</a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
            <a href="it_support" class="nav-link">IT Support</a>
        </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <form class="form-inline ml-3">
        <button class="btn btn-navbar" type="submit" data-role="scan_receive">
            <i class="fa fa-search"></i>
        </button>


    </form>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
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
                        <!-- Message Start -->



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
                        <!-- Message End -->
                    </a>

                <?php } ?>


                <!-- Message End -->
                </a>

                <div class="dropdown-divider"></div>
                <a href="mailbox.php" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li>
        <!-- Notifications Dropdown Menu -->
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
    <!-- Brand Logo -->




    <!-- <a href="index" class="brand-link">  
      <img src="../dist/img/scdrrmo_logo.png" class="img-circle elevation-2" width="40px">   
    </a> -->

    <!-- Sidebar -->

    <!-- Sidebar user panel (optional) -->
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
                    <a href="index.php" class="nav-link ">
                        <i class="nav-icon fa fa-th"></i>
                        <p>
                            Dashboard
                            <!-- <span class="right badge badge-danger">New</span> -->
                        </p>
                    </a>
                </li>








            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->



</aside>