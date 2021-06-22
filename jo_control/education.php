<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/navbar.php'; ?>
<?php include 'insert_employee.php'; ?>

    <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m=o text-dark">
       Education 
        <!-- <small>Version 2.0</small> -->
      </h1>
      </div>
      <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right text-xs">
      <li class="breadcrumb-item"><a href="index">Home</a></li>
      <li class="breadcrumb-item active">Educational Background</li>
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

 <?php if ($get_emp_id=='') {?>
      <img class="img-circle elevation-2"
                       src="../dist/photo/no-photo-icon.png"
                       alt="User profile picture">

<?php }elseif($get_emp_photo=='') {?>
      <img class="img-circle elevation-2"
                       src="../dist/photo/no-photo-icon.png"
                       alt="User profile picture">

<?php }elseif($get_emp_photo<>'' && $id_emp<>'') {?>
      <img class="img-circle elevation-2" src="../dist/photo/<?php echo  $get_emp_photo?>" alt="User Avatar">
<?php } ?>

                </div>
                <!-- /.widget-user-image --> 
                <h1 class="widget-user-username"><?php echo $get_emp_fname . " " . $get_emp_mname[0] ."." . " " . $get_emp_lname?></h1>
                
                <h5 class="widget-user-desc"><?php echo $get_emp_designation?></h5>
              </div>
              <div class="card-footer p-0">
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Employee ID <span class="float-right badge bg-primary"><?php echo $get_emp_code?></span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                     Department <span class="float-right badge bg-info"><?php echo $get_emp_department;?> </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                     Joining Date <span class="float-right badge bg-success"><?php echo $get_emp_joingdate;?></span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                     Years in Serivce  <span class="float-right badge bg-danger">842</span>
                    </a>
                  </li>
                </ul>
               
              </div>        
</div>
  <div class="card">
                <!-- /.card-header -->
            <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title"><strong>Experience Details</strong></h3> 
                </div>
              </div>
               
               <div class="card-body">
                <strong><i class="fa fa-briefcase "></i> Employer 1</strong>
                 <input type="hidden" class="form-control" name="Status" readonly="true" value="<?php echo $get_emp_department;?>" >

                <p class="text-muted"> Employer <span class="float-right badge bg-defualt"><b><?php echo $get_exp_emp1_name?></b></span></p>
                 <p class="text-muted"> Designation <span class="float-right badge bg-defualt"><?php echo  $get_exp_emp1_designation;?></span></p>
                  <p class="text-muted"> Salary <span class="float-right badge bg-defualt"><?php echo  $get_exp_emp1_salary;?></span></p>
                  <p class="text-muted"> Work Duration <span class="float-right badge bg-defualt"><?php echo  $get_exp_emp1_duration;?></span></p>
                <hr>

                 <strong><i class="fa fa-briefcase "></i> Employer 2</strong>

                 <p class="text-muted"> Employer <span class="float-right badge bg-defualt"><b><?php echo $get_exp_emp2_name;?></b></span></p>
                 <p class="text-muted"> Designation <span class="float-right badge bg-defualt"><?php echo $get_exp_emp2_designation;?></span></p>
                  <p class="text-muted"> Salary <span class="float-right badge bg-defualt"><?php echo $get_exp_emp2_salary;?></span></p>
                  <p class="text-muted"> Work Duration <span class="float-right badge bg-defualt"><?php echo $get_exp_emp2_duration;?></span></p>

                <hr>

                <strong><i class="fa fa-briefcase "></i> Employer 3</strong>

                    <p class="text-muted"> Employer <span class="float-right badge bg-defualt"><b><?php echo $get_exp_emp3_name;?></b></span></p>
                 <p class="text-muted"> Designation <span class="float-right badge bg-defualt"><?php echo $get_exp_emp3_designation;?></span></p>
                  <p class="text-muted"> Salary <span class="float-right badge bg-defualt"><?php echo $get_exp_emp3_salary;?></span></p>
                  <p class="text-muted"> Work Duration <span class="float-right badge bg-defualt"><?php echo $get_exp_emp3_duration;?></span></p>
                  </div>
          </div>

             

              <div class="card">
                <!-- /.card-header -->
              <div class="card-body">
                <a href="employeedetails.php?ID=<?php echo $get_emp_id; ?>" class="btn btn-primary add btn-block"><b>Back</b></a>
                  
                    
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
          <?php echo $alert_msg;?>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="get" action="<?php htmlspecialchars("PHP_SELF"); ?>"> <br>
              <div class="card-body">

                      

             <div class="form-group">
                 <label>Educational Attainment</label>
               <div class="col-md-12">
                   <input type="text" class="form-control" name="CouseGra"  value="<?php echo $get_edu_att;?>" readonly>
              </div>
      
         <br>
         <hr>

           <label><i class="h5 mb-0 font-weight-bold bg-yellow">COLLEGE INFORMATION</i></label>

             <div class="form-group">
                 <label>Course</label>
               <div class="col-md-12">
                <input type="text" class="form-control" name="CouseGra"  value="<?php echo $get_edu_course;?>" readonly>
               </div>
       

             <div class="form-group">
                 <label>School/College Graduated</label>
               <div class="col-md-12">
                <input type="text" class="form-control" name="SchoolCollegeGra"  value="<?php echo $get_edu_col_sch;?>" readonly>
               </div>
          

              <div class="form-group">
              <label>Year</label>
               <div class="col-md-12">
                <input type="text" class="form-control" name="YearPassingGra"  value="<?php echo $get_edu_col_yr;?>" readonly>
               </div>
            
           <br>
           <hr>
              <label><i class="h5 mb-0 font-weight-bold bg-yellow">SECONDARY INFORMATION</i></label>

              <div class="form-group">
                 <label>School/High School Grauated</label>
               <div class="col-md-12">
                <input type="text" class="form-control" name="SecondarySchool"  value="<?php echo $get_edu_sec_sch;?>" readonly>
               </div>
        

             <div class="form-group">
                 <label>Year</label>
               <div class="col-md-12">
                <input type="text" class="form-control" name="SecondaryYear"  value="<?php echo $get_edu_sec_yr;?>" readonly>
               </div>
             
             <br>
             <hr>

               <label><i class="h5 mb-0 font-weight-bold bg-yellow">PRIMARY INFORMATION</i></label>

              <div class="form-group">
                 <label>School/Elementary Grauated</label>
               <div class="col-md-12">
                <input type="text" class="form-control" name="ElementarySchool"  value="<?php echo $get_edu_elem_sch;?>" readonly>
               </div>
         

             <div class="form-group">
                 <label>Year</label>
               <div class="col-md-12">
                <input type="text" class="form-control" name="ElementaryYear"  value="<?php echo $get_edu_elem_yr;?>" readonly>
              </div>
            </div>

              <div class="box-footer" align="right">

               <a href="edit_edu.php?ID=<?php echo $get_emp_id; ?>"class="btn btn-success"><b><i class="fa fa-edit"></i> Edit </b></a>
                           
                
                </div>
             

             <!-- /.box-body -->
                          
            </form>
     </section>
      </div>  

   
    <!-- /.content -->

 <?php include 'includes/footer.php'; ?>
 <!-- Content-Wrapper End -->
</div>      
            

     
       
 <?php include 'includes/scripts.php'; ?>
 <script src="extensions/auto-refresh/bootstrap-table-auto-refresh.js"></script>


 
</body>
</html>


 

