<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/navbar.php'; ?>
<?php include 'insertjo.php'; ?>
<?php include 'includes/scripts.php'; ?>
   <!-- Content Header (Page header) -->


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
                    <input type="text" name="jo_no" id="jonumber" value="" class="form-control" readonly></span>
                  </div>
                  
                  </div>
                    </div>
                  </div></div>
                  <hr class="dashed">

                  
                  <div class="row">
                  <div class="col-sm-8">
                      <div class="form-group">
                        <label>Project Name</label>
                        <select class="form-control custom-select" id="prjName" name="jo_name" >
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
                        <input type="text" id="charges" class="form-control" name="jo_charges" readonly>
                      </div>
                    </div>

                       <div class="col-sm-4">
                      <div class="form-group">
                        <label>Project Budget</label>
                        <input type="text" id="budget" class="form-control" name="jo_budget" readonly>
                      </div>
                      </div>

                       <div class="col-sm-4">
                      <div class="form-group">
                        <label>Previous Balance</label>
                        <input type="text" id="balance" class="form-control" name="jo_previous" readonly>
                      </div>
                      </div></div>
                      <hr>

                     <div class="box-footer" align="right">
                     
                        <a href="add_project.php" class="btn btn-default"><b>Cancel</b></a>

                        <button type="submit" class="btn btn-default" <?php echo $btnStatus;?> name="insert" value="save" id="saving"><b>Save</b></a></button>

                    
                      <?php if ($btnStatus=='enabled') {?>
                      <a href="" class="btn btn-success disabled"><b>Proceed</b></a>
                    <?php }elseif($btnStatus<>'enabled') {?>  
                      <a href="create_job_order.php?objid=<?php echo $jo_no;?>" class="btn btn-success"><b>Proceed</b></a>
                      <?php } ?>
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


    </script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
>?