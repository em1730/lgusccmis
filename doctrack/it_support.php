<?php

session_start();

$alert_msg = '';
$db_user_name = $db_first_name = $db_middle_name = $db_last_name = $db_email_ad = $db_contact_number = '';

if (!isset($_SESSION['id'])) {
  header('location:../index.php');
}

$user_id = $_SESSION['id'];

include('../config/db_config.php');
include('send_email_now.php');

$get_all_user_sql = "SELECT * FROM tbl_users WHERE user_id = :id";
$get_all_user_data = $con->prepare($get_all_user_sql);
$get_all_user_data->execute([':id' => $user_id]);
while ($result = $get_all_user_data->fetch(PDO::FETCH_ASSOC)) {

  $db_user_name = $result['username'];
  $db_first_name = $result['first_name'];
  $db_middle_name = $result['middle_name'];
  $db_last_name = $result['last_name'];
  $db_email_ad = $result['email'];
  // $db_contact_number = $result['contact_number'];

}


//select all users
$get_users_sql = "SELECT * FROM tbl_users WHERE user_id != :id and department = 'ITCSO'";
$get_users_data = $con->prepare($get_users_sql);
$get_users_data->execute(['id' => $user_id]);

?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LGUSCC DTS | Send Email</title>
  <?php include('heading.php') ?>

</head>


<body class="hold-transition sidebar-mini">
  <div class="wrapper">


    <?php include('sidebar.php') ?>

    <div class="content-wrapper">

      <div class="content-header"></div>

      <!-- Main content -->
      <section class="content">


        <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-10">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">IT Technical Support</h3>
              </div>

              <!-- /.box-header -->
              <!-- form start -->
              <form role="form" method="post" action="<?php htmlspecialchars("PHP_SELF"); ?>">
                <div class="box-body">
                  <?php echo $alert_msg; ?>
                  <div class="row">
                    <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                      <label></label>
                    </div>

                  </div><br>
                  <div class="row">
                    <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                      <label>From</label>
                    </div>
                    <div class="col-md-10">
                      <input readonly type="text" class="form-control" name="sender_fullname" value="<?php echo ucfirst($db_first_name) . ' ' . ucwords($db_middle_name[0]) . '. ' . ucfirst($db_last_name); ?>">
                    </div>
                  </div><br>
                  <div class="row">
                    <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                      <label>Email</label>
                    </div>
                    <div class="col-md-10">
                      <input readonly type="text" class="form-control" name="sender_email" value="<?php echo $db_email_ad; ?>">
                    </div>
                  </div><br>
                  <hr>
                  <div class="row">
                    <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                      <label>To</label>
                    </div>
                    <div class="col-md-10">
                      <select class="form-control select2" id="select_receiver" style="width: 100%;" onchange="get_email()" name="receiver_email">
                        <option selected="selected" value="Choose recipient">Choose</option>
                        <?php while ($users = $get_users_data->fetch(PDO::FETCH_ASSOC)) { ?>
                          <option value="<?php echo $users['user_id']; ?>"><?php echo $users['first_name'] . ' ' . $users['middle_name'] . ' ' . $users['last_name']; ?></option>
                        <?php } ?>
                      </select>

                    </div>
                  </div><br>
                  <!-- <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Email</label>
                  </div>
                  <div class="col-md-10">
                      <input readonly type="text" id="receiver_email" class="form-control" name="this_receiver_email" placeholder="Choose recipient">
                  </div>
                </div><br> -->
                  <div class="row">
                    <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                      <label>Document No.</label>
                    </div>
                    <div class="col-md-10">
                      <input type="text" class="form-control" name="email_subject" placeholder="Please type Document Number" required="">
                    </div>
                  </div><br>
                  <div class="row">
                    <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                      <label>Message</label>
                    </div>
                    <div class="col-md-10">
                      <textarea class="form-control" name="message" rows="4" cols="50" placeholder="Problems/Concerns/Required Actions" required></textarea>

                    </div>
                  </div><br>

                </div>
                <!-- /.box-body -->
                <div class="box-footer" align="center">

                  <input type="submit" name="send_message" class="btn btn-primary" value="Send Message">
                </div>
              </form>
            </div>
            <!-- /.box -->
          </div>
          <div class="col-md-1"></div>
        </div>

      </section>
      <!-- /.content -->
    </div>

    <?php include('footer.php') ?>
  </div>
  <!-- ./wrapper -->

  <?php include('scripts.php') ?>

  <script type="text/javascript">
    function get_email() {
      var contact_number = document.getElementById("select_receiver").value;
      $('#receiver_email').val(contact_number);
    }

    $(document).ready(function() {

      $(document).ajaxStart(function() {
        Pace.restart()
      })

      //select 2
      $('.select2').select2();


    });
  </script>


</body>

</html>