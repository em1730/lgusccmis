<?php

session_start();

if (!isset($_SESSION['id'])) {
  header('location:../index.php');
}

$user_id = $_SESSION['id'];

include('../config/db_config.php');
// include('delete.php');

$get_user_sql = "SELECT * FROM tbl_users WHERE user_id = :id";
$get_user_data = $con->prepare($get_user_sql);
$get_user_data->execute([':id' => $user_id]);
while ($result = $get_user_data->fetch(PDO::FETCH_ASSOC)) {

  $user_name = $result['username'];
  // $db_first_name = $result['first_name'];
  // $db_middle_name = $result['middle_name'];
  // $db_last_name = $result['last_name'];
  $db_email_ad = $result['email'];
  $db_contact_number = $result['contact_no'];
  $db_fullname = strtoupper($result['first_name'] . ' ' . $result['middle_name'] . ' ' . $result['last_name']);
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
  <title>DOCTRACK | Document Type</title>
  <?php include('heading.php') ?>
  <style>
    .void:hover {
      color: white;
    }
  </style>

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php include('sidebar.php') ?>

    <div class="content-wrapper">

      <div class="content-header"></div>

      <section class="content">
        <div class="card">
          <div class="card-header bg-success">
            <h4>List of Document Types
              <a href="add_document.php" style="float:right;" type="button" class="btn btn-success bg-gradient-success" style="border-radius: 0px;">
                <i class="nav-icon fa fa-plus-square fa-lg"></i></a>
            </h4>

          </div>
          <div class="card-body">


            <div class="box-body">
              <table id="users" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID Number</th>
                    <th>Document Code</th>
                    <!-- <th>Middlename</th>
                      <th>Lastname</th> -->
                    <th>Type</th>
                    <th>Description</th>
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

      </section><br><br>







    </div>



    <?php include('footer.php') ?>
  </div>

  <div class="modal fade" id="modalvoid" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h4 class="modal-title ">VOID DOCUMENT TYPE</h4>
        </div>
        <form method="POST" action="void_docu_type.php">
          <div class="modal-body">
            <div class="box-body-lg">
              <div class="form-group">

                <div class="row">
                  <div class="col-sm-5">
                    <label>VOID USERNAME: </label>
                    <input readonly="true" type="text" name="void_username" id="void_username" class="form-control" pull-right value="<?php echo $db_fullname ?>" required>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-sm-5">
                    <label>DOCUMENT ID: </label>
                    <input readonly="true" type="text" name="void_doc_id" id="void_doc_id" class="form-control" pull-right value="" required>
                  </div>

                </div><br>

                <div class="row">
                  <div class="col-sm-9">
                    <label>DOCUMENT CODE & NAME: </label>
                    <input readonly="true" type="text" name="void_doc_name" id="void_doc_name" class="form-control" pull-right value="" required>
                  </div>
                </div><br><br>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left bg-olive" data-dismiss="modal">NO</button>
                  <input type="submit" name="void_docu_type" class="btn btn-danger" value="SAVE">
                  <!-- <input type="submit" id="btnSubmit" name="update_vas_test" class="btn btn-danger" value="SAVE"> -->
                </div>
              </div>
            </div>
          </div>
        </form>


      </div>

    </div>
  </div>

  <?php include('scripts.php') ?>


  <?php

  if (isset($_SESSION['status']) && $_SESSION['status'] != '') {

  ?>
    <script>
      swal({
        title: "<?php echo $_SESSION['status'] ?>",
        // text: "You clicked the button!",
        icon: "<?php echo $_SESSION['status_code'] ?>",
        button: "OK. Done!",
      });
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
        }
      })
    </script>

  <?php
    unset($_SESSION['status']);
  }
  ?>


  <script>
    $(document).ready(function() {
      var dataTable = $('#users').DataTable({

        page: true,
        stateSave: true,
        processing: true,
        serverSide: true,
        scrollX: false,
        ajax: {
          url: "search_document.php",
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
            width: "200px",
            targets: -1,
            data: null,
            defaultContent: '<button class="btn btn-outline-success btn-sm editDocument" style = "margin-right:10px;"  id = "editDocument" data-placement="top" title="Edit Document"> <i class="fa fa-edit"></i></button>' +
              '<a class="btn btn-outline-danger btn-sm void" style="margin-right:10px;"  data-placement="top" title="VOID"><i class="fa fa-trash" style="color:red"></i></a>',

          },

        ],
      });
    });

    $('#users tbody').on('click', '#editDocument', function() {
      // alert ('hello');
      // var row = $(this).closest('tr');
      var table = $('#users').DataTable();
      var data = table.row($(this).parents('tr')).data();
      //  alert (data[0]);
      //  var data = $('#users').DataTable().row('.selected').data(); //table.row(row).data().docno;
      var idno = data[0];


      window.open("view_document.php?idno=" + idno, '_parent');

    });

    $("#users tbody").on("click", ".void", function() {
      event.preventDefault();
      var currow = $(this).closest("tr");

      var doc_id = currow.find("td:eq(0)").text();
      var doc_code = currow.find("td:eq(1)").text();
      var doc_name = currow.find("td:eq(2)").text();

      $('#modalvoid').modal('show');
      $('#void_doc_id').val(doc_id);

      $('#void_doc_name').val(doc_code + ' / ' + doc_name);



    });
  </script>



</body>

</html>