<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>
<?php include 'includes/sidebar.php'; ?>

<?php include 'insert_sss.php'; ?>

   <!-- Content Header (Page header) -->


  <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m=o text-dark">
     <img class="brand-image img-square "  
                       src="../dist/img/SSS_logo.png"
                       alt="User profile picture" width="30" height="30"> Social Security System
        <!-- <small>Version 2.0</small> -->
      </h1>
      </div>
      <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right text-xs">
      <li class="breadcrumb-item"><a href="index">Home</a></li>
      <li class="breadcrumb-item active">Deduct</li>
         </ol>
         </div>




     <!-- Main content -->
           <div class="card-body"> 
           <div class="container">
            <div align="center">
               <?php echo $alert_msg; ?>
             </div>
            <form method="post" action="" enctype="multipart/form-data">   


             
             
                  
                <hr>
                <div class="form-group"> 
                      <div class="row">
          <div class="col-lg-11">
                      <div class="card card-outline card-success" style="background-color: #d8d8fe;margin-left:70px">
              <div class="card-header">
                 <h5 class="card-title"><i>  <?php if ($get_photo=='') {?>
      <img class="img-square elevation-5" id="image" src="../dist/img/no-photo-icon.png" width="100" height="100" vspace="5" alt="User Avatar">

<?php }elseif($get_photo<>'') {?>
      <img class="img-square elevation-5" id="image"
                       src="<?php echo (!empty([$get_photo])) ? '../dist/photo/'.$get_photo : '../dist/photo/no-photo-icon.png'; ?>"
                       width="100" height="100" vspace="5" alt="User Avatar">

                
<?php } ?> <label style="text-align:right; font-size: 30px;"><i>  <?php echo  $get_firstn. " " . $get_middlen[0] ."." . " " . $get_lastn;?></i></label></b></i></h5>
                 <br>
                 <h6> <i class="bg-yellow"><?php echo  $get_sched_code;?></i></h6>
                  </div>
               


                   <div class="card-body">

                     <input type="hidden"  value="<?php echo $get_emp_code?>" readonly class="form-control">

              <div class="modal-body">
                  <div class="row">
                  <div class="col-md-7"> 
                  <div class="form-group"> 
                  
                   
                 

                </div>
            </div>

<input type="hidden"  value="<?php echo $get_firstn?>" id="joName" name="name" readonly class="form-control"> 

                 <div class="col-md-5"> 
                   <div class="form-group"> 
                    
                    <input type="hidden"  id="code" name="empcode" value="<?php echo  $get_sched_code?>"readonly class="form-control">
            </div>
             </div>
              </div>

                 
                   
                  
                  <input type="hidden"  id="payrollno" name="payrollno" value="<?php echo $get_payrollno;?>" readonly class="form-control">
            
                  
                 <div class="row">
                    <div class="col-sm-7">
                      <div class="form-group"> 
                           <label>Pag-Ibig Covered Month: </label>
                   <select class="form-control custom-select" value="<?php echo "Month"?>" <?php echo $month?> name="coveredmonth">
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
                           <label> Year: </label>
                   <select class="form-control custom-select" <?php echo $month?> value="<?php echo "Year"?>" name="year">
                   <option selected disabled>Year</option>
                  <?php while ($get_name = $get_year_data->fetch(PDO::FETCH_ASSOC)) { ?>

                    <option value="<?php echo
   $get_name['year']; ?>"><?php echo  $get_name['year']?></option> <?php } ?>
                </select>
              </div>
                      </div>
    
                      

            <div class="col-md-2"> 
                   <div class="form-group"> 
                    <label> Amount: </label>
                    <input type="text" id="sssamount" <?php echo $month?> name="sssamount" class="form-control">
                  </div>
                    </div>
                    </div>
                </div>
                    <br>
<hr>
                    <div class="footer">
                       <a class="btn btn-default btn-l float-left" align="left" href="see_jo.php?objid=<?php echo $get_id_no?>" value="Back" ><i class="fa fa-back-arrow"></i> Back</a>

                     <button type="submit" class="btn btn-success btn-l float-right" <?php echo $btnStatus?> name="insert" value="save" ><i class="fa fa-check"></i> Proceed</button>



                     </div>
              </form>
                        
    </div>
  </div>

</div>
</div>

 
                    </div>
                      </div>

                    </div>
                  

                  
                     </div>
                   </div>
                 </div>
               </div>
             </div>
        </div>   
           </div>
             </div>
        </div>   



 <!-- Content-Wrapper End -->
</div> 

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
                 $('#balance').val(result.balance);
            },
            error: function (xhr, b, c) {
                console.log("xhr=" + xhr + " b=" + b + " c=" + c);
            }
        });


    }); 

    
    function sync(int)
{
  var rate1 = document.getElementById('rate1');
  var day1 = document.getElementById('day1');
  var rate2 = document.getElementById('rate2');
  var day2 = document.getElementById('day2');
  var rate3 = document.getElementById('rate3');
  var day3 = document.getElementById('day3');
  var total = document.getElementById('total');
  total.value = (rate1.value*day1.value)+(rate2.value*day2.value)+(rate3.value*day3.value);
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
