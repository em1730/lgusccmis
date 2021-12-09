<?php

session_start();

if (!isset($_SESSION['id'])) {
  header('location:../index.php');
}

$user_id = $_SESSION['id'];

include('../config/db_config.php');
include('delete.php');

$get_user_sql = "SELECT * FROM tbl_users WHERE user_id = :id";
$get_user_data = $con->prepare($get_user_sql);
$get_user_data->execute([':id' => $user_id]);
while ($result = $get_user_data->fetch(PDO::FETCH_ASSOC)) {

  $user_name = $result['username'];
  $db_first_name = $result['first_name'];
  $db_middle_name = $result['middle_name'];
  $db_last_name = $result['last_name'];
  $db_email_ad = $result['email'];
  $db_contact_number = $result['contact_no'];
  $db_user_name = $result['username'];
}


//select all users
$get_all_users_sql = "SELECT * FROM tbl_users WHERE user_id != :id";
$get_all_users_data = $con->prepare($get_all_users_sql);
$get_all_users_data->execute([':id' => $user_id]);


//select all document
$get_all_document_sql = "SELECT * FROM document_type";
$get_all_document_data = $con->prepare($get_all_document_sql);
$get_all_document_data->execute();

?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LGUSCC DTS | Document Type</title>
  <?php include('heading.php') ?>

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php include('sidebar.php') ?>

    <div class="content-wrapper">

      <div class="content-header"></div>

      <section class="content">
        <div class="card">
          <div class="card-header bg-success">
            <h4>DOCUMENT TYPES
            <a href="add_document.php" style="float:right;" type="button" class="btn btn-success bg-gradient-success" style="border-radius: 0px;">
                <i class="nav-icon fa fa-plus-square"></i></a>
            </h4>

          </div>
          <div class="card-body">


            <div class="box-body">
              <table id="users" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Document Code</th>
                    <!-- <th>Middlename</th>
                      <th>Lastname</th> -->
                    <th>Type</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Options</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
            <!-- /.box-body -->



          </div>
        </div>

      </section>


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
    })
  </script>

  <script>
    $(document).on('click', 'button[data-role=confirm_delete]', function(event) {
      event.preventDefault();

      var user_id = ($(this).data('id'));

      $('#user_id').val(user_id);
      $('#deleteuser_Modal').modal('toggle');

    })
  </script>

</body>

</html>