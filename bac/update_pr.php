<?php

$date = new DateTime('2000-01-01');
$result = $date->format('Y-m-d H:i:s');
session_start();

date_default_timezone_set('Asia/Manila');  

$dept= $prno = $prdate= $saidate = $saino= $approved= 
$get_requestedby= $purpose= $department= $dept_description=
$prep_position=$prep_name= '';

// $datetoday = date('Y-m-d H:i');
$prdate = date('Y-m-d ');
$saidate = date('Y-m-d ');
$curYear = date('Y');
$time = date('H:i');
$btnNew = 'disabled';
$btnPrint= 'disabled';
$btnStatus = '';
$btnSave = $quantity = $total='';

$now = new DateTime();

if (!isset($_SESSION['id'])) {  
    header('location:../index');
}


$user_id = $_SESSION['id'];

include ('../config/db_config.php');
include ('insert_purchase.php');



// include ('search.php');

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
    $department= $result['department'];
}


// function ere(){


// }
$get_code = $get_dept =$get_status = $user_id= $get_control='';
if (isset($_GET['id'])) {

  $user_id = $_SESSION['id'];

  $get_pr_sql = "SELECT * FROM pr_info WHERE pr_info_control_no = :id";
  $get_pr_data = $con->prepare($get_pr_sql);
  $get_pr_data->execute([':id' => $user_data]);
  while ($result = $get_pr_data->fetch(PDO::FETCH_ASSOC)) {

  $get_control = $result['pr_info_control_no'];
    
   

  }

}

$get_user1_sql = "SELECT department, objid FROM tbl_department WHERE objid = :objid";
$user_data = $con->prepare($get_user1_sql);
$user_data->execute([':objid' => $department]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {
  $dept_description     = $result['department'];
  $dept_code     = $result['objid'];
}

// $pr_control_no = uniqid('idprinfo',true);
$pr_control_no = date("mdGis"); 
$get_all_department_sql = "SELECT * FROM tbl_department";
$get_all_department_data = $con->prepare($get_all_department_sql);
$get_all_department_data->execute(); 


$get_all_prepared_sql = "SELECT * FROM tbl_preparedby";
$get_all_prepared_data = $con->prepare($get_all_prepared_sql);
$get_all_prepared_data->execute();



$get_all_status_sql = "SELECT * FROM tbl_status";
$get_all_status_data = $con->prepare($get_all_status_sql);
$get_all_status_data->execute(); 

$get_all_approvedby_sql = "SELECT * FROM tbl_approvedby";
$get_all_approvedby_data = $con->prepare($get_all_approvedby_sql);
$get_all_approvedby_data->execute(); 
while ($result = $get_all_approvedby_data->fetch(PDO::FETCH_ASSOC)) {
  $lastname     = $result['lastname'];
  $firstname     = $result['firstname'];
  $position     = $result['position'];

}

$approved = $lastname . $firstname;

//select all data type
$get_all_requestedby_sql = "SELECT * FROM tbl_requestedby where status='Active'";
$get_all_requestedby_data = $con->prepare($get_all_requestedby_sql);
$get_all_requestedby_data->execute();  

//select all departments
$get_all_departments_sql = "SELECT * FROM tbl_department";
$get_all_departments_data = $con->prepare($get_all_departments_sql);
$get_all_departments_data->execute(); 


$get_all_section_sql = "SELECT * FROM tbl_section where status='Active' ";
$get_all_section_data = $con->prepare($get_all_section_sql);
$get_all_section_data->execute(); 

$get_all_items_sql = "SELECT * from tbl_items";
$get_all_items_data = $con->prepare($get_all_items_sql);
$get_all_items_data->execute(); 


  
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BAC| Add PR</title>
   <!-- Tell the browser to be responsive to screen width -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
   <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
   <!-- Date Picker -->
  <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">

  <link rel="stylesheet" href="../plugins/select2/select2.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap4.css">


  <link href="../plugin/bootstrap-dialog.css" rel="stylesheet" type="text/css" />

  <script src="js/bootstrap-dialog.js"></script>
  

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <?php include('sidebar.php');?>
  

  <div class="content-wrapper">
      <div class="content-header"></div>
    
    
      <section class="content" >
       <div id="purchase">
        <div class="card card-info">
          <div class="card-header">
            <h3>PR Details</h3>


            
          </div>
          

          <div class="card-body">



            <form role="form" method="post" id="purchase-request" action="<?php htmlspecialchars("PHP_SELF"); ?>">
              <div class="box-body">

               <?php echo $alert_msg;?>
               <input type="hidden"  readonly class="form-control" name="time"   value="<?php echo $time; ?>">
             
               <input type="hidden"  readonly class="form-control" name="username"   value="<?php echo $user_name; ?>">
             
                <div class="row">
                    <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                        <label>Department</label>
                    </div>
                    <div class="col-md-9" >
                    <input type="text"  readonly class="form-control" name="dept" placeholder="Department" style='text-transform:uppercase' value="<?php echo $dept_description; ?>">
                      <input type="hidden"  readonly class="form-control" name="dept" placeholder="Department" style='text-transform:uppercase' value="<?php echo $dept_code; ?>">
                    </div><!-- /.col -->
                </div><br>    
                            
                
                  <div class="row">
                    <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                        <label>PR No.</label>
                    </div>
                      <div class="col-md-9">
                        <input type="text" class="form-control" name="prno" placeholder="PR No." style='text-transform:uppercase' value="<?php echo $get_control; ?>">
                      </div><!-- /.col -->
                  </div><br>                    

                  <div class="row">
                    <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                        <label>PR Date</label>
                    </div>
                      <div class="col-md-9">
                        <input type="text" class="form-control" name="prdate" placeholder="Date" style="width: 27%; text-transform:uppercase" value="<?php echo $prdate; ?>" required>
                      </div>
                    
                  </div>
                  <hr style="border-width: 1px 1px 0;
                           border-style: solid;
                           border-color: palevioletred; 
                           width: 100%;
                           margin-left: auto;
                           margin-right: auto;">

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <!-- <div class="form-group"> -->
                    <label>Section</label>
                  </div>
                  <div class="col-md-9">
                    <select class="form-control select2" id="section" style="width: 100%;" name="section" value="<?php echo $section; ?>">
                    <option selected="selected">Please select...</option>
                    <?php while ($set_section = $get_all_section_data->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $set_section['section']; ?>"><?php echo $set_section['section']; ?></option>
                    <?php } ?>
                    </select>
                  </div>
                </div><br>

                 <div class="row">
                    <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                      <label>SAI No.</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="saino" placeholder="SAI No." style='text-transform:uppercase' value="<?php echo $saino; ?>">
                      </div>

                 </div><br>


                 <div class="row">
                    <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                      <label>SAI Date</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="saidate" placeholder="Date" style="width: 27%; text-transform:uppercase" value="<?php echo $saidate; ?>" required>
                      </div>
                 </div>
                 <hr style="border-width: 1px 1px 0;
                           border-style: solid;
                           border-color: palevioletred; 
                           width: 100%;
                           margin-left: auto;
                           margin-right: auto;">

                      <div class="row">
                        <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                              <label>Requested by </label>
                        </div>
                        <div class="col-md-9">
                              <select class=" form-control select2" id="requested" style="width: 100%;" name="requested" value="<?php echo $requested; ?>">
                                <option selected="selected">Please select...</option>
                                <?php while ($get_requestedby = $get_all_requestedby_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                <option value="<?php echo $get_requestedby['firstname']; echo " "; echo $get_requestedby['middlename']; echo " "; echo $get_requestedby['lastname'];?>">
                                              <?php echo $get_requestedby['firstname'] ; echo " "; echo $get_requestedby['middlename']; echo " "; echo $get_requestedby['lastname'];?> 
                                          
                                </option>
                                <?php } ?>
                                </select>
                          </div>
                      </div> <br>

                      <div class="row">
                        <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                                <label>Prepared by </label>
                          </div>
                        <div class="col-md-9">
                              <select class=" form-control select2" id="prepared" style="width: 100%;" name="prepared" value="<?php echo $prepared; ?>">
                                <option selected="selected">Please select...</option>
                                <?php while ($get_preparedby = $get_all_prepared_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                  <option value="<?php echo $get_preparedby['firstname']; echo " "; echo $get_preparedby['middlename']; echo " "; echo $get_preparedby['lastname']; ?>"> 
                                                <?php echo $get_preparedby['firstname']; echo " "; echo $get_preparedby['middlename']; echo " "; echo $get_preparedby['lastname']; ?>
                                  </option>
                                <?php } ?>
                              </select>
                                <!-- <input type="text"  name="" class="form-control" value="<?php echo $prep_position;?>" > -->
                        </div>                     
                      </div> <br>

                      <div class="row">
                    <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                      <label>Approved By:</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="approvedby" placeholder="Approved by" style='text-transform:uppercase' value="<?php echo $approved; ?>">
                      </div>

                 </div><br>

                 <div class="row"hidden>
                    <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                      <label>Position:</label>
                    </div>
                    <div class="col-md-9">
                        <input type="hidden" class="form-control" name="position" placeholder="Position" style='text-transform:uppercase' value="<?php echo $position; ?>">
                      </div>

                 </div>

                      <div class="row"> 
                        <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                          <label>Purpose</label>
                        </div>
                        <div class="col-md-9">
                          <input type="text" class="form-control" name="purpose" placeholder="Purpose" style='text-transform:uppercase' value="<?php echo $purpose; ?>" >                            
                        </div>
                      </div><br>
               
                     <!-- pr modal save -->
                        <div class="modal fade" id="pr-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                              
                                    <p class="statusMsg"></p>
                                
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                              </div>
                            </div>
                          </div>
                        </div>
                              

                  </div> <br>
                    <div class="box-footer" align="center">
                          <input type="submit"  <?php echo $btnNew; ?> name="add" class="btn btn-primary" value="New" >
                          <input type="submit"  <?php echo $btnSave; ?> name="insert_purchase" class="btn btn-primary" value="Save" >
                      <a href="add_pr.php">
                        <input type="button" name="cancel" class="btn btn-default" value="Cancel">       
                      </a>
                    </div>
              </div>
             
             
            



            </form>





          
                    

          </div>
                
        

        


        </div>
        <!-- end card card-info -->
        </div>
      </section>
  </div>       

 
  <!-- footer here -->
   <?php include('footer.php');?>
</div>
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


<script>
      $('.select2').select2();

      $('#users').DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : false,
            'info'        : true,
            'autoWidth'   : false,
            'autoHeight'  : false
      });


      $(document).ready(function() { 
        $("#data_items").click(function() { 
          var value = $("#myselection option:selected"); 

      $('#unit').val($('#unit').val() + value);
           // alert(value.text()); 
        }); 
      });


      $(document).ready(function(){	
      $("#contactForm").submit(function(event){
        submitForm();
        return false;
      });
    });

        function submitContactForm() {
                  
                  $.ajax({
                            type:'POST',
                            url:'insert_purchase.php',
                            data:'insert_purchase',
                            success:function(msg){
                                if(msg == 'ok'){
                                    $('.statusMsg').html('<span style="color:green;">Data inserted</p>');
                                }else{
                                    $('.statusMsg').html('<span style="color:red;">Some problem occurred, please try again.</span>');
                                }
                                $('.submitBtn').removeAttr("disabled");
                                $('.modal-body').css('opacity', '');
                            }
                        });
        }
                


</script>

<script>
  













// var alertTheSelectedValue = function() {
//       var val = document.getElementById('data_itemss').value;
//       var text = $('#data_items').find('option[value="' + val + '"]').attr('id');
//            alert(text);
//     }

</script>

<script>













</script>





  </body>
</html>