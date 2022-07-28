<?php
include('config/db_config.php');

//variable declaration

$alert_msg = '';

//sign in button

if (isset($_POST['signin'])) {

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


        header('location: homescreen.php');

        // if ($result['account_type'] == 1) {
        //   header('location: admin');
        // } else if ($result['account_type'] == 2) {
        //   header('location: doctrack'); 
        // } else if ($result['account_type'] == 3) {
        //   header('location: sp'); 
        // } else if ($result['account_type'] == 4) {
        //   header('location: hms'); 
        // }
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

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
  <!-- Date Picker -->
  <!-- <link rel="stylesheet" href="plugins/datepicker/datepicker3.css"> -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="styles/form-style.css">

  <style>
    body,
    html {
      height: 100%;
      margin: 0;
      font-family: Arial, Helvetica, sans-serif;
    }

    * {
      box-sizing: border-box;
    }

    .bg-image {
      /* The image used */
      background-image: url("Capture.png");

      /* Add the blur effect */
      filter: blur(5px);
      -webkit-filter: blur(5px);

      /* Full height */
      height: 100%;

      /* Center and scale the image nicely */
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }

    /* Position text in the middle of the page/image */

    .login-box {
      width: 320px;
      height: 450px;
      background: rgba(0, 0, 0, 0.6);
      color: #fff;
      top: 50%;
      left: 50%;
      position: absolute;
      transform: translate(-50%, -50%);
      box-sizing: border-box;
      padding: 70px 30px;
    }

    .avatar {
      width: 100px;
      height: 100px;
      border-radius: 100%;
      position: absolute;
      top: -50px;
      left: 35%;
    }

    .login-box p {
      margin: 0;
      padding: 0;
      font-weight: bold;
    }

    .login-box input {
      width: 100%;
      margin-bottom: 20px;
    }

    .login-box input[type="text"],
    input[type="password"] {
      border: none;
      border-bottom: 1px solid #fff;
      background: transparent;
      outline: none;
      height: 40px;
      color: #fff;
      font-size: 16px;
    }

    .login-box a {
      text-decoration: none;
      font-size: 14px;
      color: #fff;
    }

    .login-box a:hover {
      color: #39dc79;
    }
  </style>

  <title>LGUSCC MIS | Login</title>
</head>

<body>
  <div class="bg-image"></div>

  <div class="login-box fadeIn second">

    <img src="dist/img/logo.png" class="avatar">

    <h1 style="color:white;  font-size: 28px;"> Login Here </h1>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
      <div style="color: #da5a5a; text-align: center" class="form-group has-feedback fadeIn third">
        <?php echo $alert_msg; ?>
      </div>
      <br>
      <p>Username</p>
      <input type="text" class="fadeIn second" name="username" placeholder="Enter Username" autofocus require>
      <br>
      <p>Password</p>
      <input type="password" class="fadeIn third" name="password" placeholder="Enter Password" require>

      <!-- <input type="submit" name="submut" class="btn btn-success fadeIn fourth " style="height: 40px;  width: 90%;" value="Log In"> -->
      <input type="submit" class="btn btn-success fadeIn fourth" name="signin" style="height: 40px;  width: 90%;" value="Sign In">
      <br>
      <br>
      <!-- <label style="display: block; text-align: right;">Register
        <a href="#">| Click Here</a></label> -->

    </form>


  </div>


</body>


</html>