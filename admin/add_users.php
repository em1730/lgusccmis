<?php


session_start();

$first_name = $middle_name = $userpass = $location = $last_name = $email = $userpass = $status  = $contact_no = $username = $position = $account_type = $btnStatus = $department = $users_id = '';
$btnNew = 'disabled';

if (!isset($_SESSION['id'])) {
  header('location:../index');
}
$users_id = $_SESSION['id'];

include('../config/db_config.php');
// include('insert_users.php');

date_default_timezone_set('Asia/Manila');
$now = new DateTime();

$time = date("h:i:s a");
//select users
$get_users_sql = "SELECT * FROM tbl_users WHERE user_id = :user_id";
$users_data = $con->prepare($get_users_sql);
$users_data->execute([':user_id' => $users_id]);
while ($result = $users_data->fetch(PDO::FETCH_ASSOC)) {
  $users_id = $result['user_id'];
  $first_name = $result['first_name'];
  $middle_name = $result['middle_name'];
}

$get_all_department_sql = "SELECT * FROM tbl_department";
$get_all_department_data = $con->prepare($get_all_department_sql);
$get_all_department_data->execute();

$get_all_accounttype_sql = "SELECT * FROM tbl_accounttype";
$get_all_accounttype_data = $con->prepare($get_all_accounttype_sql);
$get_all_accounttype_data->execute();

$title = "LGUSCC MIS | New Users"
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title ?></title>
  <?php include('heading.php') ?>

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php include('sidebar.php') ?>

    <div class="content-wrapper">
      <div class="content-header"></div>


      <!-- Main content -->
      <section class="content">
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Add Users</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">

            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="<?php htmlspecialchars("PHP_SELF"); ?>">
              <div class="box-body">

                <div class="row">
                  <div class="col-md-1"></div>



                  <div class="col-md-3" style="text-align: left;padding-top: 5px;">
                    <label>Date Registered: </label>
                    <div class="input-group date" data-provide="datepicker">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" readonly class="form-control pull-right" style="width: 90%;" id="datepicker" name="date_register" placeholder="Date Process" value="<?php echo $now->format('Y-m-d'); ?>">
                    </div>
                  </div>
                  <div class="col-md-3" style="text-align: left;padding-top: 5px;">
                    <label>User ID:</label>
                    <input type="text" class="form-control" readonly name="time_reg" placeholder="Type N/A if not applicable" value="<?php echo $time; ?>">

                  </div>
                  <div class="col-md-3" style="text-align: left;padding-top: 5px;">
                    <label>User ID:</label>
                    <input type="text" class="form-control " name="user_id" placeholder="Type N/A if not applicable" value="">
                  </div>


                </div><br>

                <div class="row">
                  <div class="col-md-1"></div>

                  <div class="col-md-3 " style="text-align: left;padding-top: 5px;">
                    <label>First Name: </label>
                    <input type="text" class="form-control" name="first_name" placeholder="Firstname" value="">
                  </div>
                  <div class="col-md-3" style="text-align: left;padding-top: 5px;">
                    <label>Middle Name: </label>
                    <input type="text" class="form-control" name="middle_name" placeholder="Middlename" value="">
                  </div>
                  <div class="col-md-3" style="text-align: left;padding-top: 5px;">
                    <label>Last Name: </label>
                    <input type="text" class="form-control" name="last_name" placeholder="Lastname" value="">
                  </div>
                </div><br>


                <div class="row">
                  <div class="col-md-1"></div>
                  <div class="col-md-3" style="text-align: left; padding-top: 5px;">
                    <label>Contact Number: </label>
                    <input type="number" class="form-control" name="contact_no" placeholder="Contact Number" value="">
                  </div>
                  <div class="col-md-3" style="text-align: left; padding-top: 5px;">
                    <label>Position: </label>
                    <input type="text" class="form-control" name="position" placeholder="Position" value="">
                  </div>
                  <div class="col-md-3" style="text-align: left; padding-top: 5px;">
                    <label>Email: </label>
                    <input type="text" class="form-control" name="address" placeholder="Email" value="">
                  </div>
                </div><br>


                <div class="row">

                  <div class="col-md-1"></div>
                  <div class="col-md-3" style="text-align: left; padding-top: 5px;">
                    <label>Username: </label>
                    <input type="text" class="form-control" name="username" placeholder="Username" value="">
                  </div>
                  <div class="col-md-3" style="text-align: left; padding-top: 5px;">
                    <label>User Password: </label>
                    <input type="password" class="form-control" name="userpass" placeholder="User Password" value="">
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-1"></div>
                  <div class="col-md-3" style="text-align: left; padding-top: 5px;">
                    <label>Account Type: </label>
                    <select class="form-control select2" name="account_type">
                      <option value="">Select account </option>
                      <?php while ($get_account = $get_all_accounttype_data->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $get_account['idno']; ?>"><?php echo $get_account['account_type']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-3" style="text-align: left; padding-top: 5px;">

                  </div>

                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">

                  </div>
                  <div class="col-md-3">



                  </div>
                </div><br>



                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Department</label>


                  </div>
                  <div class="col-md-10">
                    <select class="form-control select2" style="width: 100%;" name="department" value="">
                      <option>Please select...</option>
                      <?php while ($get_dept = $get_all_department_data->fetch(PDO::FETCH_ASSOC)) { ?>
                        <?php $selected = ($get_department == $get_dept['objid']) ? 'selected' : ''; ?>
                        <option <?= $selected; ?> value="<?php echo $get_dept['objid']; ?>"><?php echo $get_dept['department']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div></br>


                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Location</label>
                  </div>
                  <div class="col-md-10">
                    <input type="text" class="form-control" name="location" placeholder="Location" value="" required>
                  </div>
                </div><br>


                <div class="box-footer" align="center">
                  <input type="submit" <?php echo $btnStatus; ?> name="inset_users.php" class="btn btn-success" value="Save">
        
                  <a href="list_users.php">
                    <input type="button" name="cancel" class="btn btn-danger" value="Cancel">
                  </a>
                </div>


                <!-- /.box-body -->
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
      </section>

      <br>
    </div>

    <?php include('footer.php') ?>



  </div>


  <?php include('scripts.php') ?>

  <script>
    $('#users').DataTable({
      'paging': true,
      'lengthChange': true,
      'searching': true,
      'ordering': true,
      'info': true,
      'autoWidth': true,
      'autoHeight': true
    });
    $('.select2').select2();
  </script>



</body>

</html>