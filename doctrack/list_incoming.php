<?php

session_start();


include('../config/db_config.php');
//user-account details
include('user_account.php');






?>

<!DOCTYPE html>
<html>


<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> DOCTRACK | Incoming Documents</title>

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
            <h4>Incoming Documents </h4>
          </div>

          <div class="card-body">
            <div class="box">
              <div class="box-body">
                <div class="table-responsive">
                  <table id="users" name="user" class="table table-bordered table-striped">
                    <thead align="center">
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

                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div>





        </div>
      </section>







    </div>


    <div class="col-md-10">
      <input type="hidden" id="department2" readonly class="form-control" name="department2" placeholder="Department2" value="<?php echo $db_department; ?>">
    </div>

    <?php include('footer.php') ?>
  </div>
</body>

</html>
<!-- END OF HTML -->




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
  </script>

<?php
  unset($_SESSION['status']);
}
?>


<script>
  $(document).ready(function() {


    var office = $('#department2').val();
    var dataTable = $('#users').DataTable({

      page: true,
      stateSave: true,
      processing: true,
      serverSide: true,
      scrollX: false,
      ajax: {
        url: "track_incoming.php",
        data: {
          office: office
        },
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
          defaultContent: '<button class="btn btn-outline-success btn-sm editIndividual" style = "margin-right:10px;"  id = "button_receive" data-placement="top" title="Receive Document"> <i class="fa fa-check"></i></button> ' +
            ' ',
        },

      ],
    });



    $('#users tbody').on('click', '#button_receive', function() {
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