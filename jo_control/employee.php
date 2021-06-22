<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/navbar.php'; ?>
<?php include 'insert_employee.php'; ?>



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m=o text-dark">
       Employee
        <!-- <small>Version 2.0</small> -->
      </h1>
      </div>
      <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right text-xs">
      <li class="breadcrumb-item"><a href="index">Home</a></li>
      <li class="breadcrumb-item active">Users</li>
         </ol>
         </div>
    </section>

    <!-- Main content -->     
    <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-4">
   <div align="center">
               
             </div>
        <!-- Widget: user widget style 2 -->
            <div class="card card-widget widget-user-2">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-warning">
                <div class="widget-user-image">

 <?php if ($empID=='') {?>
      <img class="img-circle elevation-2"
                       src="../dist/img/no-photo-icon.png"
                       alt="User profile picture">

<?php }elseif($get_emplocation=='') {?>
      <img class="img-circle elevation-2"
                       src="../dist/img/no-photo-icon.png"
                       alt="User profile picture">

<?php }elseif($get_emplocation<>'' && $empID<>'') {?>
      <img class="img-circle elevation-2" src="../dist/img/<?php echo  $get_emplocation?>" alt="User Avatar">
<?php } ?>

                </div>
                <!-- /.widget-user-image --> 
                <?php if ($empID=='') {?>
                <h1 class="widget-user-username">Employee</h1>
                <h5 class="widget-user-desc"></h5>
              </div>
              <div class="card-footer p-0">
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Employee ID <span class="float-right badge bg-primary">-</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                     Department <span class="float-right badge bg-info">-</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                     Pending Travels <span class="float-right badge bg-success">-</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                     Number of Travels  <span class="float-right badge bg-danger">-</span>
                    </a>
                  </li>
                </ul>

                <?php }elseif($empID<>'') {?>
                <h1 class="widget-user-username"><?php echo $update_fname?></h1>
                
                <h5 class="widget-user-desc"><?php echo $get_post?></h5>
              </div>
              <div class="card-footer p-0">
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Employee ID <span class="float-right badge bg-primary"><?php echo $empID?></span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                     Department <span class="float-right badge bg-info"><?php echo $get_div;?> </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                     Pending Travels <span class="float-right badge bg-success">12</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                     Number of Travels  <span class="float-right badge bg-danger">842</span>
                    </a>
                  </li>
                </ul>
                <?php } ?>
              </div>        
</div>

             

              <div class="card">
                <!-- /.card-header -->
              <div class="card-body">
                <a href="#add"  <?php echo $btnNew; ?> class="btn btn-success add btn-block"><b> <i class="fa fa-plus"></i> Add Employee</b></a>
             
               <a href="#delete" class="btn btn-danger delete btn-block"><b><i class="fa fa-trash"></i> Delete</b></a>
           
               <a href="index" class="btn btn-default btn-block"><b>Cancel</b></a>
            </div>    
</div>

</div>

         




    <!-- Main content -->
           <div class="col-md-8">      
            <div class="card card-info">
            <div class="card-header with-border">
              <h3 class="card-title">Details</h3>
            </div>
          
            <form role="form" method="get" action="<?php htmlspecialchars("PHP_SELF"); ?>"> <br>
                <?php
                     if(isset($_SESSION['error'])){
                     echo "
                       <div class='alert alert-danger alert-dismissible'>
                         <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                           ".$_SESSION['error']."
                       </div>
                       ";
                     unset($_SESSION['error']);
                     }
                     if(isset($_SESSION['success'])){
                      echo "
                       <div class='alert alert-success alert-dismissible'>
                         <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                           ".$_SESSION['success']."
                       </div>
                       ";
                      unset($_SESSION['success']);
                   }
                 ?>
            
              <div class="card-body text-m">
                <table id="users" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                                          <tr>
                      <th style="text-align:center;">No</th>
                      <th width="45%"style="text-align:center;">Full Name</th>
                      <th  style="text-align:center;">Position</th>
                      <th style="text-align:center;">More</th>
                    </tr>

                    </tr>
                  </thead>
                  <tbody>
                                    <?php while ($get_name = $get_employee_data-> fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                                         <td><?php echo $get_name['no'];?></td>
                   <td> <strong><?php echo $get_name['fullname'];?></strong></td>
                    <td><?php echo $get_name['position'];?></td>
                    <td align="center">
                          <a class="btn btn-outline-success btn-xs" href="employee.php?empid=<?php echo $get_name['empid']; ?>" data-toggle="tooltip" title="View"><i class="fa fa-folder-open"  style="font-size:25px"></i>
                          </a>  


                             <button class="btn btn-outline-success edit btn-xs" <?php echo $btnStatus; ?> data-id="<?php echo $get_name["empid"]; ?>" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"  style="font-size:25px"></i>
                          </a>  
                    </td>

                          </tr>
                      <div class="form-group">
                   <?php } ?>
                  </tbody>
                </table>
              </div>
             <!-- /.box-body -->
                          
            </form>
         

    </section>
    <!-- /.content -->
</div>
 <?php include 'includes/footer.php'; ?>
 <!-- Content-Wrapper End -->
</div>      
            
  <!-------------------- modals here --------------------------------->

    <!-- ADD -->
<div class="modal fade" id="add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white bg-primary mb-2">
              <h5 class="modal-title"><b> <i class="fa fa-plus"> Add Employee </i></b></h5>
           <button class="close" type="button" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
            </button>
        </div>

            <form class="form-horizontal" method="POST" action="insert_employee.php">

               <div class="widget-user-image" align="center">
                <img class="img-circle"  id="image" src="../dist/img/no-photo-icon.png" width="200" height="150" vspace="10" alt="User Avatar">
              </div>


              <div class="modal-body">
                  <div class="form-group"> 
                    <label> Employee ID. </label>
                    <input type="text"  id="empid" name="empno" class="form-control" >
                  </div>

                  <div class="form-group"> 
                    <label> Full name </label>
                    <input type="text" id="empfullname" name="empfullname" class="form-control" value="<?php echo $empFullname;?>" placeholder="Enter Fullname">
                  </div>

                  <div class="form-group"> 
                    <label> Designation </label>
                    <input type="text" id="empposition" name="empposition" class="form-control" value="<?php echo $empPosition;?>" placeholder="Designation">
                  </div>

                   <div class="form-group">
                     <label> Department/Office </label>
                  <select class="form-control" style="width: 100%;" id="empoffice" value="<?php echo $empDepartment;?>"name="empoffice" >
                       <option selected disabled>Please select....</option>
                  <?php while ($get_department = $get_department_data->fetch(PDO::FETCH_ASSOC)) { ?>
                     <option value="<?php echo
    $get_department['department']; ?>"><?php echo $get_department['department']; ?></option> <?php } ?>
                </select>
                    </div>

            <div class="form-group">
            <label> Uplaod photo</label>
             <div class="col-md-12" align="left">
             <input class="text-sm" type ="file" name="myFile" id="fileToUpload"  onchange = "loadImage()">
            </div>

                           </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-success btn-sm" name="insert" value="save"><i class="fa fa-check"></i> Proceed</button>
              </form>
            </div>
       </div>
    </div>
</div>
</div>
</div>

  <!-- Delete -->
        <div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header card-outline card-danger">
              <h4 class="modal-title"><b>Deleting...</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="delete_employee.php">
                <input type="hidden" class="empno" name="empno">
                <div class="text-center">
                    <p>Are you sure you want to delete <?php echo $update_fname;?></p>
                    <h2 id="del_employee" class="bold"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-danger btn-sm" name="delete"><i class="fa fa-trash"></i> Delete</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white bg-primary mb-2">
              <h5 class="modal-title"><b> <i class="fa fa-plus"> Update Record</i></b></h5>
           <button class="close" type="button" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
            </button>
        </div>

            <form class="form-horizontal" method="POST" action="update_employee.php">
               <input type="hidden"  class="objid" name="empid" >

               <div class="widget-user-image" align="center">
                <img class="img-circle"  id="image" src="../dist/img/no-photo-icon.png" width="200" height="150" vspace="10" alt="User Avatar">
              </div>


              <div class="modal-body">
                  <div class="form-group"> 
                    <label> Employee ID. </label>
                    <input type="text"  id="objid" name="id" class="form-control">
                  </div>

                  <div class="form-group"> 
                    <label> Full name </label>
                    <input type="text" id="EditempName" name="EditempName" class="form-control" placeholder="Enter Fullname">
                  </div>

                  <div class="form-group"> 
                    <label> Designation </label>
                    <input type="text" id="EditempPosition" name="EditempPosition" class="form-control" placeholder="Designation">
                  </div>

                   <div class="form-group">
                     <label> Department/Office </label>
                  <select class="form-control" style="width: 100%;" value="<?php echo $get_department;?>" name="EditempOffice" >
                       <option selected id="EditempOffice"></option>
                    <?php while ($get_department1 = $get_department3_data->fetch(PDO::FETCH_ASSOC)) { ?>
                    <?php $selected = ($get_department2 == $get_department1['department'])? 'selected':'';?>
                    <option <?=$selected;?> value="<?php echo
   $get_department1['department']; ?>"><?php echo
    $get_department1['department']; ?></option>
                <?php } ?>
                </select>
              </div>

            <div class="form-group">
            <label> Uplaod photo</label>
             <div class="col-md-12" align="left">
             <input class="text-sm" type ="file" name="myFiles" id="fileToUpload"  onchange = "loadImage()">
            </div>

                           </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-success btn-sm" name="edit"><i class="fa fa-check"></i> Update</button>
              </form>
            </div> 
          </div>
    </div>
</div>           
     
       
 <?php include 'includes/scripts.php'; ?>
 <script src="extensions/auto-refresh/bootstrap-table-auto-refresh.js"></script>


 <script>
 $(function(){
  $('.add').click(function(e){
    e.preventDefault();
    $('#add').modal('show');
    var id = $(this).data('empno');
    getRow(id);
  });
});
  </script>

 <script>
 $(function(){
  $('.edit').click(function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.delete').click(function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
  
 });
 function getRow(id){
  
  $.ajax({
    
    type: 'POST',
    url: 'fetch_employee.php',
    data: {id:id},
    dataType: 'json',
    success: function(data){
      
      $('.objid').val(data.empid);
      $('#objid').val(data.empid);
      $('#EditempName').val(data.fullname);
      $('#EditempOffice').val(data.office).html(data.office);
      $('#EditempPosition').val(data.position);
      $('#del_employee').val(data.empid);
    }
  });
};

 </script>
 <!-- loadImage -->
 <script>
function loadImage(){
    var input = document.getElementById("fileToUpload");
var fReader = new FileReader();
fReader.readAsDataURL(input.files[0]);
fReader.onloadend = function(event){
    var img = document.getElementById("image");
    img.src = event.target.result;
}
}
</script> 
</body>
</html>


 

