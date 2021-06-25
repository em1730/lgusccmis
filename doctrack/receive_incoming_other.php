<?php


session_start();

$docno = $date  = $particulars = $origin = $destination = $amount = $status    = $remarks = $user_name = '';

$btnNew = 'disabled';
$btnPrint = 'disabled';
$btnStatus = '';

$now = new DateTime();

if (!isset($_SESSION['id'])) {
  header('location:../index');
}
$user_id = $_SESSION['id'];

include('../config/db_config.php');
// include ('insert_received.php');
// include('update_documents.php');
include('insert_incoming.php');

//select user
$get_user_sql = "SELECT * FROM tbl_users WHERE user_id = :id";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {
  $db_first_name = $result['first_name'];
  $db_middle_name = $result['middle_name'];
  $db_last_name = $result['last_name'];
  $db_email_ad = $result['email'];
  $db_contact_number = $result['contact_no'];
  $user_name = $result['username'];
  $department = $result['department'];
}


//select all data type
$get_all_document_sql = "SELECT * FROM document_type";
$get_all_document_data = $con->prepare($get_all_document_sql);
$get_all_document_data->execute();

//select all departments
$get_all_departments_sql = "SELECT * FROM tbl_department";
$get_all_departments_data = $con->prepare($get_all_departments_sql);
$get_all_departments_data->execute();

if (isset($_GET['docno'])) {
  $docno = $_GET['docno'];
  //select all incoming documents
  $get_all_incoming_sql = "SELECT * FROM tbl_documents where docno = :doc and destination = '$department'";
  $get_all_incoming_data = $con->prepare($get_all_incoming_sql);
  $get_all_incoming_data->execute([':doc' => $docno]);
  while ($result = $get_all_incoming_data->fetch(PDO::FETCH_ASSOC)) {
    $docno = $result['docno'];
    $date = $result['date'];
    $type = $result['type'];
    $particulars = $result['particulars'];
    $origin = $result['origin'];
    //$amount= $result['amount'];
    $status = $result['status'];
    $remarks = $result['remarks'];
  }
}


?>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LGUSCC DTS | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php include('heading.php') ?>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php include('sidebar.php') ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="content-header"></div>


      <!-- Main content -->
      <section class="content">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Receive Documents</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">

            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="<?php htmlspecialchars("PHP_SELF"); ?>">
              <div class="box-body">
                <?php echo $alert_msg; ?>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Document No.:</label>
                  </div>
                  <div class="col-md-10">
                    <input type="text" class="form-control" id="doc_no" name="doc_no" placeholder="Document Number" value="<?php echo
                                                                                                                            $docno; ?>" required>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <!-- <div class="form-group"> -->
                    <label>Document Type:</label>
                  </div>

                  <div class="col-md-10">
                    <select class="form-control select2" id="select_type" style="width: 100%;" name="type" value="<?php echo
                                                                                                                  $selected; ?>">
                      <option>Please select...</option>
                      <?php while ($get_type = $get_all_document_data->fetch(PDO::FETCH_ASSOC)) { ?>


                        <?php
                        //if $get_author naa value, check nato if equals sa $get_author1['fullname']
                        //if equals, put 'selected' sa option
                        $selected = ($type == $get_type['objid']) ? 'selected' : '';

                        ?>
                        <option <?= $selected; ?> value="<?php echo $get_type['objid']; ?>"><?php echo $get_type['description']; ?></option>
                      <?php } ?>

                    </select>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <!-- <div class="form-group"> -->
                    <label>Originating Office:</label>
                  </div>

                  <div class="col-md-10">
                    <select class="form-control select2" style="width: 100%;" name="origin" id="department" value="<?php echo
                                                                                                                    $origin; ?>">
                      <option>Please select...</option>
                      <?php while ($get_receiver = $get_all_departments_data->fetch(PDO::FETCH_ASSOC)) { ?>


                        <?php
                        //if $get_author naa value, check nato if equals sa $get_author1['fullname']
                        //if equals, put 'selected' sa option
                        $selected = ($origin == $get_receiver['objid']) ? 'selected' : '';

                        ?>

                        <option <?= $selected; ?> value="<?php echo $get_receiver['objid']; ?>"><?php echo $get_receiver['department']; ?></option>
                      <?php } ?>

                    </select>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Date:</label>
                  </div>
                  <div class="col-md-10">
                    <!-- Date -->
                    <div class="form-group">
                      <!-- <label>Date:</label> -->
                      <div class="input-group date" data-provide="datepicker">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker" name="date" placeholder="Date Created" value="<?php echo
                                                                                                                                          $now->format('m/d/Y');; ?>">
                      </div>
                    </div>
                  </div>
                </div><br>




                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Subject/Particulars:</label>
                  </div>
                  <div class="col-md-10">
                    <textarea rows="5" class="form-control" name="particulars" placeholder="Subject/Particulars" required><?php echo
                                                                                                                          $particulars; ?></textarea>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Remarks:</label>
                  </div>
                  <div class="col-md-10">

                    <input type="text" required class="form-control" name="remarks" placeholder="Remarks" value="<?php echo
                                                                                                                  $remarks; ?>">
                  </div>
                </div><br>

                <div class="box-footer" align="center">
                  <input type="submit" <?php echo $btnNew; ?> name="add" class="btn btn-primary" value="New">
                  <input type="submit" <?php echo $btnStatus; ?> name="insert_received" class="btn btn-primary" value="Receive">
                  <a href="../plugins/TCPDF/User/routing.php?docno=<?php echo $docno; ?>" target="blank">
                    <input type="button" <?php echo $btnPrint; ?> name="print" class="btn btn-primary" value="Print">
                  </a>

                  <a href="list_received">
                    <input type="button" name="cancel" class="btn btn-default" value="Close">
                  </a>
                </div>

                <div class="col-md-10">
                  <input type="hidden" readonly class="form-control" name="department" placeholder="Department" value="<?php echo
                                                                                                                        $department; ?>">
                </div>
              </div><br>
              <div class="col-md-10">
                <input type="hidden" readonly class="form-control" name="username" placeholder="username" value="<?php echo
                                                                                                                  $user_name; ?>" required>
              </div>
          </div><br>
          <!-- /.box-body -->

          </form>
        </div>
        <!-- /.card -->
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
      'autoWidth': true
    })
  </script>


  <script>
    $('#select_type').on('change', function() {
      var type = $(this).val();
      var office = $('#department').val();

      //  $('#doc_no').val(type);
      if (type == "DV" || type == "OBR" || type == "DWP" || type == "PYL" || type == "LR" || type == "RIS" || type == "PO" || type == "PR") {
        // window.open("receive_incoming_other_dv.php?type=" + type + '&orig=' + office, '_parent');
        window.open("receive_incoming_other_dv.php?type=" + type, '_parent');

      } else {
        //    if (type=="DV"){
        //    window.open("receive_incoming_other_dv.php", '_parent');
        //    } else if (type=="DWP"){
        //    window.open("receive_incoming_other_dwp.php", '_parent');
        //    sessionStorage.setItem("orig", office);
        //  }else{

        $.ajax({
          type: 'POST',
          data: {
            type: type,
            office: office
          },
          url: 'generate_serial.php',
          success: function(data) {
            $('#doc_no').val(data);

          }


        });
      }
    });


    $('#doc_no').on('change', function() {
      var docno = $(this).val();
      $.ajax({
        type: 'POST',
        data: {
          docno: docno
        },
        url: 'check_serial.php',
        success: function(data) {
          $('#doc_no').val(data);
          // alert (data);
        }


      });

    });



    $(function() {


      //Initialize Select2 Elements
      $('.select2').select2()

      //Datemask dd/mm/yyyy
      $('#datemask').inputmask('dd/mm/yyyy', {
        'placeholder': 'dd/mm/yyyy'
      })
      //Datemask2 mm/dd/yyyy
      $('#datemask2').inputmask('mm/dd/yyyy', {
        'placeholder': 'mm/dd/yyyy'
      })
      //Money Euro
      $('[data-mask]').inputmask()

      //Date range picker
      $('#reservation').daterangepicker()
      //Date range picker with time picker
      $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        format: 'MM/DD/YYYY h:mm A'
      })
      //Date range as a button
      $('#daterange-btn').daterangepicker({
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function(start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        }
      )

      //Date picker
      $('#datepicker').datepicker({
        autoclose: true
      })

      //iCheck for checkbox and radio inputs
      $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
      })
      //Red color scheme for iCheck
      $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
        checkboxClass: 'icheckbox_minimal-red',
        radioClass: 'iradio_minimal-red'
      })
      //Flat red color scheme for iCheck
      $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
      })

      //Colorpicker
      $('.my-colorpicker1').colorpicker()
      //color picker with addon
      $('.my-colorpicker2').colorpicker()

      //Timepicker
      $('.timepicker').timepicker({
        showInputs: false
      })
    })
  </script>

</body>

</html>