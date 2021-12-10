<?php

include('../config/db_config.php');
session_start();
$user_id = $_SESSION['id'];

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

// $get_all_document_sql = "select * from tbl_documents d inner join tbl_ledger l on d.docno = l.docno where d.creator ='ITCSO' ";
//$get_all_document_sql = "select * from tbl_ledger";
//$get_all_document_data = $con->prepare($get_all_document_sql);
//$get_all_document_data->execute();  

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

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LGUSCC DTS | Track Documents </title>
  <?php include('heading.php') ?>


</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php include('sidebar.php') ?>

    <div class="content-wrapper">
      <div class="content-header"></div>

      <?php include('dashboard.php') ?>
      <section class="content">

        <div class="card">
          <div class="card-header bg-success">
            <h3 class="card-title">TRACK DOCUMENTS</h3>
          </div>
          <div class="card-body">
            <form action="">
              <div class="box-body">

                <table id="users" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Document No.</th>
                      <th>Type</th>
                      <th>OBR No. </th>
                      <th>DV No. </th>
                      <th>Payee </th>
                      <th>Particulars</th>
                      <th>Amount</th>
                      <th>Options</th>
                    </tr>
                  </thead>


                </table>

              </div>



            </form>

          </div>

        </div>


      </section>

    </div>



    <?php include('footer.php') ?>

  </div>



  <?php include('scripts.php') ?>


  <script type="text/javascript" language="javascript">
    $(document).ready(function() {
      var dataTable = $('#users').DataTable({
        "processing": true,
        "serverSide": true,
        "scrollX": true,
        "ajax": {
          url: "track.php", // json datasource
          type: "post", // method  , by default get
          error: function() { // error handling
            $("#users-error").html("");
            $("#users").append('<tbody class="users-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
            $("#users_processing").css("display", "none");

          }
        },

        "columnDefs": [{
          "targets": -1,
          "data": null,
          "defaultContent": '<button class=\"receive btn btn-outline-success btn-xs \" ><i class="fa fa-file-text" aria-hidden= "true"></i>  View Details</button>'


        }],

      });
      $('#users tbody').on('click', 'button.receive', function() {
        // alert ('hello');
        // var row = $(this).closest('tr');
        var table = $('#users').DataTable();
        var data = table.row($(this).parents('tr')).data();
        //  alert (data[0]);
        //  var data = $('#users').DataTable().row('.selected').data(); //table.row(row).data().docno;
        var docno = data[0];
        window.open("track_documents_details.php?docno=" + docno, '_parent');
        //  var table = $('#users').DataTable(); 
        //   if ($(this).hasClass('selected')){
        //       $(this).removeClass('selected');

        //   }else{
        //     table.$('tr.selected').removeClass('selected');
        //     $(this).addClass('selected');

        //   var data = $('#users').DataTable().row('.selected').data(); //table.row(row).data().docno;
        //   var docno = data[0];
        //   window.open("receive_incoming.php?docno=" + docno,'_parent');
        // alert(docno);
        //    }
      });
    });
  </script>
</body>

</html>