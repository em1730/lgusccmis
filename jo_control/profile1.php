<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/navbar.php'; ?>
<?php include 'insert_travel.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m=o text-dark">
        Profile
        <!-- <small>Version 2.0</small> -->
      </h1>
      </div>
      <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right text-xs">
      <li class="breadcrumb-item"><a href="index">Home</a></li>
      <li class="breadcrumb-item active">Profile</li>
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
          </div>
          <!-- /.col -->
          <div class="col-md-12">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username text-xl"><i class="h1 mb-0 font-weight-bold"><?php echo $db_first_name . " " . $db_middle_name[0] ."." . " " . $db_last_name ?></i></h3>
                <h5 class="widget-user-desc"><?php echo $db_position;?></h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-3" src="../dist/img/<?php echo $db_location?>" width="250" height="200" vspace="10" alt="User Avatar">
              </div>

              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header "><i class="fa fa-lg fa-phone"> Contact #:</i></h5>
                      <span class="description-text"><?php echo $db_contact_number;?></span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header"><i class="fa fa-lg fa-user"> Username:</i></h5>
                      <span class="description-text"><?php echo $db_user_name;?></span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header"><i class="fa fa-lg fa-envelope"> Email:</i></h5>
                      <span class="description-text"><?php echo $db_email_ad;?></i></span>
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
<div class="card-footer">
                  <div class="text-right">
                    <a href="#" class="btn btn-sm btn-primary">
                      <i class="fa fa-edit"></i> Edit Profile
                    </a>
                  </div>
                </div>
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


<?php include 'includes/footer.php'; ?>
<?php include 'includes/scripts.php'; ?>
</body>
</html>