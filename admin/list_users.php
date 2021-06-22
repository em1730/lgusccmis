<?php

session_start();


if (!isset($_SESSION['id'])) {
  header('location:../index.php');
}

$user_id = $_SESSION['id'];

include('../config/db_config.php');


$get_users_sql = "SELECT * FROM tbl_users WHERE user_id = :id";
$get_users_data = $con->prepare($get_users_sql);
$get_users_data->execute([':id' => $user_id]);
while ($result = $get_users_data->fetch(PDO::FETCH_ASSOC)) {

  $users_id = $result['user_id'];
  $first_name = $result['first_name'];
  $middle_name = $result['middle_name'];
  $last_name = $result['last_name'];
  $contact_number = $result['contact_no'];
  $position = $result['position'];
  $email = $result['email'];
  $username = $result['username'];
  $userpass = $result['userpass'];
  $account_type = $result['account_type'];
  $department = $result['department'];
  $location = $result['location'];
  // $status = $result['status'];
}


//select all users
$get_all_department_sql = "SELECT *  FROM tbl_users";
$get_all_department_data = $con->prepare($get_all_department_sql);
$get_all_department_data->execute();



$title = 'LGUSCC | List of Users';

?>

<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?></title>

  <?php include('heading.php') ?>

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php include('sidebar.php')

    ?>

    <div class="content-wrapper">
      <div class="content-header"></div>



      <section class="content">




        <div class="card card-danger">

          <div class="card-header">

            <h4 class="card-title">List of Users
              <a href="add_users.php" id="add_individual" style="float:right;" type="button" class="btn btn-danger bg-gradient-danger" style="border-radius: 0px;">
                <i class="nav-icon fa fa-plus-square"></i>

              </a>
            </h4>

          </div>


          <div class="card-body">
            <div class="box box-primary">
              <form role="form" method="get" action="">
                <div class="box-body">

                  <div class="table-responsive">
        
                    <table style="overflow-x: auto;" id="users" name="user" class="table table-bordered table-striped">

                      <thead align="center">
                        <th>User ID</th>
                        <th>Fullname</th>
                        <th>Position</th>
                        <th>Department</th>
                        <th>Options</th>

                      </thead>
                      <tbody>





                      </tbody>
                    </table>
                  </div>
                </div>
              </form>
            </div>
          </div>



        </div>
      </section>
      <br>
    </div>

    <?php include("footer.php")
    ?>
  </div>





  <?php include('scripts.php'); ?>

  <script>
    // $('#users').DataTable({
    //   'paging': true,
    //   'lengthChange': true,
    //   'searching': true,
    //   'ordering': true,
    //   'info': true,
    //   'autoWidth': true,
    //   'autoHeight': true
    // });

    var dataTable = $('#users').DataTable({

      page: true,
      stateSave: true,
      processing: true,
      serverSide: true,
      scrollX: false,
      ajax: {
        url: "search_user.php",
        type: "post",
        error: function(xhr, b, c) {
          console.log(
            "xhr=" +
            xhr.responseText +
            " b=" +
            b.responseText +
            " c=" +
            c.responseText
          );
        }
      },
      columnDefs: [{
          width: "160px",
          targets: -1,
          data: null,
          defaultContent: '<button class="btn btn-outline-success btn-sm" style = "margin-right:10px;"  id = "viewUser" data-placement="top" title="Edit User"> <i class="fa fa-edit"></i></button>'

            ,
        },

      ],
    });

    $("#users tbody").on("click", "#viewUser", function() {
      event.preventDefault();
      var currow = $(this).closest("tr");
      var idno = currow.find("td:eq(0)").text();
      // $('#viewIndividual').attr("href", "view_individual.php?&id=" + entity, '_parent');
      window.open("view_users.php?&id=" + idno, '_parent');

    });
  </script>

</body>

</html>