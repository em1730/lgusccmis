<?php

include('../config/db_config.php');

session_start();
$user_id = $_SESSION['id'];
$docno = $date  = $type = $particulars = $origin =
  $destination = $amount = $status    = $remarks = $btnNew = $btnPrint = '';

// $btnNew = 'disabled';
// $btnPrint = 'disabled';
$btnStatus = '';

if (!isset($_SESSION['id'])) {
  header('location:../index.php');
} else {
}

// include('insert_outgoing.php');

$now = new DateTime();



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



// include('insert_outgoing.php');
//include ('insert_ledger.php');



$get_all_document_sql = "SELECT * FROM document_type";
$get_all_document_data = $con->prepare($get_all_document_sql);
$get_all_document_data->execute();

//select all departments
$get_all_departments_sql = "SELECT * FROM tbl_department";
$get_all_departments_data = $con->prepare($get_all_departments_sql);
$get_all_departments_data->execute();



?>



<!DOCTYPE html>
<html>



<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> DTS | Outgoing Document</title>

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
            <h3 class="card-title">FORWARD DOCUMENTS</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="insert_outgoing.php">
              <div class="box-body">

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Document No.:</label>
                  </div>
                  <div class="col-md-4">
                    <input type="text" readonly class="form-control" id="doc_no" name="doc_number" placeholder="Document Number" value="<?php echo $docno; ?>" required>
                  </div>

                  <div class="col-md-1" style="text-align: right;padding-top: 5px;">
                    <label>Date:</label>
                  </div>

                  <div class="col-md-3">
                    <!-- Date -->
                    <div class="form-group">
                      <!-- <label>Date:</label> -->
                      <div class="input-group date" data-provide="datepicker">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" readonly class="form-control pull-right" id="datepicker" name="date" placeholder="Date Created" value="<?php echo $now->format('m/d/Y'); ?>">
                      </div>
                    </div>
                  </div>
                </div><br>


                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <!-- <div class="form-group"> -->
                    <label>Document Type:</label>
                  </div>

                  <div class="col-md-8">
                    <select class="form-control select2" id="select_type" style="width: 100%;" name="type" value="<?php echo $type; ?>">
                      <option selected="selected">Please select...</option>
                      <?php while ($get_type = $get_all_document_data->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $get_type['objid']; ?>"><?php echo $get_type['description']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div><br>


                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Subject/Particulars:</label>
                  </div>
                  <div class="col-md-8">
                    <textarea rows="5" class="form-control" name="particulars" style=" text-transform: uppercase;" placeholder="Subject/Particulars" required><?php echo $particulars; ?></textarea>
                  </div>
                </div><br>

                <!-- <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Amount: (Optional)</label>
                  </div>
                  <div class="col-md-10">
                      <input type="text" class="form-control" name="amount" placeholder="Amount" value="<?php echo  $amount; ?>" >
                  </div>
                </div><br> -->


                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <!-- <div class="form-group"> -->
                    <label>Forwarded To:</label>
                  </div>

                  <div class="col-md-8">
                    <select class="form-control select2" readonly style="width: 100%;" name="receiver" value="<?php echo $destination; ?>">
                      <option>Please select...</option>
                      <?php while ($get_dept = $get_all_departments_data->fetch(PDO::FETCH_ASSOC)) { ?>

                        <?php
                        //if $get_author naa value, check nato if equals sa $get_author1['fullname']
                        //if equals, put 'selected' sa option
                        $selected = ($destination == $get_dept['objid']) ? 'selected' : '';

                        ?>

                        <option <?= $selected; ?> value="<?php echo $get_dept['objid']; ?>"><?php echo $get_dept['department']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Remarks:</label>
                  </div>


                  <div class="col-md-8">
                    <textarea rows="5" style=" text-transform: uppercase;" class="form-control" name="remarks" placeholder="Remarks" required><?php echo $remarks; ?></textarea>
                  </div>
                </div><br>




                <div class="box-footer" align="center">
                  <!-- <input type="submit" <?php echo $btnNew; ?> name="add" class="btn btn-primary" value="New"> -->
                  <!-- <input type="submit" <?php echo $btnStatus; ?> name="insert_outgoing" class="btn btn-primary" value="Save"> -->

                  <button type="submit" <?php echo $btnStatus; ?> name="insert_outgoing" class="btn btn-success">
                    <h4>Submit Form</h4>
                  </button>

                  <!-- <a href="../plugins/TCPDF/User/routing.php?docno=<?php echo $docno; ?>" target="blank">
                    <input type="button" <?php echo $btnPrint; ?> name="print" class="btn btn-primary" value="Print">
                  </a> -->
                  <!-- <a href="list_outgoing">
                    <input type="button" name="cancel" class="btn btn-default" value="Cancel">
                  </a> -->
                </div>

                <div class="col-md-10">
                  <input type="hidden" id="department" readonly class="form-control" name="department" placeholder="Department" value="<?php echo $department; ?>">
                </div>
                <div class="col-md-10">
                  <input type="hidden" readonly class="form-control" name="username" placeholder="username" value="<?php echo $user_name; ?>" required>
                </div>
              </div><br>

              <!-- /.box-body -->

            </form>
          </div>
        </div>


      </section>
      <br>

    </div>


    <?php include('footer.php') ?>

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


    <aside class="control-sidebar control-sidebar-dark">
      <div class="modal-header">
        <h4 class="modal-title">SETTINGS</h4>
      </div>

      <div class="modal-body">

        <div class="box-body">
          <div class="form-group" <?php if ($department != 'CBO') { ?> style="display:none" <?php } ?>>
            <h6 class="modal-title">Update OBR No:</h6>
            <input type="text" name="update_obr" id="update_obr" class="form-control" value="<?php echo
                                                                                              $settings_obr; ?>" required>
          </div>

          <div class="box-body">
            <div class="form-group" <?php if ($department != 'ACCTG') { ?> style="display:none" <?php } ?>>
              <h6 class="modal-title">Update DV No:</h6>
              <input type="text" name="update_dv" id="update_dv" class="form-control" value="<?php echo
                                                                                              $settings_dv; ?>" required>
            </div>

            <!-- <div class="form-group">
                    <label>Date:</label>
                    <label id="lblDate"></label>
                    </div>
                    <div class="form-group">
                    <label>Time:</label>
                    <label id="lblTime"></label>
                    </div>
                    <div class="form-group">
                    <label>Type:</label>
                    <label id="lblType"></label>
                    </div>
                    <div class="form-group">
                    <label>Particulars:</label>
                    <label id="lblParticulars"></label>
                    </div>                   
                    <div class="form-group">
                    <label>Origin:</label>
                    <label id="lblOrigin"></label>
                    </div>
                    <div class="form-group">
                    <label>Destination:</label>
                    <label id="lblDestination"></label>
                    </div>
                    <div class="form-group">
                    <label>Remarks:</label>
                    <label id="lblRemarks"></label>
                    </div>

                    <div class="form-group">
                    <h5 class="blinking"  id="lblMessage"> </h5>
                    </div> -->

          </div>
        </div>
    </aside>

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
    $('#select_type').on('change', function() {
      var type = $(this).val();
      var office = $('#department').val();
      //  $('#doc_no').val(type);
      if (type == "DV" || type == "OBR" || type == "DWP" || type == "PYL" || type == "LR" || type == "RIS" || type == "PO" || type == "PR") {
        window.open("add_outgoing_dv.php?type=" + type, '_parent');

      } else {

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

    // $('#doc_no').on('change',function(){
    //      var docno = $(this).val();
    //       $.ajax({
    //         type:'POST',
    //         data:{docno:docno},
    //         url:'check_serial.php',
    //          success:function(data){
    //          $('#doc_no').val(data);
    //              alert (data);
    //          }


    //           });           

    //                 });






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