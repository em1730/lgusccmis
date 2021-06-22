<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/navbar.php'; ?>
<?php include 'insert_joborder.php'; ?>
<?php include 'includes/scripts.php'; ?>
   <!-- Content Header (Page header) -->

<?php

if (isset($_GET['JobOrderNo'])) {
    //select filename
$new = $_GET['JobOrderNo'];
$get_schedule_sql = "SELECT * FROM schedule WHERE JobOrderNo = :id";
$get_schedule_data = $con->prepare($get_schedule_sql);
$get_schedule_data->execute([':id'=>$new]); 
while ($result = $get_schedule_data ->fetch(PDO::FETCH_ASSOC)) {
  $new   = $result['JobOrderNo'];
}
$new = $_SESSION['JobOrderNo'];

}
?>
  <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m=o text-dark">
      Create Job Order
        <!-- <small>Version 2.0</small> -->
      </h1>
      </div>
      <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right text-xs">
      <li class="breadcrumb-item"><a href="index">Home</a></li>
      <li class="breadcrumb-item active">Job Order</li>
         </ol>
         </div>



     <!-- Main content -->
           <div class="card-body"> 
           <div class="container">
            <div align="center">
               <?php echo $alert_msg; ?>
             </div>
           <i style="font-size:17px"><i style="color:red" align="center">*Fill up the form completely.</i></i>  
            <form method="post" action="" enctype="multipart/form-data">     
             
              <div class="jumbotron">
              <div class="row">         

             
      
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label align="right">Job Order No.</label>
                          <div class="input-group">
                    <div class="input-group">
                      <span class="input-group-append">
                    <input type="text" name="jonumber" id="jonumber" value="" class="form-control"  onkeyup="sync()" >
                  </div>
                  
                  </div>
                    </div>
                  </div></div>
                  <hr class="dashed">

                  
                  <div class="row">
                  <div class="col-sm-8">
                      <div class="form-group">
                        <label>Project Name</label>
                        <select class="form-control custom-select" id="prjName" name="project_name" >
                  <option selected>Please select....</option>
                  <?php while ($get_project = $get_project_data->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo
    $get_project['ProjectName']; ?>"><?php echo $get_project['ProjectName']; ?></option> <?php } ?>
                </select>
                      </div>
                    </div>
                  </div>


                    <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Charges</label>
                        <input type="text" id="charges" class="form-control" name="charges" required>
                      </div>
                    </div>

                       <div class="col-sm-4">
                      <div class="form-group">
                        <label>Project Budget</label>
                        <input type="text" id="budget" class="form-control" name="budget" required>
                      </div>
                      </div>

                       <div class="col-sm-4">
                      <div class="form-group">
                        <label>Previous Balance</label>
                        <input type="text" id="balance" class="form-control" name="previous" required>
                      </div>
                      </div></div>
                      <hr>

                       <div class="container">
                        <i style="font-size:16px"><i style="color:blue" >Laborers are directed to proceed to jobsite namely:</i></i> 
                    <div class="card card-outline card-secondary">
                <div class="card-body">
             <div class="form-group">
                  <div class="row">               
                    <div class="col-sm-12">
                      <div class="form-group">
                        <div class="card-body">
                    <!-- Post -->
                      <h3>List of Employees                     
         <button type="button" href="#myModal" id="myBtn" class="btn btn-success">Add Job Order</button></h3>
       </div>
              
                    <form role="form" method="get" action="<?php htmlspecialchars("PHP_SELF"); ?>"> 
               
              <div class="card-body"style="overflow-x:auto;">
                <table id="user" class="table" cellspacing="1" cellpadding="8"  border="3px white;" border-collapse="collapse;"
  border-spacing="0;" width= "100%;">
                  <thead>
                    <tr bgcolor="lightgreen">
                      <th style="text-align:center;">No.</th>
                     <th style="text-align:center;">Name</th>
                       <th style="text-align:center;">Period</th>
                       <th style="text-align:center;">Time</th>
                       <th style="text-align:center;">Rate</th>
                       <th style="text-align:center;">With</th>
                       <th style="text-align:center;">Option</th>
                    </tr>
                  </thead>
                  <tbody>
                          <?php while ($sched_data= $get_schedule_data-> fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                    
                    <td style="text-align:center;"><?php echo $sched_data['id'];?></td>
                    <td><?php echo $sched_data['Name'];?></td>
                     <td><?php echo $sched_data['Period'];?></td>
                      <td><?php echo $sched_data['Time1'];?></td>
                       <td><?php echo $sched_data['Rate'];?></td>
                        <td><?php echo $sched_data['Schedule'];?></td>
                     

                   <td align="center">
                          <a class="btn btn-outline-success btn-xs" href="employeedetails.php?ID=<?php echo $emp_data['ID']; ?>" data-toggle="tooltip" title="Profile Details"><i class="fa fa-edit"  style="font-size:25px"></i>
                          </a>  
                          <a class="btn btn-outline-danger btn-xs" href="employeedetails.php?ID=<?php echo $emp_data['ID']; ?>" data-toggle="tooltip" title="Profile Details"><i class="fa fa-trash"  style="font-size:25px"></i>
                          </a>  
                        
                       
                    </td>

                          </tr>
                      
                   <?php } ?>  
                  </tbody>
                </table>
              </div>
                <div class="row">
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>No. of Laborers</label>
                        <input type="text" id="laborers" class="form-control" name="laborers" required>
                      </div>
                    </div>
                  
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Total Amount</label>
                      <input type="text" id="amount" class="form-control" name="amount" required>
                      </div>
                      </div>

          </div>
          
        </div>

    <!-- /.post -->
                    </div>   
 <!-- /.tab-pane -->
                </section> </form>

              </div>
                     </div>  
              </div>
            </div>

</form>


</div> <?php include 'includes/footer.php'; ?>
 <!-- Content-Wrapper End -->
</div> 

<!-------------------- modals here --------------------------------->

<div id="myModal" class="modal">
      <div class="modal-dialog">
        <div class="modal-content ">
      
    <div class="modal-header bg-info">
              <h4>Add</h4>
               <span class="close">&times;</span>
           
        </div>
     <form class="form-horizontal" method="POST" action="insert_jo.php">

               
              <div class="modal-body">
                  <div class="form-group"> 
                    <input type="hidden"  id="code" name="empcode" class="form-control" >
                  </div>


           
       <img class="img-circle elevation-5 center" id="image" src="../dist/photo/no-photo-icon.png" width="300" height="200" vspace="10" alt="User Profile picture"> 


 <input type="Hidden" name="jo_no" id="jonumber1" value="" class="form-control">      
     
   
      
        <input class="text-sm" type ="hidden" name="myFiles" id="fileToUpload" onchange="loadImage()">          
     

                  <div class="form-group"> 
                     <div class="row">
                      <div class="col-sm-12">
                    <label> Name: </label>
                      <select class="form-control custom-select" id="joName" name="name" onclick="copy()">
                  <option selected>Please select....</option>
                  <?php while ($get_name = $get_all_emp1_data->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo
   $get_name['EmpFname']; ?>"><?php echo $get_name['EmpFname']. " " . $get_name['EmpMname'][0] ."." . " " . $get_name['EmpLname'] ?></option> <?php } ?>
                </select>
              </div>
            </div>
          </div>
                  

                  <div class="form-group"> 
                     <div class="row">
                    <div class="col-sm-6">
                    <label> Period </label>
                   <div class="input-group date mb-3">
                <div class="input-group-addon input-group-prepend">
                <span class="input-group-text "><i class="fa fa-calendar"></i></span>  </div>
                <input type="text" name="datefilter" class="form-control" value="Period Covered" />
                      </div>
                    </div>

                         <div class="col-sm-6">
                      <div class="form-group">
                    <label> Time </label>
                    <select class="form-control custom-select" name="time1">
                  <option selected>Time</option>
                  <?php while ($get_time = $get_time_data->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo
    $get_time['Time']; ?>"><?php echo $get_time['Time']?></option> <?php } ?>
                </select>
              </div>
            </div>
          </div>
         
                      <div class="form-group"> 
                     <div class="row">
                    <div class="col-sm-6">
                    <label> Rate </label>
                   <select class="form-control custom-select" name="rate">
                  <option selected>Php</option>
                  <?php while ($get_rate = $get_rate_data->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo
    $get_rate['Salary']; ?>"><?php echo $get_rate['Salary']?></option> <?php } ?>
                </select>
              </div>

                

                   <div class="col-sm-6">
                      <div class="form-group">
                    <label> With </label>
                   <select class="form-control custom-select" name="schedule">
                  <option selected>--</option>
                  <option>Saturdays</option> 
                  <option>Sundays</option> 
                  <option>Sats and Suns</option>
                  <option>Holidays</option>  
                </select>
                  </div>
                </div>
              </div>
            </div>
         
                
          <div class="modal-footer">         
                      <button class="button" name="insert"><span><i class="fa fa-check"> Proceed </i></span></button>
                    </div>
                    </form>
                    </div>
                  </div>
                </div>
                
                
<?php include 'includes/scripts.php'; ?>
 
 <script>
   $('#prjName').on('click', function() {
        var prjName = this.value;
        $.ajax({
            type:"POST",
            url:'fetch_project.php',
            data:{prj_name:prjName},
         
            success:function(response){
              var result = jQuery.parseJSON(response);
                console.log('response from server',result);
                $('#charges').val(result.data);
                $('#budget').val(result.budget);
            },
            error: function (xhr, b, c) {
                console.log("xhr=" + xhr + " b=" + b + " c=" + c);
            }
        });


    }); 

    $('#joName').on('click', function() {
        var joName = this.value;
        $.ajax({
            type:"POST",
            url:'fetch_code.php',
            data:{jo_name:joName},
         
            success:function(response){
              var result = jQuery.parseJSON(response);
                console.log('response from server',result);
                $('#code').val(result.data);
                $('#fileToUpload').val(result.photo);
                $('#image').src='../dist/photo/'.val(result.photo);
            
          },
            error: function (xhr, b, c) {
                console.log("xhr=" + xhr + " b=" + b + " c=" + c);
            }
        });


    }); 

    function sync()
{
  var jonumber = document.getElementById('jonumber');
  var jonumber1 = document.getElementById('jonumber1');
  jonumber1.value = jonumber.value;
}


    $('#prjName').on('change',function(){
             var type = $(this).val();
            //  $('#doc_no').val(type);
      
         
            $.ajax({
              type:'POST',
              data:{type:type},
              url:'orderjono.php',
               success:function(data){
             $('#jonumber').val(data);


            } 
                 
                });           
                        
                      });




   // Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>





<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


<script>
$(function() {

  $('input[name="datefilter"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
  });

  $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
  });

  $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });

});

</script>
 
</body>
</html>