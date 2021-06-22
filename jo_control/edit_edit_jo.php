<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<?php include 'update_jo.php'; ?>
<?php include 'delete_jo_sched.php'; ?>

   <!-- Content Header (Page header) -->


  <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m=o text-dark">
      Edit
        <!-- <small>Version 2.0</small> -->
      </h1>
      </div>
      <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right text-xs">
      <li class="breadcrumb-item"><a href="index">Home</a></li>
      <li class="breadcrumb-item active">Edit</li>
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
                 <div class="col-12">
                 <label style="text-align:right; font-size: 30px;"><i>Job Order #:</i> <b class="mb-0 font-weight-bold bg-yellow"><?php echo $no_jobOrder;?></b></label>
               </div>
             </div>

             <input type="hidden" class="form-control" name="EmpCode" value="<?php echo  $get_sched_code;?>">

             <input type="hidden" class="form-control" name="id" value="<?php echo  $id;?>">

              <div class="row">
                <div class="col-12 col-sm-3">
               <div class="widget-user-image" align="left">
             <?php if ($get_photo=='') {?>
      <img class="img-square elevation-5" id="image" src="../dist/img/no-photo-icon.png" width="170" height="170" vspace="5" alt="User Avatar">

<?php }elseif($get_photo<>'') {?>
      <img class="img-square elevation-5" id="image"
                       src="<?php echo (!empty([$get_photo])) ? '../dist/photo/'.$get_photo : '../dist/photo/no-photo-icon.png'; ?>"
                       width="170" height="170" vspace="5" alt="User Avatar">

                
<?php } ?>
</div>
            <br>

            <div class="col-sm-8">
                      <div class="row">
                        <input type="text" style="text-align: center; font-size: 18px" class="form-control" name="code"  value="<?php echo  $get_sched_code;?>" readonly>
                        <label style="text-align: center"><i class="bg-yellow">Identification Card No</i></label>
                      </div>
                  </div>
                </div>

              <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-sm-8">
                      <div class="form-group">
                     <b> <label style="text-align:right; font-size: 30px;"><i> <?php echo  $get_firstn. " " . $get_middlen[0] ."." . " " . $get_lastn;?></i></label></b>
                      </div>
                       </div>

                       <p> Item no.</p>
                      <div class="col-sm-1">
                      <div class="form-group">
                       <input type="text" style="text-align: center; font-size: 13px" class="form-control" name="no"  value="<?php echo  $no;?>">  
                      </div>
                       </div>
                       </div>
            

                  <hr>
                   <div class="form-group"> 
                     <div class="row">
                    <div class="col-sm-6">
                    <label> Regular Schedule </label>
                  </div>
                </div>
              </div>

             <div class="row">
                    <div class="col-sm-4">
                   <div class="input-group">
                   <select class="form-control custom-select"  name="Period">
                  <option selected><b><?php echo $get_month1?></b></option>
                  <option> </option>
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

                            

                    <div class="col-sm-5">
                      <div class="form-group">
                     <input type="text"  name="RegDays" class="form-control"  value="<?php echo $get_days1?>" placeholder="Specific days" ></div>
                      </div>      

                                            <div class="col-sm-3">
                      <div class="form-group">
                     <input type="text" class="form-control" value= <?php echo $now=date('Y');?> readonly></div>
                      </div>  
                       </div>            
     
           <input type="hidden"  name="TotalAmount" id="total" class="form-control" value="<?php echo $get_rate1*$get_day1?>" placeholder="Total Amount" >

                    <div class="row">
                    <div class="col-sm-5">
                      <div class="form-group">                  
                         <select class="form-control custom-select"  name="Time1">
                  <option selected disabled>Time</option>
                   <option> </option>
                  <?php while ($get_timer1 = $get_time_data->fetch(PDO::FETCH_ASSOC)) { ?>
                    <?php
                    $selected = ($get_time1  ==  $get_timer1['TimeSched'])? 'selected':'';?>
                    <option <?=$selected;?> value="<?php echo
    $get_timer1['TimeSched']; ?>"><?php echo $get_timer1['TimeSched']?></option> <?php } ?>
     </select>
                  </div>
                      </div>  

                      <div class="col-sm-3">
                      <div class="input-group">               
                        <select class="form-control custom-select" onchange="sync()" id="rate1" name="Rate">
                  <option selected disabled>Php</option>
                  <?php while ($get_rate = $get_rate_data->fetch(PDO::FETCH_ASSOC)) { ?>
                     <?php
                    $selected = ($get_rate1  ==  $get_rate['Salary'])? 'selected':'';?>
                    <option <?=$selected;?> value="<?php echo
    $get_rate['Salary']; ?>"><?php echo $get_rate['Salary']?></option> <?php } ?>
                </select>
                      </div>
                    </div>


                    <div class="col-sm-4">
                      <div class="input-group">                  
                      <select class="form-control custom-select" name="Schedule">
                  <option selected><?php echo $get_schedule?></option>
                   <option> </option>
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
                       </div>

                       <div class="row"> 
                      <div class="col-sm-2">
                      <div class="form-group">
                        <b><p>No. of days =</p></b>
                      </div>
                    </div>

                        <div class="col-sm-1">
                      <div class="form-group">
                     <input type="text" name="Day1"  id="day1" Placeholder="0" onchange="sync()" class="form-control" value="<?php echo $get_day1?>"></div>
                      </div>           
     
                    </div>
                  </div>
                  </div>


                
                  
                <hr>
                <div class="form-group"> 
                      <div class="row">
          <div class="col-lg-12">
                      <div class="card card-outline card-info" style="background-color: #fefbd8;">
              <div class="card-header">
                 <h5 class="card-title"><i> Additional Schedule</i></h5>
                  </div>
               


                   <div class="card-body">

                     <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">      
                       <b> <label style="text-align:left; font-size: 18px;"><i> Month</i></label></b>
                      </div>
                    </div>
                  

                        <div class="col-sm-3">
                      <div class="form-group">      
                    <b> <label style="text-align:left; font-size: 18px;"><i> Specific days</i></label></b>
                      </div>
                    </div>
                 

                        <div class="col-sm-3">
                      <div class="form-group">      
                    <b> <label style="text-align:left; font-size: 18px;"><i> Time</i></label></b>
                      </div>
                    </div>
          

                        <div class="col-sm-2">
                      <div class="form-group">      
                    <b> <label style="text-align:left; font-size: 18px;"><i> Rate</i></label></b>
                      </div>
                       </div>

                       <div class="col-sm-1">
                      <div class="form-group">      
                    <b> <label style="text-align:left; font-size: 12px;"><i> No. of Days</i></label></b>
                      </div>
                       </div>
                     </div>


                 

                          <div class="row">
                    <div class="col-sm-3">
                      <div class="input-group">                     
                      <select class="form-control custom-select"  name="Month1">
                  <option selected><?php echo $get_month2?></option>
                   <option> </option>
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
                     <input type="text"  name="Days1" class="form-control" value="<?php echo $get_days2?>" placeholder="Specific days" ></div>
                      </div>
             
                 

                    <div class="col-sm-3">
                      <div class="input-group">                    
                         <select class="form-control custom-select" placeholder="Time"  name="Time2">
                   <option>00:00</option>
                  <?php while ($get_timer2 = $get_time3_data->fetch(PDO::FETCH_ASSOC)) { ?>
                    <?php
                    $selected = ($get_time2  ==  $get_timer2['TimeSched'])? 'selected':'';?>
                    <option <?=$selected;?> value="<?php echo
    $get_timer2['TimeSched']; ?>"><?php echo $get_timer2['TimeSched']?></option> <?php } ?>
     </select>
                      </div>
                    </div>

                    <div class="col-sm-2">
                      <div class="input-group">                     
                        <select class="form-control custom-select" onchange="sync()" id="rate2" placeholder="Php" name="Rate1">
                   <option>0.00</option>
                  <?php while ($get_rate = $get_rate1_data->fetch(PDO::FETCH_ASSOC)) { ?>
                    <?php
                    $selected = ($get_rate2  ==  $get_rate['Salary'])? 'selected':'';?>
                    <option <?=$selected;?> value="<?php echo
    $get_rate['Salary']; ?>"><?php echo $get_rate['Salary']?></option> <?php } ?>
                </select>
                      </div>
                    </div>


                        <div class="col-sm-1">
                      <div class="form-group">
                     <input type="number" placeholder="0" onchange="sync()" name="Day2" id="day2" Placeholder="0"  value="<?php echo $get_day2?>"class="form-control"id="day2"></div>
                      </div>           
     
                    </div>


                   

                     <div class="row">
                    <div class="col-sm-3">
                      <div class="input-group">                     
                      <select class="form-control custom-select" name="Month2" placeholder="Month">
                  <option selected><?php echo $get_month3?></option>
                   <option></option>
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
                     <input type="text"  name="Days2" class="form-control" value="<?php echo $get_days3?>" placeholder="Specific days" ></div>
                      </div>
                      <input type="hidden"  id="years" name="jo_years" class="form-control" value=<?php echo "2020"?>>
             
                 

                    <div class="col-sm-3">
                      <div class="input-group">                    
                         <select class="form-control custom-select" name="Time3" placeholder="Time" >
                   <option>00:00</option>
                  <?php while ($get_timer3 = $get_time2_data->fetch(PDO::FETCH_ASSOC)) { ?>
                    <?php
                    $selected = ($get_time3  ==  $get_timer3['TimeSched'])? 'selected':'';?>
                    <option <?=$selected;?> value="<?php echo
    $get_timer3['TimeSched']; ?>"><?php echo $get_timer3['TimeSched']?></option> <?php } ?>
                </select>
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="input-group">                        
                        <select class="form-control custom-select" onchange="sync()" id="rate3" placeholder="Php"  name="Rate2">
                   <option>0.00</option>
                  <?php while ($get_rated = $get_rate2_data->fetch(PDO::FETCH_ASSOC)) { ?>
                    <?php
                    $selected = ($get_rate3  ==  $get_rated['Salary'])? 'selected':'';?>
                    <option <?=$selected;?> value="<?php echo
    $get_rated['Salary']; ?>"><?php echo $get_rated['Salary']?></option> <?php } ?>
                </select>
                      </div>
                    </div>

                    <div class="col-sm-1">
                      <div class="form-group">
                     <input input type="number" placeholder="0" onchange="sync()" name="Day3" Placeholder="0"  value="<?php echo $get_day3?>"class="form-control" id="day3"></div>
                      </div>           
                    </div>
                  </div>
                    </div>
                      </div>
                    </div>
                    <hr>

                   <div class="box-footer" align="right">
                     
                        <a href="create_job_order_edit.php?objid=<?php echo $get_no?>" class="btn btn-default"><b>Back</b></a>

                        <button type="submit"   class="btn btn-danger" name="delete" value="delete" id="delete"><b>Delete</b></a></button>

                        <button type="submit" class="btn btn-success" <?php echo $btnStatus?> name="update" value="save" id="saving"><b>Update</b></a></button>
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

</div> <?php include 'includes/footer.php'; ?>
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
