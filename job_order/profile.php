<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/navbar.php'; ?>


<!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m=o text-dark">
       My Profile
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
           <h3 class="card-title">Details</h3>
                </div>
                <br>
                <div class="card-body">
                  <div class="row">
                    <div class="col-7">
                      <h3 class="lead"><b><i class="h1 mb-0 font-weight-bold bg-yellow"><?php echo $db_first_name . " " . $db_middle_name[0] ."." . " " . $db_last_name ?></i></b></h3>
                      <p class="text-muted text-lg"><b>Position: </b><i class=""> <?php echo $db_position;?></i> </p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="big"><span class="fa-li"><i class="fa fa-lg fa-briefcase"></i></span> Department: <?php echo $db_department;?></li>
                        <li class="big"><span class="fa-li"><i class="fa fa-lg fa-envelope"></i></span> Email: <?php echo $db_email_ad;?></li>
                        <li class="big"><span class="fa-li"><i class="fa fa-lg fa-phone"></i></span> Contact #: <?php echo $db_contact_number;?></li>
                          <li class="big"><span class="fa-li"><i class="fa fa-lg fa-user"></i></span> Username: <?php echo $db_user_name;?></li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                        <?php if ($db_location=='') {?>
                <img class="img-circle elevation-5" src="../dist/img/no-photo-icon.png" align="center" vspace="10" width="250" height="200" alt="User profile picture">

                        <?php }elseif($db_location<>'') {?>
                                <img class="img-circle elevation-5" src="<?php echo (!empty([$db_location])) ? '../dist/img/'.$db_location : '../dist/img/no-photo-icon.png'; ?>" align="center" vspace="10" width="250" height="200" alt="User profile picture">
                      <?php } ?>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <a href="edit_profile.php?user_id<?php echo $user_id;?>" class="btn btn-sm btn-primary">
                      <i class="fa fa-edit"></i> Edit Profile
                    </a>
                  </div>
                </div>
              </div>
            </div>
             <!-- /.box -->
       </div>
         <!-- Main Content End --> 

   </div> 
   <!-- Content-Wrapper End -->
         <div class="col-md-1"></div>
          </div>
           </div>

<?php include 'includes/footer.php'; ?>
<?php include 'includes/scripts.php'; ?>
</body>
</html>