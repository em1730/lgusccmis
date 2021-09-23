<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/navbar.php'; ?>
<?php include 'includes/update_edit_jo.php'; ?>
<?php include 'delete_jo_sched.php'; ?>



 <!-- Main content -->
          <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m=o text-dark">
        Alteration    </h1>
        <div class="col-sm-4">
                      <div class="form-group">
                        <label>Job Order No.</label>
                        <input type="text" class="form-control" name="EmpMname" value="<?php echo $details_no;?>" required>
                      </div>
                    </div>

                      <div class="form-group">
                        <label>Job Order No.</label>
                        <input type="text" class="form-control" name="EmpMname" value="<?php echo $JobOrder;?>" required>
                      </div>
                    </div>
                </div>
        <!-- <small>Version 2.0</small> -->
   
<!-------------------- modals here --------------------------------->

<div id="myModal" class="modal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
    
    <div class="modal-header bg-info">
              <h3><i class="fa fa-plus"></i> ADD</h3>
               <span class="close">&times;</span>
           
        </div>
     <form class="form-horizontal" method="POST" action="insert_edit_jo.php">

               
              <div class="modal-body">
                 

<input type="hidden" name="jo_no" id="jonumber1" value="" class="form-control">  

<input type="hidden" name="jo_last" id="jo_last" value="" class="form-control">     

<input type="hidden" name="jo_middle" id="jo_middle" value="" class="form-control">     
     
<input type="hidden" name="jo_photo" id="jo_photo" value="" class="form-control">  

<input type="hidden" name="jo_total" id="jo_total" value=" " class="form-control">     
      
<input type="hidden" name="jo_total_amount" id="jo_total_amount" value="<?php echo $jo_total_amunt?>" class="form-control">     
            
     

                  <div class="form-group"> 
                     <div class="row">
                      <div class="col-sm-8">
                    <label> Name: </label>
                      <select class="form-control custom-select" id="joName" name="name">
                  <option selected>Please select....</option>
                  <?php while ($get_name = $get_all_emp1_data->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo
   $get_name['EmpFname']; ?>"><?php echo $get_name['EmpFname']. " " . $get_name['EmpMname'][0] ."." . " " . $get_name['EmpLname'] ?></option> <?php } ?>
                </select>
              </div>
          

                <div class="col-sm-4">
                      <div class="form-group">
                        <label>Code</label>
                        <input type="text"  id="code" name="empcode" class="form-control" readonly></div>
                      </div>
          </div>
                  
              <div class="form-group"> 
                     <div class="row">
                    <div class="col-sm-6">
                    <label style="font-size:28px"> Covered Period </label>
                  </div>
                </div>
              
              <div class="form-group"> 
                     <div class="row">
                    <div class="col-sm-6">
                 <label style="font-size:14px"> Regular Schedule </label>
                  </div>
                </div>
              </div>
                   <div class="row">
                    <div class="col-sm-3">
                        <div class="input-group">
                   <select class="form-control custom-select" name="period">
                  <option selected disabled>Month</option>
                  <option>January</option> 
                  <option>February</option> 
                  <option>March</option>
                  <option>April</option> 
                  <option>May</option> 
                  <option>June</option> 
                  <option>July</option>
                  <option>August</option>  
                   <option>September</option> 
                  <option>October</option> 
                  <option>November</option>
                  <option>December</option>  
                </select>
                      </div>
                      </div>

                      <div class="col-sm-3">
                      <div class="form-group">
                     <input type="text"  name="jo_regdays" class="form-control" placeholder="Specific days" ></div>
                      </div>      

                      <div class="col-sm-2">
                      <div class="form-group">
                     <input type="text" readonly class="form-control" name="jo_years" value= <?php echo $now_year= date('Y');?> ></div>
                      </div>           
     

                    <div class="col-sm-4">                  
                         <select class="form-control custom-select" name="time1">
                  <option selected disabled>Time</option>
                  <?php while ($get_time = $get_time_data->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo
    $get_time['TimeSched']; ?>"><?php echo $get_time['TimeSched']?></option> <?php } ?>
                </select>
                      </div>                      
                    </div>
                  
                     <div class="row">
                    <div class="col-sm-3">
                      <div class="input-group">               
                        <select class="form-control custom-select" name="rate">
                  <option selected disabled>Php</option>
                  <?php while ($get_rate = $get_rate_data->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo
    $get_rate['Salary']; ?>"><?php echo $get_rate['Salary']?></option> <?php } ?>
                </select>
                      </div>
                    </div>

                   

                       <div class="col-sm-3">
                      <div class="input-group">                  
                      <select class="form-control custom-select" name="schedule">
                  <option selected>--</option>
                  <option>Saturdays</option> 
                  <option>Sundays</option> 
                  <option>Saturdays and Sundays</option>
                  <option>Holidays</option>  
                  <option>Saturdays, Sundays and Holidays</option>
                  <option>NO NOON BREAK</option>
                  <option>Monday-Sunday</option>
                  <option>Monday-Saturday</option>
                  <option>Monday-Friday</option>
                </select>
                      </div>
                      </div>

                      <p> No. of days:</p>

                        <div class="col-sm-1">
                      <div class="form-group">
                     <input type="number" placeholder="0" name="jo_day1" class="form-control" id="day1"></div>
                      </div>           
     
                    </div>


                    <div class="form-group"> 
                      <div class="row">
          <div class="col-lg-12">
                      <div class="card card-outline card-info" style="background-color: #fefbd8;">
              <div class="card-header">
                 <h5 class="card-title"><i> Additional Schedule</i></h5>
                 <div class="card-tools">
                      <span class="badge badge-danger" ></span>
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                  </div>
                </div>
            

               <div class="card-body collapse">
                          <div class="row">
                    <div class="col-sm-3">
                      <div class="input-group">                     
                      <select class="form-control custom-select" name="jo_month1">
                  <option selected disabled>Month</option>
                  <option>January</option> 
                  <option>February</option> 
                  <option>March</option>
                  <option>April</option> 
                  <option>May</option> 
                  <option>June</option> 
                  <option>July</option>
                  <option>August</option>  
                   <option>September</option> 
                  <option>October</option> 
                  <option>November</option>
                  <option>December</option>  
                </select>
                      </div>
                      </div>
            
                <div class="col-sm-3">
                      <div class="form-group">
                     <input type="text"  name="jo_days1" class="form-control" placeholder="Specific days" ></div>
                      </div>
             
                 

                    <div class="col-sm-3">
                      <div class="input-group">                    
                         <select class="form-control custom-select" name="jo_time1">
                  <option selected disabled>Time</option>
                  <?php while ($get_time1 = $get_time1_data->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo
    $get_time1['TimeSched']; ?>"><?php echo $get_time1['TimeSched']?></option> <?php } ?>
                </select>
                      </div>
                    </div>

                    <div class="col-sm-2">
                      <div class="input-group">                     
                        <select class="form-control custom-select" name="jo_rate1">
                  <option selected disabled>Php</option>
                  <?php while ($get_rate1 = $get_rate1_data->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo
    $get_rate1['Salary']; ?>"><?php echo $get_rate1['Salary']?></option> <?php } ?>
                </select>
                      </div>
                    </div>


                        <div class="col-sm-1">
                      <div class="form-group">
                     <input type="number" placeholder="0" name="jo_day2" class="form-control"id="day2"></div>
                      </div>           
     
                    </div>


                   

                     <div class="row">
                    <div class="col-sm-3">
                      <div class="input-group">                     
                      <select class="form-control custom-select" name="jo_month2">
                  <option selected disabled>Month</option>
                  <option>January</option> 
                  <option>February</option> 
                  <option>March</option>
                  <option>April</option> 
                  <option>May</option> 
                  <option>June</option> 
                  <option>July</option>
                  <option>August</option>  
                   <option>September</option> 
                  <option>October</option> 
                  <option>November</option>
                  <option>December</option>  
                </select>
                      </div>
                      </div>
            
                <div class="col-sm-3">
                      <div class="form-group">
                     <input type="text"  name="jo_days2" class="form-control" placeholder="Specific days" ></div>
                      </div>
                  

                    <div class="col-sm-3">
                      <div class="input-group">                    
                         <select class="form-control custom-select" name="jo_time2">
                  <option selected disabled>Time</option>
                  <?php while ($get_time2 = $get_time2_data->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo
    $get_time2['TimeSched']; ?>"><?php echo $get_time2['TimeSched']?></option> <?php } ?>
                </select>
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="input-group">                        
                        <select class="form-control custom-select" name="jo_rate2">
                  <option selected disabled>Php</option>
                  <?php while ($get_rate2 = $get_rate2_data->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo
    $get_rate2['Salary']; ?>"><?php echo $get_rate2['Salary']?></option> <?php } ?>
                </select>
                      </div>
                    </div>

                    <div class="col-sm-1">
                      <div class="form-group">
                     <input input type="number" placeholder="0" name="jo_day3"class="form-control" id="day3"></div>
                      </div>           
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

                   
                
          <div class="modal-footer">    
           
                       <div class="col-sm-2">
                      <div class="input-group"> 
                      <button class="button" name="insert"><span> Proceed</span></button>
                    </div>
                    </form>
                    </div>
                  </div>
                </div>
                </div>
              </div>
                  <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->






</div> <?php include 'includes/footer.php'; ?>
 <!-- Content-Wrapper End -->
</div> 

<?php include 'includes/scripts.php'; ?>

<script>
 // Get the modal
var modal2 = document.getElementById("myModal2");

// Get the button that opens the modal
var btn2 = document.getElementById("myBtn2");

// Get the <span> element that closes the modal
var span2 = document.getElementsByClassName("close2")[0];

// When the user clicks the button, open the modal 
btn2.onclick = function() {
  modal2.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
span2.onclick = function() {
  modal2.style.display = "none";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal2.style.display = "none";
}
}
</script>
 


 <script>
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
                $('#jo_last').val(result.last);
                $('#jo_middle').val(result.middle);
                 $('#jo_photo').val(result.photo);
                                                     
            
          },
            error: function (xhr, b, c) {
                console.log("xhr=" + xhr + " b=" + b + " c=" + c);
            }
        });


    }); 

       $('#joName').on('click',function(){
             var type = $(this).val();
            //  $('#doc_no').val(type);
      
         
            $.ajax({
              type:'POST',
              data:{type:type},
              url:'getJoNo.php',
               success:function(data){
             $('#jonumber1').val(data);
            

            } 
                 
                });           
                        
                      });

     $('#joName').on('click',function(){
             var type = $(this).val();
            //  $('#doc_no').val(type);
      
         
            $.ajax({
              type:'POST',
              data:{type:type},
              url:'fetch_no.php',
               success:function(data){
             $('#jo_total').val(data);
            

            } 
                 
                });           
                        
                      });

  
function sync()
{
  var jonumber = document.getElementById('jonumber');
  var jonumber1 = document.getElementById('jonumber1');
  
  jonumber1.value = jonumber.value;
 
   
  }


 
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
