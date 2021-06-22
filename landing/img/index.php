<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>VAMOS | RESBAKUNA</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../sccdrrmo/dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../sccdrrmo/plugins/iCheck/square/blue.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <img src="resbakuna.png" width="350px">
    </div>

    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg"><strong>PLEASE SELECT PRIORITY GROUP</p></strong>

        <div class="social-auth-links text-center mb-3">
          <a href="seniorcitizen/index.php" class="btn btn-block btn-success">
            Senior Citizen
          </a>
          <a href="comorbidity/index.php" class="btn btn-block btn-success">
            Adult with Comorbidity
          </a>
          <a href="frontliners/index.php" class="btn btn-block btn-success">
            Frontline Personnel in Essential Sector
          </a>
          <a href="indigent/index.php" class="btn btn-block btn-success">
            Poor Population/Indigent
          </a>
          <a href="deped/index.php" class="btn btn-block btn-success">
            Teachers and Social Workers
          </a>
          <a href="#" class="btn btn-block btn-success">
            Other Government Workers
          </a>
          <a href="#" class="btn btn-block btn-success">
            Other Essential Workers
          </a>
          <a href="#" class="btn btn-block btn-success">
            Socio-demographic Groups
          </a>
          <a href="#" class="btn btn-block btn-success">
            Overseas Filipino Workers
          </a>
          <a href="#" class="btn btn-block btn-success">
            Other Remaing Workforce
          </a>
          <a href="#" class="btn btn-block btn-success">
            Rest of the Population
          </a>





        </div>
        <!-- /.social-auth-links -->


      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="../sccdrrmo/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../sccdrrmo/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- iCheck -->
  <script src="../sccdrrmo/plugins/iCheck/icheck.min.js"></script>
  <script>
    $(function() {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      })
    })
  </script>
</body>

</html>