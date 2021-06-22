<?php

session_start();

date_default_timezone_set('Asia/Manila');  
$prcontrolno = $prno = $prdate = $dept = $saino = $saidate = $section = $reqby = $checkby = $purpose = 
$notes = $pr_sai_no = ' ';
$currentDateTime = date('Y-m-d H:m');
// echo $currentDateTime;
$prdate = date('Y-m-d H:i');
$saidate = date('Y-m-d H:i');
$curYear = date('Y');
$reqby = '';
$reqbyposition = '';
$checkby = '';
$checkbyposition = '';

// $curdate = date('Y-m-d g:i:s  ');
// echo "<span style='color:red;font-weight:bold;'>Date: </span>". date('Y-m-d g:i:s  ');
// echo $curdate;


//if button add_user is click
if(!isset($_SESSION['id'])) {
  header('location:../index');
}
$user_id = $_SESSION['id']; 

$alert_msg = '';  
include('../config/db_config.php');

//select user




// $prinfoid = $_GET['pr_info_id'];


$get_all_department_sql = "SELECT * FROM tbl_department";
$get_all_department_data = $con->prepare($get_all_department_sql);
$get_all_department_data->execute(); 

$get_all_section_sql = "SELECT * FROM tbl_section";
$get_all_section_data = $con->prepare($get_all_section_sql);
$get_all_section_data->execute(); 

$get_all_users_sql = "SELECT * FROM tbl_pr_info where pr_info_objid = :objid and pr_info_state = 'ACTIVE'";
$get_all_users_data = $con->prepare($get_all_users_sql);
$get_all_users_data->execute([':objid'=>$_GET['objid']]);
while ($result = $get_all_users_data->fetch(PDO::FETCH_ASSOC)) {
    $dept               = $result['pr_info_dept'];
    $prno                 = $result['pr_info_no'];
    $pr_date               = $result['pr_info_date'];
    $section            = $result['pr_info_section'];
    $saino            = $result['pr_info_sai_no'];
    $pr_sai_date           = $result['pr_info_sai_date'];
    $pr_project            = $result['pr_info_project'];
    $purpose            = $result['pr_info_purpose'];
    $pr_notes              = $result['pr_info_notes'];
    $reqby              = $result['pr_info_reqby'];
    $pr_reqby_posi         = $result['pr_info_reqby_position'];
    $checkby          = $result['pr_info_checkedby'];
    $pr_checkedby_posi     = $result['pr_info_checkedby_designation'];
    $pr_control_no         = $result['pr_info_control_no'];

}



?>

<!DOCTYPE html>
<html >
<head>


<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BAC | Update PR</title>

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
     <!-- Select2 -->
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

  <link href="../plugin/bootstrap-dialog.css" rel="stylesheet" type="text/css" />

  <script src="js/bootstrap-dialog.js"></script>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include('sidebar.php');?>

    <div class="content-wrapper">
      <div class="content-header"></div>
      <section class="content animated fadeIn">
        <h1><b>(PR)</b>
          <b>Update Info</b>
        </h1>
      </section>

      <section class="content"  >
        <div class="card"style=" width: 65rem; margin:auto;float:none; " >
       
          <div class="card-body">
            <form role="form" method="post" action="<?php htmlspecialchars("PHP_SELF");?>">
              <div class="box-body">

              <?php echo $alert_msg; ?> 

                  <div class="row">
                    <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                        <label>Department</label>
                    </div>
                      <div class="col-md-9">
                        <input type="text" readonly class="form-control" name="dept" placeholder="Department" style='text-transform:uppercase' value="<?php echo $dept; ?>">
                      </div><!-- /.col -->
                  </div><br>     

                
                  <div class="row">
                    <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                        <label>PR No.</label>
                    </div>
                      <div class="col-md-9">
                        <input type="text" class="form-control" name="prno" placeholder="PR No." style='text-transform:uppercase' value="<?php echo $prno; ?>">
                      </div><!-- /.col -->
                  </div><br>                    

                  <div class="row">
                    <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                        <label>Date</label>
                    </div>
                      <div class="col-md-9">
                        <input type="text" class="form-control" name="prdate" placeholder="Date" style="width: 27%; text-transform:uppercase" value="<?php echo $prdate; ?>" required>
                      </div><!-- /.form-group
                    </div><!-- /.col -->
                  </div>
                
                   <hr style="border-width: 1px 1px 0;
                           border-style: solid;
                           border-color: palevioletred; 
                           width: 100%;
                           margin-left: auto;
                           margin-right: auto;">

                  <div class="row">
                       <div class="col-md-2" style="text-align: right;padding-top: 5px;">                      
                          <label>Section</label>
                      </div>
                      <div class="col-md-9 " > 
                      <select class="form-control select2"  style="width: 100%;" id="department" name="department" value="<?php echo $type; ?>">
                        <!-- <option>Please select...</option>
                      <?php while ($get_section_data = $get_all_section_data->fetch(PDO::FETCH_ASSOC)) { ?> -->
                      <?php
                          //if $get_author naa value, check nato if equals sa $get_author1['fullname']
                          //if equals, put 'selected' sa option
                          $selected = ($section == $get_section_data['section'])? 'selected':'';

                      ?>
                      <option <?=$selected;?> value="<?php echo $get_section_data['section']; ?>"><?php echo $get_section_data['section']; ?></option>
                      <?php } ?>
                        </select>
                      </div>
                  </div> <br>    
                  <div class="row"> 
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>SAI No.</label>
                  </div>
                  <div class="col-md-9">
                      <input type="text" class="form-control" name="saino" placeholder="PR SAI No." style='text-transform:uppercase' value="<?php echo $saino; ?>" > 
                      <!-- <input type="hidden" class="form-control" name="issuedby" value="<?php echo $db_userfullname; ?>" required>                        -->
                  </div>
                </div><br>                 

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                      <label>Date</label>
                  </div>
                    <div class="col-md-9">
                      <input type="text" class="form-control" name="saidate" placeholder="Date" style="width: 27%; text-transform:uppercase" value="<?php echo $saidate; ?>" >
                        <!--  <input type="hidden" class="form-control" name="isdate" value="<?php echo $isdate; ?>" > -->
                    </div><!-- /.form-group
                  </div><!-- /.col -->
                </div>
                <hr style="border-width: 1px 1px 0;
                           border-style: solid;
                           border-color: palevioletred; 
                           width: 100%;
                           margin-left: auto;
                           margin-right: auto;">


          

                <div class="row"> 
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Requested By</label>
                  </div>
                  <div class="col-md-10">
                      <input type="text" class="form-control" name="reqby" placeholder="Requested By" style='text-transform:uppercase' value="<?php echo $reqby; ?>" >  
                     
                    </select>  
                  </div>
                </div><br>

                <div class="row"> 
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Checked By</label>
                  </div>
                  <div class="col-md-10">
                      <input type="text" class="form-control" name="checkby" placeholder="Checked By" style='text-transform:uppercase' value="<?php echo $checkby; ?>" > 
                      <!-- <input type="hidden" class="form-control" name="issuedby" value="<?php echo $db_userfullname; ?>" required>                        -->
                  </div>
                </div><br>





                <div class="row"> 
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                   <label>Purpose</label>
                  </div>
                  <div class="col-md-10">
                      <input type="text" class="form-control" name="purpose" placeholder="Purpose" style='text-transform:uppercase' value="<?php echo $purpose; ?>" > 
                      <!-- <input type="hidden" class="form-control" name="receivedby" value="<?php echo $receivedby; ?>" required>                        -->
                  </div>
                </div><br>




                
        
              
              
              </div>
              
              
            </form>


          
          
          
          
          </div>
        
        </div>
      </section>
    </div>  
    <?php include('footer.php');?>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- PACE -->
<script src="../bower_components/pace/pace.min.js"></script>
<!-- Select2 -->
<script src="../bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

<script src="../plugins/select2/select2.full.min.js"></script>




<script type="text/javascript">

  $(document).ready(function() {

    $(document).ajaxStart(function () {
      Pace.restart()
    })  

  });

  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  });

   function run1() {
      document.getElementById("iunit").value = document.getElementById("idesc").value;
  }
</script>

<script>
$(document).ready(function(){
    $('#office').on('change', function(){
        var officeID = $(this).val();
        if(officeID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'office_id='+officeID,
                success:function(html){
                    $('#state').html(html);
                }
            }); 
        }else{
            $('#personnel').html('<option value="">Select area first</option>');
        }
    });
    
    $('#personnel').on('change', function(){
        var personnelID = $(this).val();
        if(personnelID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'personnel_id='+personnelID;
                }
            }); 
        }
    });
});
</script>



</body>
</html>




