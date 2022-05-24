<!-- navbar and sidebar -->
<style>
    .sign-out:hover {
        background-color: #DF3039;
    }


    .icons,
    #icons {
        color: black;
    }


    #label1::after {
        content: '';
        display: block;
        position: absolute;

        background-color: #9A1B21;
        width: 200px;
        height: 1px;


        /* bottom: -3px; */
    }

    .sidebar-link:hover {

        background-color: #F78186;
    }

    p {
        color: #B62229;
    }

    label {

        font-size: 16px;
        color: #B62229;

    }
</style>
<?php


include('../config/db_config.php');




// include ('../config/db_config.php');
// session_start();
$user_id = $_SESSION['id'];

if (!isset($_SESSION['id'])) {
    header('location:../index.php');
} else {
}


$db_first_name = $db_middle_name = $db_last_name = '';
//fetch user from database
$get_user_sql = "SELECT * FROM tbl_users where user_id = :id";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {

    $db_first_name = $result['first_name'];
    $db_middle_name = $result['middle_name'];
    $db_last_name = $result['last_name'];
}


?>

<nav class="main-header navbar navbar-expand bg-danger navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">HM SYSTEM</a>
        </li>


        <li class="nav-item">
            <a href="index.php" class="nav-link ">HOME PAGE</a>
        </li>





    </ul>

    <ul class="navbar-nav ml-auto">

        <!-- <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-comments"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="#" class="dropdown-item">


            <li class="nav-item" align="right">
                <a href="announcement" class="nav-link ">
                    ANNOUNCEMENTS
                </a>
            </li>




        </ul> -->
    </ul>



</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <div class="bg-danger" style="padding-top:4%;">

        <div class="sidebar">
            &nbsp; &nbsp; &nbsp; &nbsp;
            <img src="../dist/img/itcso logo.png" width="150px" height="80px">

            <label style="color:white" class="d-block">
                &nbsp; &nbsp; &nbsp; &nbsp;
                <?php echo $db_first_name . " " . $db_middle_name . " " . $db_last_name ?>

            </label>


        </div>

    </div>
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


                <div>
                    <label id="label1" style="font-size:18px; ">
                        &nbsp;
                        <i class="nav-icon fa fa-lock icons"></i>
                        &nbsp;
                        TRANSACTIONS
                    </label>

                    <li class="nav-item">
                        <a href="add_repair.php" class="nav-link sidebar-link">
                            &nbsp;
                            <i class="nav-icon fa fa-pencil-square-o icons"></i>
                            <p> &nbsp; New Record</p>
                        </a>
                    </li>
                </div><br>


                <div>
                    <label id="label1" style="font-size:18px; ">
                        &nbsp;
                        <i class="nav-icon fas fa-list icons"></i>
                        &nbsp;
                        MASTERLIST
                    </label>


                    <li class="nav-item">
                        <a href="list_technician.php" class="nav-link sidebar-link">
                            &nbsp;
                            <i class=" nav-icon fas fa-user-cog icons"></i>
                            <p> &nbsp; Technician</p>
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
                            <i class="nav-icon fas fa-pen icons"></i>
                            <!-- <i class="nav-icon fa fa-user-edit icons"></i> -->
                            <!-- <i class="fa fa-pencil-square-o "></i> -->
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
            </ul>
        </nav>

    </div>


</aside>