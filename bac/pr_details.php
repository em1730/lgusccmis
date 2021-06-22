

<?php
session_start();
include ('../../config/db_config.php');
include ('aside.php');

$itemname  =' ';
$btnNew = 'disabled';
$btnPrint= 'disabled';
$btnStatus = '';

$get_all_items_sql = "SELECT * from tbl_items";
$get_all_items_data = $con->prepare($get_all_items_sql);
$get_all_items_data->execute(); 

//select all departments
$get_all_departments_sql = "SELECT * FROM tbl_department";
$get_all_departments_data = $con->prepare($get_all_departments_sql);
$get_all_departments_data->execute(); 
?>

<!DOCTYPE html>
<html >
<head>


<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BAC| Add PR</title>

 <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="../dist/css/ionicons.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
  <!-- Morris chart
  <link rel="stylesheet" href="../plugins/morris/morris.css">
  jvectormap -->
  <!-- <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css"> -->
  <!-- Date Picker -->
  <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="../plugins/select2/select2.min.css">
  <!-- Daterange picker
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css"> -->
  <!-- bootstrap wysihtml5 - text editor -->
  <!-- <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"> -->
  <!-- Google Font: Source Sans Pro -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
   <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap4.css">
     <!-- Select2 -->
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

  <link href="../plugin/bootstrap-dialog.css" rel="stylesheet" type="text/css" />

  <script src="js/bootstrap-dialog.js"></script>

</head>

<body class="hold-transition sidebar-mini">



<div class="wrapper">
    <div class="content-wrapper">
      <div class="content-header">
    
      </div>

      <section class="content animated fadeIn">

      <section class="content">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Add Item</h3>
        </div>
      <div class="card-body">
        <form role="form" method="post"  action="<?php htmlspecialchars("PHP_SELF"); ?>">
          <div class="box-body">

          
          
          <form method="post" id="account-form" >

          <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                                                <!-- <div class="form-group"> -->
                                                <label>item:</label>
                                            </div>
                                                                                     
                                            <div class="col-md-10">
                                                <select class="form-control select2" id="select_type" style="width: 100%;" name="itemname" value="<?php echo
$itemname; ?>">
                                                    <option selected="selected">Please select...</option>
<?php while ($get_items = $get_all_items_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                        <option value="<?php echo
    $get_items['objid']; ?>"><?php echo $get_items['itemname']; ?></option>
<?php } ?>
                                                </select>
                                            </div>
                                        </div>

      
</div>
      


      <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Description:</label>
                  </div>

                  
                  <div class="col-md-10">
                      <textarea rows="5" class="form-control" name="description" placeholder="Item Description" ></textarea>
                  </div>
                </div><br>  

   
     

      <div class="row">
                        <div class="input-group " style="position: 10px;">
            
                        <input type="submit"  <?php echo $btnStatus; ?> name="insert_purchaseitem" class="btn btn-primary" value="ADD">
               
                        </div>

      </div>       
    </div>

      <section class="content">
        <div class="row">
      <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Item Details</h3>
        </div>
        
        <div class="card-body">
          <div class="box box-primary">
          <form role="form" method="get" action="<?php htmlspecialchars("PHP_SELF");?>">
              <div class="box-body">
                <table id="users" class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <th>Select</th>
                      <th>Unit</th>
                      <th>Description</th>
                      <th>Price</th>
                      <th>Quantity</th>
                  
                    
              
                    </tr>
                  </thead>
                    <tbody>
                    <?php while($items_data = $get_all_items_data->fetch(PDO::FETCH_ASSOC)){ ?>
                      <tr>  
                      <td>
                           <input type="checkbox" onClick="tab1_To_tab2()" name="check-tab1">
                          </td>
                          <td><?php echo $items_data['unit'];?> </td>
                          <td >
                               <?php echo $items_data['itemname'];?> <br>
                               <?php echo " - "?> 
                               <?php echo $items_data['description'];?>
                          </td>
                           <td contenteditable="true"><?php echo $items_data['price'];?></td>
                           <td name="quantity" contenteditable="true" ></td>
                           
                         
                      </tr>
                      <?php } ?>
                  
                    </tbody>
                  
                </table>
              </div>
           </form>
          </div>       
    <!--end of content-wrapper  -->
    

    <!-- beginning of footer -->
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
      </div>
      <strong>Copyright & copy;  </strong>    All rights
      reserved.
    </footer>
    <!-- end footer -->
</div>
<!-- end of div class wrapper -->






<!-- ./wrapper -->
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<!-- <script src="../dist/css/jquery-ui.min.js"></script> -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  // $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Morris.js charts -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script> -->
<!-- <script src="../plugins/morris/morris.min.js"></script> -->
<!-- Sparkline -->
<!-- <script src="../plugins/sparkline/jquery.sparkline.min.js"></script> -->
<!-- jvectormap -->
<!-- <script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script> -->
<!-- <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script> -->
<!-- jQuery Knob Chart -->
<!-- <script src="../plugins/knob/jquery.knob.js"></script> -->
<!-- daterangepicker -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script> -->
<!-- <script src="../plugins/daterangepicker/daterangepicker.js"></script> -->
<!-- datepicker -->
<script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- Select2 -->

<script src="../plugins/select2/select2.full.min.js"></script>
<!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
    <!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>ry-ui.min.js"></script> -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />   -->
           <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>   -->
           <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>   -->
<!-- <script
      src="https://code.jquery.com/jquery-3.4.1.min.js"
      integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
      crossorigin="anonymous">
      
</script> -->


<script>
$('#users').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'autoHeight'  : true
    })
  </script>

        <script type="text/javascript">

            $(document).ready(function() {
                $(document).ajaxStart(function() {
                    Pace.restart()
                })


       

            });

           
   } 
                 
  });       

        </script>


        <script>


$('#select_type').on('change',function(){
             var desc = $(this).val();
             var itemcode = $('itemcode').val();
            //  $('#doc_no').val(type);
     if (desc=="itemname" || desc=="itemcode"){
      
     }else if (desc=="DESC"){
       window.open("add_outgoing_dwp.php", '_parent');
     }else{
         
            $.ajax({
              desc:'POST',
              data:{desc:desc, itemcode:itemcode},
              url:'generate_description.php',
               success:function(data){
               $('#doc_no').val(data);
  
               }
            
                 
                });           
     }
                      });


            $(function() {
                //Initialize Select2 Elements
                $('.select2').select2()

                //Datemask dd/mm/yyyy
                $('#datemask').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'})
                //Datemask2 mm/dd/yyyy
                $('#datemask2').inputmask('mm/dd/yyyy', {'placeholder': 'mm/dd/yyyy'})
                //Money Euro
                $('[data-mask]').inputmask()

                //Date range picker
                $('#reservation').daterangepicker()
                //Date range picker with time picker
                $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'})
                //Date range as a button
                $('#daterange-btn').daterangepicker(
                        {
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


