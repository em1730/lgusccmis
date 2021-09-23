<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/navbar.php'; ?>
<?php include 'edit_travel_order.php';?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m=o text-dark">
        New Travel
        <!-- <small>Version 2.0</small> -->
      </h1>
      </div>
      <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right text-xs">
      <li class="breadcrumb-item"><a href="index">Home</a></li>
      <li class="breadcrumb-item active">New Travel</li>
         </ol>
         </div>
       
    </section>
<!-- Main content -->
 <form role="form" enctype="multipart/form-data" method="post" action="<?php htmlspecialchars("PHP_SELF"); ?>">
           <div class="card-body">

             <div>
                 <?php echo $alert_msg; ?>
                 <?php echo $alert_msg2; ?>
             </div></form>
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Details</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>

 <input hidden type="text" class="form-control" readOnly=true id = "orno2" name="travelNo2" value="<?php echo $update_travelno; ?>">

               <div class="card-body">
             <div class="form-group">
                <label for="inputNo">Travel Order No.</label>
               <input type="text" readOnly=true id="Number" name="travelNo" class="form-control" value="<?php echo $update_travelno;?>">
              </div>

               <div class="form-group">
                <label for="inputNamePosition">Name/Position</label>
                <select class="form-control select2" multiple="" name="fullname[]" value="<?php echo $fullname;?>">
                 <?php while ($get_namepos = $get_employee_data->fetch(PDO::FETCH_ASSOC)) {  
                      if( in_array($get_namepos['fullname'], $new_name) ){
                                                        $selected = 'selected';
                                                    }
                                                    else{
                                                        $selected = '';
                                                    }
         
                  ?>
                   <option <?=$selected?> value="<?php echo
                         $get_namepos['fullname'];?>"><?php echo $get_namepos['fullname'];?> <?php echo "-";?> <?php echo $get_namepos['position'];?></option><?php } ?>
              </select>
              </div> 
     

               <div class="form-group">
                <label for="inputStatus">Division</label>
               <input type="text" id="Number" name="division" class="form-control" value="<?php echo $get_division;?>">
              </div>
       
             <div class="form-group">
                <label for="inputNo">Destination</label>
               <input type="text" id="inputClientCompany" name="destination" class="form-control" value="<?php echo $get_destination;?>">
              </div>
              <div class="form-group">
                <label for="inputDescription">Purpose</label>
                <textarea type= "text" name="purpose" class="form-control" rows="4"><?php echo $get_purpose;?></textarea>
              </div>

                <div class="form-group">
                <label for="inputDateDepart">Departure Date</label>
                 <div class="input-group date mb-3" data-provide="datepicker" >
                 <div class="input-group-addon input-group-prepend">
                <span class="input-group-text "><i class="fa fa-calendar"></i></span>  </div>
                <input type="text" id="datepicker" class="form-control" name="dateDeparture" placeholder="Date" value="<?php echo $get_dateDeparture;?>">
              </div>
          </div>

              <div class="form-group">
                <label for="inputArrival">Expected Arrival Date</label>
                 <div class="input-group date mb-3" data-provide="datepicker" >
                 <div class="input-group-addon input-group-prepend">
                <span class="input-group-text "><i class="fa fa-calendar"></i></span>   </div>
                <input type="text" id="datepicker" class="form-control" name="dateArrival" placeholder="Date" value="<?php echo $get_dateArrival;?>">
              </div>
          </div>



           <div class="form-group">
                <label for="inputSponsor">Sponsoring Agency</label>
                <input type="text" id="inputSponsor" class="form-control" name="sponsoringAgency" value="<?php echo $get_sponsoring;?>">
              </div>
             <div class="form-group">
                <label for="inputSourceFund">Source Of Fund</label>
                <input type="text" id="inputSourceFund" class="form-control" name="SourceOfFund" value="<?php echo $get_source;?>">
              </div>
      </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-6">
          <div class="card card-warning">
            <div class="card-header">
              <h3 class="card-title">Mode of Travel</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
      </div>
  
   <input type="hidden" readOnly=true id="Number" name="travelNo" class="form-control" value="<?php echo $update_travelno;?>">

          <div class="card-body">
               <div class="form-group">
                <label for="modeTransportation">Mode of Transportation</label>
                <select class="form-control custom-select" name="modeTransportation"; ?>">
                  <option selected disabled>Select one</option>
                  <?php while ($get_modetrans1 = $get_modeTrans_data->fetch(PDO::FETCH_ASSOC)) { ?>
                    <?php $selected = ($get_modetrans == $get_modetrans1['Modetrans'])? 'selected':'';?>
                    <option <?=$selected;?> value="<?php echo
    $get_modetrans1['Modetrans']; ?>"><?php echo
    $get_modetrans1['Modetrans']; ?></option>
                <?php } ?>
                </select>
              </div>

                <div class="form-group">
                <label for="typeOfvehicle">Type of Vehicle</label>
                <select class="form-control custom-select" id="typeOfvehicle"; name="typeOfvehicle"; ?>">
                  <option selected disabled>Please select....</option>
                  <?php while ($get_vehicle = $get_vehicle_data->fetch(PDO::FETCH_ASSOC)) { ?>
                    <?php
                    $selected = ($get_typevehicle  ==  $get_vehicle['Vehicle'])? 'selected':'';
                    ?>
                     <option <?=$selected;?> value="<?php echo
    $get_vehicle['Vehicle']; ?>"><?php echo $get_vehicle['Vehicle']; ?></option> <?php } ?>
                </select>
              </div>
                             

               <div class="form-group">
                <label for="inputNature">Nature of Travel</label>
                 <select class="form-control custom-select" id="natureOftravel"; name="NatureOfTravel"; ?>">
                  <option selected disabled>Select one</option>
                  <?php while ($get_nature = $get_nature_data->fetch(PDO::FETCH_ASSOC)) { ?>
                    <?php
                    $selected = ($get_natureTravel  ==  $get_nature['natureTravel'])? 'selected':'';
                    ?>
                     <option <?=$selected;?> value="<?php echo
    $get_nature['natureTravel']; ?>"><?php echo $get_nature['natureTravel']; ?></option> <?php } ?>
                </select>
              </div>
              
          
            <div class="form-group">
                <label for="inputStatus">Status</label>
                <input class="form-control" name="Status" readonly="true" value="<?php echo $get_status;?>" >
              </div>

                 <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
    
    <div class="col-md-13">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Remarks</h3>

               <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
      </div>


            <div class="card-body">
                <textarea type= "text" name="Remarks" class="form-control" rows="4"><?php echo $get_remarks;?></textarea>
              </div>


 <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>


          <div class="col-md-13">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Signatories</h3>

               <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
      </div>


            <div class="card-body">
              <label for="inputName">Recommending Approval</label>
                <select class="form-control custom-select" name="Recommending"; ?>">
                  <option selected disabled>Please select....</option>
                  <?php while ($get_spmember = $get_spmembers_data->fetch(PDO::FETCH_ASSOC)) { ?>
                    <?php
                    $selected = ($get_recommend  ==  $get_spmember['fullname'])? 'selected':'';
                    ?>
                     <option <?=$selected;?> value="<?php echo
    $get_spmember['fullname']; ?>"><?php echo $get_spmember['fullname']; ?></option> <?php } ?>
                </select>
             </div>


      <div class="card-body">
              <label for="inputName">Approved</label>
                <select class="form-control custom-select" name="Approved"; ?>">
                  <option selected disabled>Please select....</option>
                  <?php while ($get_spmember = $get_spmember_data->fetch(PDO::FETCH_ASSOC)) { ?>
                    <?php
                    $selected = ($get_approved  ==  $get_spmember['fullname'])? 'selected':'';
                    ?>
                     <option <?=$selected;?> value="<?php echo
    $get_spmember['fullname']; ?>"><?php echo $get_spmember['fullname']; ?></option> <?php } ?>
                </select>
             </div>
<br>

 <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
          

             
    
   <div class="card-footer">
        <input type="submit"  <?php echo $btnStatus; ?> name="edit_travel_order" class="btn btn-primary" value="Update">
        <a href="table">
        <input type="button" name="cancel" class="btn btn-secondary" value="Cancel">       
                        </a>
         <a href="../plugins/TCPDF/User/travelOrder?travelno=<?php echo
                            $update_travelno;?>"> 
          <input type="button" class="btn btn-success float-sm-right" value="Print"></a>
                    </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
  <?php include 'includes/footer.php'; ?>

  
 <?php include 'includes/scripts.php'; ?>

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
        $("#emp_position").click(function() { 
          var value = $("#myselection option:selected"); 

      $('#name').val($('#name').val() + value);

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
                            url:'insert_travel.php',
                            data:'insert_travel',
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


                
//SELECT DROPDOWN
   
    $('#fullname').on('change', function() {
        var fullname = this.value;
        $.ajax({
            type:"POST",
            url:'sql_query_get_position.php',
            data:{emp_position:fullname},
         
            success:function(response){
              var result = jQuery.parseJSON(response);
                console.log('response from server',result);
                $('#position').val(result.data);
            },
            error: function (xhr, b, c) {
                console.log("xhr=" + xhr + " b=" + b + " c=" + c);
            }
        });


    }); 
       $('#select_type').on('change',function(){
             var type = $(this).val();
             var office = $('#department').val();

  }
            
                 
                

</script>
</body>
</html>


 

 