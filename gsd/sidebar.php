<?php



include('../config/db_config.php');

$user_id = $_SESSION['id'];
$docno = '';


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



// $get_all_document_sql = "SELECT * FROM tbl_ledger";
// $get_all_document_data = $con->prepare($get_all_document_sql);
// $get_all_document_data->execute();  

//count incoming documents
$get_noofdocs_sql = "SELECT COUNT(`docno`) as total FROM `tbl_documents` WHERE status in ('CREATED','FORWARDED') and destination = '$department'";
$get_noofdocs_data = $con->prepare($get_noofdocs_sql);
$get_noofdocs_data->execute();
$get_noofdocs_data->setFetchMode(PDO::FETCH_ASSOC);
while ($result1 = $get_noofdocs_data->fetch(PDO::FETCH_ASSOC)) {
  $incoming_count =  $result1['total'];
}

//count incoming documents
$get_noofdocs_sql = "SELECT COUNT(`docno`) as total FROM `tbl_documents` WHERE status in ('CREATED','FORWARDED') and destination = '$department'";
$get_noofdocs_data = $con->prepare($get_noofdocs_sql);
$get_noofdocs_data->execute();
$get_noofdocs_data->setFetchMode(PDO::FETCH_ASSOC);
while ($result1 = $get_noofdocs_data->fetch(PDO::FETCH_ASSOC)) {
  $incoming_count =  $result1['total'];
}


//count incoming documents
$get_noofdocs_sql = "SELECT COUNT(`docno`) as total FROM `tbl_documents` WHERE status = 'RECEIVED' and destination = '$department'";
$get_noofdocs_data = $con->prepare($get_noofdocs_sql);
$get_noofdocs_data->execute();
$get_noofdocs_data->setFetchMode(PDO::FETCH_ASSOC);
while ($result1 = $get_noofdocs_data->fetch(PDO::FETCH_ASSOC)) {
  $received_count =  $result1['total'];
}

$get_noofdocs_sql = "SELECT COUNT(`docno`) as total FROM `tbl_documents` where origin = '$department'";
$get_noofdocs_data = $con->prepare($get_noofdocs_sql);
$get_noofdocs_data->execute();
$get_noofdocs_data->setFetchMode(PDO::FETCH_ASSOC);
while ($result1 = $get_noofdocs_data->fetch(PDO::FETCH_ASSOC)) {
  $outgoing_count =  $result1['total'];
}

$get_noofdocs_sql = "SELECT COUNT(`docno`) as total FROM `tbl_documents` WHERE status = 'ARCHIVED' and destination = '$department'";
$get_noofdocs_data = $con->prepare($get_noofdocs_sql);
$get_noofdocs_data->execute();
$get_noofdocs_data->setFetchMode(PDO::FETCH_ASSOC);
while ($result1 = $get_noofdocs_data->fetch(PDO::FETCH_ASSOC)) {
  $archived_count =  $result1['total'];
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













?>

<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
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

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="../dist/img/scclogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
    <span class="brand-text font-weight-light">LGUSSC | DTS</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="../dist/img/logo.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="profile.php" class="d-block"><?php echo $db_first_name . " " . $db_middle_name . " " . $db_last_name ?> </a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

        <li class="nav-item">
          <a href="index.php" class="nav-link active">
            <i class="nav-icon fa fa-th"></i>
            <p>
              Dashboard
              <!-- <span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-dashboard"></i>
            <p>
              TRANSACTIONS
              <i class="right fa fa-angle-left"></i>
            </p>
          </a>

          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="add_outgoing.php" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Forward</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="receive_incoming_other.php" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Receive</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="release_document.php" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Release</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="archive_document.php" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Archive</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="track_documents.php" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Track Documents</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="force_receive.php" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Force Receive</p>
              </a>
            </li>
          </ul>
        </li>

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
              <a href="list_joborder.php" class="nav-link">
                <i class="fa fa-share nav-icon fa-rotate-180 fa-flip-vertical"></i>
                <p>Job Orders</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="list_suppliers.php" class="nav-link">
                <i class="fa fa-share nav-icon fa-rotate-180 fa-flip-vertical"></i>
                <p>Suppliers</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="list_document_type.php" class="nav-link">
                <i class="fa fa-share nav-icon fa-rotate-180 fa-flip-vertical"></i>
                <p>Document Types</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="list_department.php" class="nav-link">
                <i class="fa fa-share nav-icon fa-rotate-180 fa-flip-vertical"></i>
                <p>Departments</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="list_users.php" class="nav-link">
                <i class="fa fa-share nav-icon fa-rotate-180 fa-flip-vertical"></i>
                <p>Users</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="list_employee.php" class="nav-link">
                <i class="fa fa-share nav-icon fa-rotate-180 fa-flip-vertical"></i>
                <p>Employee</p>
              </a>
            </li>
          </ul>
        </li>

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
              <a href="receiving_copy.php" class="nav-link">
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
        </li>



        <li class="nav-item has-treeview">
          <a href="#" class="nav-link ">
            <i class="nav-icon fa fa-dashboard"></i>
            <p>
              SYTEM
              <i class="right fa fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../lockscreen.php" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>LOCK</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="../logout.php" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>SIGN OUT</p>
              </a>
            </li>
          </ul>
        </li>

    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>