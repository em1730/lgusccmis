<?php


session_start();

if (!isset($_SESSION['id'])) {
  header('location:../index.php');
}

$user_id = $_SESSION['id'];



$alert_msg = '';
$docno = $date = $type = $particulars = $origin = $destination = $amount = $status = $date_received = $remarks = $user_name = '';
$btnNew = 'disabled';
$btnStatus = '';

$now = new DateTime();



include('../config/db_config.php');
include('update_forward.php');
include('insert_forward.php');

$get_user_sql = "SELECT * FROM tbl_users WHERE user_id = :id";
$get_user_data = $con->prepare($get_user_sql);
$get_user_data->execute([':id' => $user_id]);
while ($result = $get_user_data->fetch(PDO::FETCH_ASSOC)) {

  $user_name = $result['username'];
  $department = $result['department'];


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
  //   echo "<pre>";
  //      print_r($department);
  //  echo "</pre>";
}

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


//select all incoming documents
$get_all_doctype_sql = "SELECT * FROM document_type";
$get_all_doctype_data = $con->prepare($get_all_doctype_sql);
$get_all_doctype_data->execute();




//select all departments
$get_all_dept_sql = "SELECT * FROM tbl_department";
$get_all_dept_data = $con->prepare($get_all_dept_sql);
$get_all_dept_data->execute();

?>




<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LGUSCC DTS | Releasing </title>

  <?php include('heading.php'); ?>

</head>

<body class="hold-transition sidebar-mini">



  <div class="wrapper">

    <?php include('sidebar.php') ?>

    <div class="content-wrapper">
      <div class="content-header"></div>

      <section class="content">
        <div class="card">
          <div class="card-header bg-success">
            <h3 class="card-title">RELEASE DOCUMENTS</h3>
          </div>

          <div class="card-body">
            <form action="">
              <div class="box-body">

                <div class="row">


                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Date:</label>
                  </div>

                  <div class="col-md-2">
                    <div class="form-group">
                      <div class="input-group date" data-provide="datepicker">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" readonly class="form-control pull-right" id="datepicker" name="date" placeholder="Date Created" value="<?php echo $now->format('m/d/Y'); ?>">
                      </div>
                    </div>
                  </div>


                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Document # :</label>
                  </div>
                  <div class="col-md-4">
                    <input type="text" readonly class="form-control" name="doc_number" placeholder="Document Number" value="<?php echo $docno; ?>" required>
                  </div>
                </div><br>



                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Document Type:</label>
                  </div>
                  <div class="col-md-8">
                    <select class="form-control select2" readonly style="width: 100%;" name="type" value="<?php echo $type; ?>">
                      <option>Please select...</option>
                      <?php while ($get_doctype = $get_all_doctype_data->fetch(PDO::FETCH_ASSOC)) { ?>
                        <?php $selected = ($type == $get_doctype['objid']) ? 'selected' : '';  ?>
                        <option <?= $selected; ?> value="<?php echo $get_doctype['objid']; ?>"><?php echo $get_doctype['description']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Subject/Particulars:</label>
                  </div>
                  <div class="col-md-8">
                    <textarea rows="5" class="form-control" name="particulars" placeholder="Subject/Particulars" required><?php echo $particulars; ?></textarea>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Forwarded To:</label>
                  </div>
                  <div class="col-md-8">
                    <select class="form-control select2" style="width: 100%;" name="receiver" value="<?php echo $destination; ?>">
                      <option>Please select...</option>
                      <?php while ($get_dept = $get_all_dept_data->fetch(PDO::FETCH_ASSOC)) { ?>
                        <?php $selected = ($origin == $get_dept['objid']) ? 'selected' : '';   ?>
                        <option <?= $selected; ?> value="<?php echo $get_dept['objid']; ?>"><?php echo $get_dept['department']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div><br>


                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Date Received:</label>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <div class="input-group date" data-provide="datepicker">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker" name="date" placeholder="Date Created" value="<?php echo $now->format('m/d/Y');; ?>">
                      </div>
                    </div>
                  </div>
                </div><br>
                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Remarks:</label>
                  </div>
                  <div class="col-md-8">
                    <input type="text" required class="form-control" name="remarks" placeholder="Remarks" value="<?php echo $remarks; ?>">
                    <input type="hidden" readonly class="form-control" name="department" placeholder="Department" value="<?php echo  $department; ?>" required>
                    <input type="hidden" readonly class="form-control" name="username" placeholder="username" value="<?php echo $user_name; ?>" required>
                  </div>
                </div><br>

                <div class="box-footer" align="center">
                  <a href="list_received.php">
                    <input type="submit" <?php echo $btnStatus; ?> name="insert_forward" class="btn btn-success" value="Release">
                  </a>
                  <!-- <a href="list_received.php">
                  <input type="button" name="cancel" class="btn btn-default" value="Close">       
                 -->
                </div>

              </div>
            </form>

          </div>
        </div><br>

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
    });
  </script>



  <script>
    $('#select_type').on('change', function() {
      var type = $(this).val();
      //  $('#doc_no').val(type);


      $.ajax({
        type: 'POST',
        data: {
          type: type
        },
        url: 'generate_serial.php',
        success: function(data) {
          $('#doc_no').val(data);


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