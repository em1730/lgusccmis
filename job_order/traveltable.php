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
            <form role="form" method="get" action="<?php htmlspecialchars("PHP_SELF"); ?>">
              <div class="card-body text-sm">
                <table id="information" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Travel No.</th>
                      <!-- <th>Middlename</th>
                      <th>Lastname</th> -->
                      <th>Full Name</th>
                      <th>Destination</th>
                      <th>Vehicle</th>
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
                   <td><?php echo $travel_data['TypeOfVehicle'];?></td>
                    <td><?php echo $travel_data['dateDeparture'];?></td>
                  <td><?php echo $travel_data['dateArrival'];?></td>

                    <td>  <button class="btn btn-outline-success btn-xs" data-role="change_status" data-id="<?php echo $travel_data['travelOrderNo'];?>"><i class="" aria-hidden="true"></i>&nbsp; <?php echo $travel_data['Status'];?></button>
                            </td>
                   <td>
                          <a class="btn btn-outline-success btn-xs" href="Edit_travel.php?travelno=<?php echo $travel_data['travelOrderNo']; ?>"><i class="fa fa-pencil-square-o"></i>
                          </a>  
                     <a class="btn btn-outline-success btn-xs" href="../plugins/TCPDF/User/travelOrder?travelno=<?php echo
                            $travel_data['travelOrderNo']; ?>"><i class="fa fa-search"></i>
                          </a>
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

 
<div class="modal fade" id="change_status">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card-header card-outline card-info">
          <h4 class="modal-title">Change Status</h4>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
            </button>
        </div>

        <div class="modal-body">
          <form method="POST" action="update_status.php">

            <input type="text" class="travelOrderNo"  name="travelNo">

             <label> Travel Order Number </label>    
             <div class="form-group"  >
             <input type="text" name="travelNo" readonly="true" id="travelNo" class="form-control">
            </div>

              <label> Status </label>
               <div class="form-group"  >
               <select class="form-control" style="width: 100%;" name="Status" id="status">
                       <option selected id="edit_status"></option>
                       <option value="Pending">Pending</option>
                       <option value="Approved">Approved</option>

                    </select>

            </div>
              <button type="submit" class="btn btn-success" name="update_status" id="edit"><i class="fa fa-check fa-fw"></i></button>
            <button type="reset" class="btn btn-info" name=""><i class="fa fa-undo fa-fw"></i></button>

             </form> 
        </div>
      </div>
  

 <!-- Wrapper End -->
 <?php include 'includes/scripts.php'; ?>

 <script>
     $('#users').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })

    $(document).on('click', 'button[data-role=change_status]', function(event){
      event.preventDefault();

      var id = ($(this).data('travelOrderNo'));


      $('#travelOrderNo').val(travelOrderNo);
       $('#travelNo').val(travelOrderNo);
      $('#change_status').modal('toggle');
       $('#edit_status').val(data.Status);

    })
</script> 

</body>
</html>
