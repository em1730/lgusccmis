<?php include 'includes/session.php'; ?>
 <?php include 'includes/header.php'; ?>
 <?php include 'includes/sidebar.php'; ?>
 <?php include 'includes/navbar.php'; ?>
 <?php include 'edit_travel_order.php'; ?>


   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
 
     <!-- Content Header (Page header) -->
     <div class="content-header">
       <div class="container-fluid">
         <div class="row mb-2">
           <div class="col-sm-6">
            <h1 class="m-0 text-dark">All Travel Orders</h1>
            </div>
            <br>
      <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right text-xs">
      <li class="breadcrumb-item"><a href="index">Home</a></li>
      <li class="breadcrumb-item active">List of Travel</li>
         </ol>
         </div>
        
         </div>
       </div>
     </div>
     <!-- Content Header End -->

    <!-- Main content -->
    <section class="content">

       <div class="row">
           <div class="col-md-1">

          
           </div>
        
           <div class="col-md-12">      
            <div class="card card-info">
            <div class="card-header with-border">
              <h3 class="card-title">Details</h3>
            </div>
          
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="get" action="<?php htmlspecialchars("PHP_SELF"); ?>"> <br>
             
              <div class="card-body text-sm">
                <table id="users" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Travel No.</th>
                      <!-- <th>Middlename</th>
                      <th>Lastname</th> -->
                      <th>Full Name</th>
                      <th>Destination</th>
                      <th>Departure</th>
                      <th>Arrival</th>
                      <th>Status</th>
                      <th>Options</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php while ($travel_data = $get_all_travel_data-> fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>

                    <td><?php echo $travel_data['travelOrderNo'];?></td>
                   <td><?php echo $travel_data['fullname'];?></td>
                     <td><?php echo $travel_data['Destination'];?></td>
                   <td><?php echo $travel_data['dateDeparture'];?></td>
                  <td><?php echo $travel_data['dateArrival'];?></td>

                    <?php if ($travel_data['Status']=='Cancelled') {?>
                    <td>  <button class='btn btn-danger edit btn-sm' data-id="<?php echo $travel_data["travelOrderNo"]; ?>" data-toggle="tooltip" title="Change Status"  aria-hidden="true"><i class=""></i><span class="bg-danger"><?php echo $travel_data['Status'];?></button>

                   <?php }elseif($travel_data['Status']=='Pending') {?>
                    <td><button class='btn btn-warning edit btn-sm' data-id="<?php echo $travel_data["travelOrderNo"]; ?>" data-toggle="tooltip" title="Change Status"  aria-hidden="true"><i class="" ></i><span class="bg-warning"><?php echo $travel_data['Status'];?> </button>

                        <?php }elseif($travel_data['Status']=='Approved') {?>
                    <td><button class='btn btn-success edit btn-sm' data-id="<?php echo $travel_data["travelOrderNo"]; ?>" data-toggle="tooltip" title="Change Status"  aria-hidden="true"><i class="" ></i><span class="bg-success"><?php echo $travel_data['Status'];?> </button>
                    <?php } ?>
                    </td>

                        <?php if ($travel_data['Status']=='Cancelled') {?> 
                   <td>  <a class="btn btn-outline-success btn-xs" href="#" data-toggle="tooltip" title="Open Folder"><i class="fa fa-folder-open" style="text-align:center;"></i>
                          </a>
                    <a class="btn btn-outline-success btn-xs" href="../plugins/TCPDF/User/travelOrder?travelno=<?php echo
                            $travel_data['travelOrderNo']; ?>" data-toggle="tooltip" title="View"><i class="fa fa-search"></i>
                          </a>
                    
                        <?php }elseif($travel_data['Status']=='Pending') {?>  
                     <td> <a class="btn btn-outline-success btn-xs" href="Edit_travel.php?travelno=<?php echo $travel_data['travelOrderNo']; ?>" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil-square-o"></i>
                          </a>
                          <a class="btn btn-outline-success btn-xs" href="../plugins/TCPDF/User/travelOrder?travelno=<?php echo
                            $travel_data['travelOrderNo']; ?>" data-toggle="tooltip" title="View"><i class="fa fa-search"></i>
                          </a>
                        
                        <?php }elseif($travel_data['Status']=='Approved') {?>
                     <td> <a class="btn btn-outline-success btn-xs" href="../plugins/TCPDF/User/travelOrder?travelno=<?php echo
                            $travel_data['travelOrderNo']; ?>" data-toggle="tooltip" title="View"><i class="fa fa-search"></i>
                          </a>
                          <a class="btn btn-outline-success btn-xs" href="../plugins/TCPDF/User/travelOrder?travelno=<?php echo
                            $travel_data['travelOrderNo']; ?>" data-toggle="tooltip" title="Attachment"><i class="fa fa-paperclip"></i>
                          </a>
                     <?php } ?>
                        </td>

                          </tr>
                      <div class="form-group">
                   <?php } ?>
                  </tbody>
                </table>
              </div>
             <!-- /.box-body -->
                           <div class="card-footer">
                <a href="add_travel">
              <input type="button" name="add" class="btn btn-success float-right" value="Add New Travel"></a>
               <a href="index">
                  <input type="button" name="cancel" class="btn btn-default" value="Cancel">       
                </a>
              </div>
            </form>
         

    </section>
    <!-- /.content -->

</div>
    
<?php include 'includes/footer.php'; ?>

    </div> 
   <!-- Content-Wrapper End -->

 
 <!-------------------- modals here --------------------------------->

    <!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header text-white bg-primary mb-3">
              <h4 class="modal-title"><b>Change Status</b></h4>
           <button class="close" type="button" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
            </button>
        </div>

            <form class="form-horizontal" method="POST" action="update_status.php">
                   <input type="text" class="travelOrderNo" name="id">
                                          
                  
              <div class="modal-body">
                  <div class="form-group">                           
                  <select class="form-control" style="width: 100%;" name="Status" >
                     <option selected id="edit_status"></option>
                       <option value="Pending">Pending</option>
                       <option value="Approved">Approved</option>
                       <option value="Cancelled">Cancelled</option>

                    </select>
                    </div>
                           </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-success btn-sm" name="update_status"><i class="fa fa-check"></i> Update</button>
              </form>
            
     
     

 <!-- Wrapper End -->
 <?php include 'includes/scripts.php'; ?>

  <script>
 $(function(){
  $('.edit').click(function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  
  $.ajax({
    
    type: 'POST',
    url: 'fetch_status.php',
    data: {id:id},
    dataType: 'json',
    success: function(data){
      
      
      $('.travelOrderNo').val(data.travelOrderNo);
      $('#edit_status').val(data.Status).html(data.Status);
     
      
    }
  });
};

 </script>


 <script>
    $(document).click(function(){
        $('[data-toggle="tooltip"]').tooltip();   
    });
</script>

</body>
</html>
