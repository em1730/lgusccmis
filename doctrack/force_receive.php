<?php


session_start();

if (!isset($_SESSION['id'])) {
  header('location:../index.php');
}

$user_id = $_SESSION['id'];



$alert_msg = '';
$docno = $date = $type = $particulars = $origin = $destination = $amount = $status = $date_received = $remarks = $user_name = '';
$btnNew = 'disabled';
$btnPrint = 'disabled';
$btnStatus = '';

$now = new DateTime();


include('../config/db_config.php');
include('delete.php');
include('update_documents.php');
include('insert_received.php');
include('insert_ledger.php');

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

if (isset($_GET['docno'])) {
  $docno = $_GET['docno'];
  //select all incoming documents
  $get_all_incoming_sql = "SELECT * FROM tbl_documents where docno = :doc"; // and destination = '$department'";
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

//select all incoming documents
$get_all_documents_sql = "SELECT * FROM tbl_documents order by docno";
$get_all_documents_data = $con->prepare($get_all_documents_sql);
$get_all_documents_data->execute();



//select all departments
$get_all_dept_sql = "SELECT * FROM tbl_department";
$get_all_dept_data = $con->prepare($get_all_dept_sql);
$get_all_dept_data->execute();

?>



<!DOCTYPE html>

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
      <!-- Content Header (Page header) -->


      <!-- Main content -->
      <section class="content">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Force Receive Documents</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form role="form" method="post" action="<?php htmlspecialchars("PHP_SELF"); ?>">
              <div class="box-body">
            




                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <!-- <div class="form-group"> -->
                    <label>Document Number:</label>
                  </div>

                  <div class="col-md-10">
                    <select class="form-control select2" id="doc_no" style="width: 100%;" name="doc_no" value="<?php echo
                                                                                                                $docno; ?>">
                      <option>Please select...</option>

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
                        <input type="text" readonly class="form-control pull-right" id="datepicker" name="date" placeholder="Date Created" value="<?php echo $date; ?>">
                      </div>
                    </div>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Document Type:</label>
                  </div>
                  <div class="col-md-10">

                    <input type="text" readonly id="type" class="form-control" name="type" placeholder="Document Type" value="<?php echo
                                                                                                                              $type; ?>">
                  </div>
                </div><br>


                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Subject/Particulars:</label>
                  </div>
                  <div class="col-md-10">
                    <textarea rows="5" class="form-control" id="particulars" name="particulars" placeholder="Subject/Particulars" required><?php echo $particulars; ?></textarea>
                  </div>
                </div><br>


                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Originating Office:</label>
                  </div>
                  <div class="col-md-10">

                    <input type="text" readonly id="origin" class="form-control" name="origin" placeholder="Originating Office" value="<?php echo
                                                                                                                                        $origin; ?>">
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Date Received:</label>
                  </div>
                  <div class="col-md-10">
                    <!-- Date -->
                    <div class="form-group">
                      <!-- <label>Date:</label> -->
                      <div class="input-group date" data-provide="datepicker">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datenow" name="date" placeholder="Date Created" value="<?php echo
                                                                                                                                      $now->format('m/d/Y');; ?>">
                      </div>
                    </div>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Remarks:</label>
                  </div>
                  <div class="col-md-10">

                    <input type="text" required id="remarks" class="form-control" name="remarks" placeholder="Remarks" value="<?php echo
                                                                                                                              $remarks; ?>">
                  </div>
                </div><br>

                <div class="col-md-10">
                  <input type="hidden" readonly class="form-control" name="department" placeholder="Department" value="<?php echo
                                                                                                                        $department; ?>" required>
                </div>


                <div class="col-md-10">
                  <input type="hidden" readonly class="form-control" name="username" placeholder="username" value="<?php echo
                                                                                                                    $user_name; ?>" required>
                </div>


                <!-- /.box-body -->
                <div class="box-footer" align="center">

                  <input type="submit" <?php echo $btnStatus; ?> name="insert_received" class="btn btn-primary" value="Receive">
                  <a href="../bower_components/TCPDF/User/routing.php?docno=<?php echo $docno; ?>">
                    <input type="button" <?php echo $btnPrint; ?> name="print" class="btn btn-primary" value="Print">
                  </a>
                  <a href="list_incoming">
                    <input type="button" name="close" class="btn btn-default" value="close">
                  </a>
                </div><br>
              </div>
            </form>

          </div>
      </section><br>
      <!-- /.box -->
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
    $('#doc_no').on('change', function() {
      var docno = $(this).val();
      //  alert(docno);
      //  $('#doc_no').val(type);


      $.ajax({
        type: 'POST',
        data: {
          docno: docno
        },
        url: 'get_info.php',
        success: function(data) {
          var result = $.parseJSON(data);

          if (result.type == "DV" || result.type == "OBR" || result.type == "DWP" || result.type == "PYL" || result.type == "LR" || result.type == "RIS" || result.type == "PO" || result.type == "PR") {

            window.open("force_receive_dv.php?docno=" + docno, '_parent');
            //sessionStorage.setItem("docno", docno);

          } else {
            $('#datepicker').val(result.date);
            $('#type').val(result.type);
            $('#particulars').val(result.particulars);
            $('#origin').val(result.origin);

            $('#remarks').val(result.remarks);


          }

        }

      });



    });

    // $('#doc_no').on("keypress", "input", function(e){
    //  if (e.which == 13){

    //   var docno = $(this).val();
    //       //  alert(docno);
    //          //  $('#doc_no').val(type);


    //          $.ajax({
    //            type:'POST',
    //            data:{docno:docno},
    //            url:'get_info.php',
    //             success:function(data){
    //               var result = $.parseJSON(data);
    //               $('#datepicker').val(result.date);
    //               $('#type').val(result.type);
    //               $('#particulars').val(result.particulars);
    //               $('#origin').val(result.origin);

    //               $('#remarks').val(result.remarks);


    //               if (result.type=="DV" || result.type=="OBR" || result.type=="DWP" || result.type == "PYL" || result.type == "LR" || result.type == "RIS" || result.type == "PO") {

    //                 window.open("force_receive_dv.php", '_parent');
    //                 sessionStorage.setItem("docno", docno);
    //               }


    //     } 

    //         });   
    //  }        

    //               });

    // document.getElementById('docno').addEventListener('keypress', function(event){
    //     if (event.keyCode == 13) {
    //       var docno = $('#doc_no').val();

    //   //  $('#doc_no').val(type);


    //   $.ajax({
    //     type:'POST',
    //     data:{docno:docno},
    //     url:'get_info.php',
    //      success:function(data){
    //    $('#particulars').val(data);


    //   } 

    //       });    
    //     }
    // }

    $(function() {




      //Initialize Select2 Elements
      $('.select2').select2();
      $("#doc_no").select2({
        //  minimumInputLength: 3,
        // placeholder: "hello",
        ajax: {
          url: "force_receive_documents", // json datasource
          type: "post",
          dataType: 'json',
          delay: 250,
          data: function(params) {
            return {
              searchTerm: params.term
            };
          },

          processResults: function(response) {
            return {
              results: response
            };
          },
          cache: true
        }
      });









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