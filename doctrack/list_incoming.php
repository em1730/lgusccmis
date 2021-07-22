<?php

session_start();
if (!isset($_SESSION['id'])) {
  header('location:../index.php');
}

$user_id = $_SESSION['id'];
$docno = '';
$alert_msg = '';


include('../config/db_config.php');
include('delete.php');

$get_user_sql = "SELECT * FROM tbl_users WHERE user_id = :id";
$get_user_data = $con->prepare($get_user_sql);
$get_user_data->execute([':id' => $user_id]);
while ($result = $get_user_data->fetch(PDO::FETCH_ASSOC)) {

  $user_name = $result['username'];
  $GLOBALS['department'] = $result['department'];
  $db_first_name = $result['first_name'];
  $db_middle_name = $result['middle_name'];
  $db_last_name = $result['last_name'];
  $db_email_ad = $result['email'];
  $db_contact_number = $result['contact_no'];
  $db_user_name = $result['username'];
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

//select all incoming documents
$get_all_doctype_sql = "SELECT * FROM document_type";
$get_all_doctype_data = $con->prepare($get_all_doctype_sql);
$get_all_doctype_data->execute();



?>

<!DOCTYPE html>
<html>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> DOCTRACK | Incoming Documents Masterlisting</title>

  <?php include('heading.php'); ?>


</head>


<body class="hold-transition sidebar-mini">

  <div class="wrapper">

    <?php include('sidebar.php') ?>

    <div class="content-wrapper">

      <div class="content-header">
        <?php include('dashboard.php'); ?>
      </div>

      <section class="content">

        <div class="card">
          <div class="card-header bg-success">
            <h3 class="card-title">Incoming Documents</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="users" class="table table-bordered table-striped">

              <thead>
                <tr>
                  <th>Document No.</th>
                  <th>Date</th>
                  <th>Type</th>
                  <th>OBR No.</th>
                  <th>DV No.</th>
                  <th>Payee</th>
                  <th>Particulars</th>
                  <th>Amount</th>
                  <th>Origin</th>
                  <th>Options</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
         
        </div>

      </section><br>



      <div class="col-md-10">
        <input type="hidden" id="department" readonly class="form-control" name="department" placeholder="Department" value="<?php echo $department; ?>">
      </div>

      <!-- modal here delete -->
      <div class="modal fade" id="myModal" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Print Routing Slip</h4>
            </div>
            <form method="POST" action="<?php htmlspecialchars("PHP_SELF") ?>">
              <div class="modal-body">
                <div class="box-body">
                  <div class="form-group">
                    <label>Please enter Document Number:</label>
                    <input type="text" name="modal_docno" id="modal_docno" class="form-control" value="<?php echo $docno; ?>" required>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left bg-olive" data-dismiss="modal">No</button>
                <!-- <button type="submit" name="delete_user" class="btn btn-danger">Yes</button> -->
                <a href="javascript:;" onclick="this.href='../plugins/TCPDF/User/routing.php?docno=' + document.getElementById('modal_docno').value" target="blank">
                  <input type="button" name="delete_user" class="btn btn-danger" value="Yes">
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->



      <!-- Control Sidebar -->
      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <div class="modal-header">
          <h5 class="modal-title">SETTINGS</h5>
        </div>

        <div class="modal-body" <?php if ($department == 'CBO' || $department == 'ACCTG') { ?> style="visibility:visible" <?php } else { ?> style="display:none" <?php } ?>>
          <div class="box-body">
            <div class="form-group">
              <h6 class="modal-title">Please enter Document No.:</h6>
              <input type="text" name="docno" id="docno" class="form-control">
            </div>

            <div class="form-group">
              <label>Date:</label>
              <label id="lblDate"></label>
            </div>
            <div class="form-group">
              <label>Type:</label>
              <label id="lblType"></label>
            </div>
            <div class="form-group">
              <label>Change Document Type:</label>
              <label id="lblRemarks"></label>
              <div class="col-md-14">
                <select class="form-control select2" id="select_type" readonly style="width: 100%;" name="type" value="<?php echo $type; ?>">
                  <option>Please select...</option>
                  <?php while ($get_doctype = $get_all_doctype_data->fetch(PDO::FETCH_ASSOC)) { ?>

                    <?php
                    //if $get_author naa value, check nato if equals sa $get_author1['fullname']
                    //if equals, put 'selected' sa option
                    $selected = ($type == $get_doctype['objid']) ? 'selected' : '';
                    ?>

                    <option <?= $selected; ?> value="<?php echo $get_doctype['objid']; ?>"><?php echo $get_doctype['description']; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="box-footer" align="center">
              <input type="button" id="change" name="submit" class="btn btn-success" value="CHANGE">
            </div>

            <!-- <div class="form-group">
                    <h5 class="blinking"  id="lblMessage"> </h5>
                    </div> -->

          </div>
        </div>
      </aside>


    </div>




    <?php include('footer.php') ?>


  </div>

  <?php include('scripts.php') ?>

  <script>
    $(document).ready(function() {


      var office = $('#department').val();
      var dataTable = $('#users').DataTable({
        "processing": true,
        "serverSide": true,
        "scrollX": true,
        "ajax": {
          url: "track_incoming.php", // json datasource
          data: {
            office: office
          },
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
          "defaultContent": '<button class=\"receive btn btn-outline-success btn-xs \" ><i class="fa fa-download" aria-hidden= "true"></i></button>'


        }],
      });

      $('#users tbody').on('click', 'button.receive', function() {
        // alert ('hello');
        // var row = $(this).closest('tr');
        var table = $('#users').DataTable();
        var data = table.row($(this).parents('tr')).data();
        //  alert (data[0]);
        //  var data = $('#users').DataTable().row('.selected').data(); //table.row(row).data().docno;
        var type = data[2];
        var docno = data[0];

        if (type == "DV" || type == "OBR" || type == "DWP" || type == "PYL" || type == "LR" || type == "RIS" || type == "PO" || type == "PR") {
          window.open("receive_incoming_dv.php?docno=" + docno, '_parent');
        } else {

          window.open("receive_incoming.php?docno=" + docno, '_parent');
        }
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

    $(document).on('click', 'button[data-role=confirm_delete]', function(event) {
      event.preventDefault();

      var user_id = ($(this).data('id'));

      $('#user_id').val(user_id);
      $('#deleteuser_Modal').modal('toggle');

    })

    $('#docno').on('change', function() {

      // function receive(){
      var docno = document.getElementById("docno").value;

      // alert (docno);

      $.ajax({
        type: 'POST',
        data: {
          docno: docno
        },
        url: 'scan_receive.php',
        success: function(data) {
          var result = $.parseJSON(data);
          // alert(result.type)
          document.getElementById('lblDate').innerHTML = result.date;
          document.getElementById('lblType').innerHTML = result.type;
          document.getElementById('lblParticulars').innerHTML = result.particulars;
          document.getElementById('lblOrigin').innerHTML = result.origin;
          //  document.getElementById('lblRemarks').innerHTML = result.remarks;
          //  document.getElementById('lblMessage').innerHTML = result.message;

        }

      });

      document.getElementById('scan_receive').focus();
      document.getElementById('scan_receive').select();

      //


    });


    $('#change').on('click', function() {

      // function receive(){
      var type = document.getElementById("select_type").value;
      var docno = document.getElementById("docno").value;
      //  alert (docno);

      $.ajax({
        type: 'POST',
        data: {
          docno: docno,
          type: type
        },
        url: 'update_type.php',
        success: function(data) {
          var result = $.parseJSON(data);
          alert(data)
          //  document.getElementById('lblDate').innerHTML = result.date;
          //  document.getElementById('lblTime').innerHTML = result.time;
          //  document.getElementById('lblType').innerHTML = result.type;
          //  document.getElementById('lblParticulars').innerHTML = result.particulars;
          //  document.getElementById('lblOrigin').innerHTML = result.origin;
          //  document.getElementById('lblDestination').innerHTML = result.destination;
          //  document.getElementById('lblRemarks').innerHTML = result.remarks;
          //  document.getElementById('lblMessage').innerHTML = result.message;

        }

      });

      // document.getElementById('scan_track').focus();
      // document.getElementById('scan_track').select();

      //

      location.reload();
    });
  </script>

</body>

</html>