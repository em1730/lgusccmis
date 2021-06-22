<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/navbar.php'; ?>
<?php include 'includes/insert.php'; ?>
<?php include 'includes/update_users.php'; ?>
<!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m=o text-dark">
       
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
  <section class="content">
 <div class="container-fluid">
        <div class="row">
         <div class="col-12 col-sm-6 col-md-4">
          <div class="info-box bg-info-gradient">
        
          <span class="info-box-icon bg-info elevation-1"> <i class="fa fa-users"></i></span>
          
              <div class="info-box-content">
              
                <span class="info-box-text">Number of Users</span>
                <span class="info-box-number">
                <?php echo $get_all_user_data->rowCount()?>
             
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-4">
          <div class="info-box bg-danger-gradient">
              <span class="info-box-icon bg-success elevation-1"> <i class="fa fa-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Active</span>
                <span class="info-box-number">
               <?php echo $get_all_user1_data->rowCount()?>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-4">
          <div class="info-box bg-success-gradient">
              <span class="info-box-icon bg-danger elevation-1"> <i class="fa fa-user-times"></i></a></span>

              <div class="info-box-content">
                <span class="info-box-text">Inactive</span>
                <?php echo $get_all_user2_data->rowCount()?>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
         
        <!-- /.row -->
        <!-- /.row -->
        <!-- Main row -->
      </section>

     

            <!-- Profile Image -->
             <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-3">

            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
 
 <?php if ($get_db_location=='') {?>
      <img class="profile-user-img img-fluid img-circle"
                       src="../dist/img/no-photo-icon.png"
                       alt="User profile picture">

<?php }elseif($get_db_location<>'') {?>
      <img class="profile-user-img img-fluid img-circle"
                       src="<?php echo (!empty([$get_db_location])) ? '../dist/img/'.$get_db_location : '../dist/img/no-photo-icon.png'; ?>"
                       alt="User profile picture">
<?php } ?>


                        </div>
                 <input type="hidden" class="form-control" name="Status" readonly="true" value="<?php echo $get_db_user;?>" >

                <h3 class="profile-username text-center"><?php echo $get_db_first_name . " " . $get_db_middle_name[0] ."." . " " . $get_db_last_name ?></h3>

                <p class="text-muted text-center"><?php echo $get_db_position?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>ID</b> <a class="float-right"><?php echo $get_db_user?></a>
                  </li>
                </ul>

                <a href="edit_users.php?user_id=<?php echo $get_db_user;?>" class="btn btn-primary btn-block" id='profile_edit'><b>Edit Profile</b></a>

             
              </div>
              <!-- /.card-body -->
           
</div>
 <!-- About Me Box -->
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title"><strong>Information</strong></h3> 
                </div>
                  <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fa fa-briefcase "></i> Department</strong>
                 <input type="hidden" class="form-control" name="Status" readonly="true" value="<?php echo $get_db_user;?>" >

                <p class="text-muted"><?php echo $get_db_department?></p>

                <hr>

                <strong><i class="fa fa-phone "></i> Contact No.</strong>

                    <p class="text-muted"><?php echo $get_db_contact_number?></p>

                <hr>

                <strong><i class="fa fa-envelope "></i> Email</strong>

                    <p class="text-muted"><?php echo $get_db_email_ad?></p>

                <hr>

                <strong><i class="fa fa-user "></i> Username</strong>

                    <p class="text-muted"><?php echo $get_db_user_name?></p>        
              
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->



<div class="card">
              <div class="card">
              </div>
                  <!-- /.card-header -->
              <div class="card-body">
                <a href="add_user.php?user_id<?php echo $user_id;?>" class="btn btn-success btn-block"><b> <i class="fa fa-plus"></i> Add User</b></a>
              
                <a href="" class="btn btn-danger btn-block"><b> <i class="fa fa-trash"></i> Delete</b></a>

               <a href="index" class="btn btn-default btn-block"><b>Cancel</b></a>
               
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

</div>

         <div class="col-md-9">
            <div class="card card-outline card-primary ">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">All</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                   

<!-- Main content -->
  <section class="content">
       <div class="row">      
      
           </div>
        
            <div class="col-md-12">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title"><strong>Details</strong></h3>
            </div>
          
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="get" action="<?php htmlspecialchars("PHP_SELF"); ?>"> 
               
              <div class="card-body">
                <table id="users" class="table table-bordered table-striped" cellspacing="1" cellpadding="8"   >
                  <thead>
                    <tr bgcolor="lightgreen">
                   
                     <th style="text-align:center;">User’s Name</th>
                      <th style="text-align:center;">Status</th>
                      <th style="text-align:center;">Details</th>
                    </tr>
                  </thead>
                  <tbody>
                                   <?php while ($travel_user = $get_all_user_data-> fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>

                   
                    <td><?php echo $travel_user['first_name'] . " " . $travel_user['middle_name'][0] ."." . " " . $travel_user['last_name'] ?></td>

                   <?php if ($travel_user['userStatus']=='Active') {?>
                    <td align="center">  <p class="text-success"><strong><?php echo $travel_user['userStatus'];?></strong></p>

                       <?php }elseif($travel_user['userStatus']=='Inactive') {?>
                    <td align="center"> <p class="text-danger"><strong><?php echo $travel_user['userStatus'];?></strong></p>
                    <?php } ?>
                    </td>

                   <td align="center">
                          <a class="btn btn-outline-success btn-xs" href="users.php?user_id=<?php echo $travel_user['user_id']; ?>" data-toggle="tooltip" title="Edit"><i class="fa fa-search"></i>
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
</div>
    </div>
</div>
  </div>
</div>
  </div>
</div>
<?php include 'includes/footer.php'; ?>

    </div> 
   <!-- Content-Wrapper End -->

  
 <?php include 'includes/scripts.php'; ?>
 </body>
</html>



         
