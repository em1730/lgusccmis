<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/navbar.php'; ?>
<?php include 'includes/insert.php'; ?>

<!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m=o text-dark">
        Add Employee
        <!-- <small>Version 2.0</small> -->
      </h1>
      </div>
      <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right text-xs">
      <li class="breadcrumb-item"><a href="index">Home</a></li>
      <li class="breadcrumb-item active">Register</li>
         </ol>
         </div>
       
    </section>

<!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
   <div class="col-md-1"></div>
     <div class="col-md-10">    
      <div class="card card-outline card-primary">
              <div class="card bg-light">
                <div class="card-header text-muted text-lg border-bottom-0">
                   <div class="card-header">
  <!-- /.widget-user -->
   <form method="post" action="" enctype="multipart/form-data">
           <div class="card-body">

             <div align="center">
               <?php echo $alert_msg; ?>
             </div>
          </div>
          <!-- /.col -->
          <div class="col-md-12">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
               <div class="widget-user-header bg-info">
                <h3 class="widget-user-username text-xl"><i class="h1 mb-0 font-weight-bold">Registration Form</i></h3>
                <h5 class="widget-user-desc"></h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" id="image" src="../dist/img/no-photo-icon.png" width="250" height="200" vspace="10" alt="User Avatar">
              </div>
         
          <br>
            <div class="card-body">
             <div class="form-group">
                 <label>First Name</label>
               <div class="col-md-12">
                <input type="text" class="form-control" name="firstname" placeholder="Firstname" required>
           </div>
         </div>

         <input type="hidden" class="form-control" name="userstatus" placeholder="Firstname" required>

             <div class="form-group">
                 <label>Middle Name</label>
               <div class="col-md-12">
                <input type="text" class="form-control" name="middlename" placeholder="Middlename" required>
               </div>
             </div>

             <div class="form-group">
                 <label>Last Name</label>
               <div class="col-md-12">
                <input type="text" class="form-control" name="lastname" placeholder="Lastname" required>
               </div>
             </div>

              <div class="form-group">
                <label for="inputName">Department</label>
                <div class="col-md-12">
                <select class="form-control custom-select" name="department">
                  <option selected disabled>Please select....</option>
                  <?php while ($get_department = $get_department_data->fetch(PDO::FETCH_ASSOC)) { ?>
                     <option value="<?php echo
    $get_department['department']; ?>"><?php echo $get_department['department']; ?></option> <?php } ?>
                </select>
              </div>
            </div>

              <div class="form-group">
                 <label>Email Address</label>
               <div class="col-md-12">
                <input type="email" class="form-control" name="email" placeholder="Email Address" >
               </div>
             </div>

             <div class="form-group">
                 <label>Contact Number</label>
               <div class="col-md-12">
                <input type="number" class="form-control" name="contact_number" placeholder="Contact Number"  required>
               </div>
             </div>

             <div class="form-group">
                 <label>Position</label>
               <div class="col-md-12">
               <input type="text" class="form-control" name="position" placeholder="Position" required>
               </div>
             </div>

            <div class="form-group">
                 <label>Username</label>
               <div class="col-md-12">
               <input type="text" class="form-control" name="username" placeholder="Username" required>
               </div>
             </div>

            <div class="form-group">
                 <label>Password</label>
               <div class="col-md-12">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
               </div>

            <div class="form-group">
             <label>Upload Photo</label>
            <div class="col-md-12">
             <input class="text-lg" type ="file" name="myFiles" id="fileToUpload"  onchange = "loadImage()">
            </div>
           </div><br>  


              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header "><i class="fa fa-lg fa-phone"> Contact #:</i></h5>
                      <span class="description-text"></span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header"><i class="fa fa-lg fa-user"> Username:</i></h5>
                      <span class="description-text"></span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header"><i class="fa fa-lg fa-envelope"> Email:</i></h5>
                      <span class="description-text"></i></span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
           <!-- /.box-body -->
           <div class="card-footer" align="center">
              <input type="submit"  <?php echo $btnNew; ?> name="add" class="btn btn-primary" value="New">
              <input type="submit"  <?php echo $btnStatus; ?> name="insert" class="btn btn-primary" value="Save">
              <a href="users.php?user_id=<?php echo
                            $user_id;?>">
              <input type="button" name="cancel" class="btn btn-default" value="Cancel">       
              </a>
           </div>
             <br>
            <!-- /.box -->
       </div>
         <!-- Main Content End --> 

   </div> 
   <!-- Content-Wrapper End -->
        
           </div>
</div> 
   <!-- Content-Wrapper End -->
         <div class="col-md-1"></div>
          </div>
           </div>
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
</div>
</div>

<?php include 'includes/footer.php'; ?>
<?php include 'includes/scripts.php'; ?>
</body>
</html>