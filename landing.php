<?php
include('config/db_config.php');
//variable declaration
$alert_msg = '';
//sign in button
if (isset($_POST['signin'])) {
  //to check if data are passed
  // echo "<pre>";
  //     print_r($_POST);
  // echo "</pre>";

  $username = $_POST['username'];
  $password = $_POST['password'];

  $check_username_sql = "SELECT * FROM tbl_users where username = :uname";

  $username_data = $con->prepare($check_username_sql);
  $username_data->execute([
    ':uname' => $username
  ]);
  if ($username_data->rowCount() > 0) {
    while ($result = $username_data->fetch(PDO::FETCH_ASSOC)) {

      //from database already hash
      $hash_password = $result['userpass'];

      //hash the $u_pass and compared to $hashed_password
      if (password_verify($password, $hash_password)) {
        session_start();
        $_SESSION['id'] = $result['user_id'];

        if ($result['account_type'] == 5) {
          header('location: administrator'); //location is folder || IT ADMIN 
        } else if ($result['account_type'] == 1) {
          header('location: doctrack'); //location is folder || DOCUMENT TRACKING
        } else if ($result['account_type'] == 2) {
          header('location: sp'); //location is folder || SP SYSTEM
        } else if ($result['account_type'] == 4) {
          header('location: hms'); //location is folder || HARDWARE MONITORING SYSTEM
        }
      } else {
        //echo "Password does not match!";
        $alert_msg .= ' 
                <div class="new-alert new-alert-warning alert-dismissible">
                    <i class="icon fa fa-warning"></i>
                    Incomplete Details!
                </div>     
            ';
      }
    }
  } else {
    $alert_msg .= ' 
          <div class="new-alert new-alert-warning alert-dismissible">
              <i class="icon fa fa-warning"></i>
              Username does not exist!
          </div>     
      ';
  }
}



?>




<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LGUSCC MIS | Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="../dist/css/ionicons.min.css"> -->
  <!-- Theme style -->
  <!-- <link rel="stylesheet" href="dist/css/adminlte.min.css"> -->
  <!-- iCheck -->
  <!-- <link rel="stylesheet" href="plugins/iCheck/flat/blue.css"> -->
  <!-- Morris chart
  <link rel="stylesheet" href="../plugins/morris/morris.css">
  jvectormap -->
  <!-- <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css"> -->
  <!-- Date Picker -->
  <!-- <link rel="stylesheet" href="plugins/datepicker/datepicker3.css"> -->
  <!-- Daterange picker
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css"> -->
  <!-- bootstrap wysihtml5 - text editor -->
  <!-- <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"> -->
  <!-- Google Font: Source Sans Pro -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
  <!-- DataTables -->
  <!-- <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap4.css"> -->
  <script src="plugins/font-awesome/629c6e6cbc.js" crossorigin="anonymous"></script>


  <style>
    body,
    html {
      height: 100%;
    }

    .bg-img {
      background-image: url('dist/img/editedddd.jpg');
      /* background-color: #cccccc; */
      /* Full height */
      height: 100%;

      /* Center and scale the image nicely */
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }
  </style>
</head>

<body class="hold-transition  bg-img ">


  <div class="card">



  </div>

  <div class="login-box" style="padding-top: 10%; padding-left: 35%; width:60%">

    <div class="login-box-body bg-success">
      <h3>Login</h3>
      <!-- <p class="login-box-msg"></p> -->

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="form-group has-feedback">

          <?php echo $alert_msg; ?>
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text bg-success"><i class="fas fa-user"></i></span>
          </div>
          <input type="text" class="form-control" name="username" placeholder="Username">
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text bg-success"><i class="fas fa-lock"></i></span>
          </div>
          <input type="password" class="form-control" name="password" placeholder="Password">

        </div>





        <div class="row">

          <div class="col-md-12">
            <input type="submit" class="btn btn-success btn-outline-light pull-right" name="signin" value="Sign In">
          </div>

        </div>
      </form>
    </div>
  </div>


  <!-- /.login-box -->



  <!-- jQuery 3 -->
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>