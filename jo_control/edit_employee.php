<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/navbar.php'; ?>
<?php include 'update_employee_profile.php'; ?>


<!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m=o text-dark">
        Edit Job Order Profile
        <!-- <small>Version 2.0</small> -->
      </h1>
      </div>
      <div class="col-sm-12">
      <ol class="breadcrumb float-sm-right text-ml">
      <li class="breadcrumb-item active"><b><i style="font-size:20px; color:red;" class="fa fa-arrow-right"></b></i> Personal Information</li>
      <li class="breadcrumb-item"><a href="edit_reference.php?ID=<?php echo $get_emp_id;?>">Reference Number</a></li>
      <li class="breadcrumb-item"><a href="edit_edu.php?ID=<?php echo $get_emp_id;?>">Educational Details</a></li>
      <li class="breadcrumb-item"><a href="edit_work.php?ID=<?php echo $get_emp_id;?>">Work Experience</a></li>
       </ol>
         </div>
       
    </section>
 
<!-- Main content -->
          <div class="col-md-12">
          <div class="card">
           

                 <form role="form" enctype="multipart/form-data" method="post" action="<?php htmlspecialchars("PHP_SELF"); ?>">

                  
     

           <div class="card-body"> 
           <div class="container">
            <div align="center">
                  <?php echo $alert_msg; ?>
             </div>
           <i style="font-size:25px"><i style="color:blue" align="center">Personal Information</i></i>  

             
              <div class="jumbotron">
              <div class="row">

                <?php if ($get_emp_photo=='') {?>
      <div class="col-12 col-sm-3">
               <div class="widget-user-image" align="left">
                <img class="img-circle elevation-5" id="image" src="../dist/img/no-photo-icon.png" width="200" height="200" vspace="10" alt="User Avatar">
              </div>

<?php }elseif($get_emp_photo<>'') {?>
      <div class="col-12 col-sm-3">
               <div class="widget-user-image" align="left">
                <img class="img-circle elevation-5" id="image" src="<?php echo (!empty([$get_emp_photo])) ? '../dist/photo/'.$get_emp_photo : '../dist/photo/no-photo-icon.png'; ?>" width="200" height="200" vspace="10" alt="User Avatar">
              </div>
<?php } ?>
 <input type="hidden" class="form-control" name="ID" value="<?php echo $id_emp;?>" required>
  <input type="hidden" class="form-control" readOnly=true id = "emp_id" name="EmpCode" value="<?php echo $get_emp_id; ?>">

              <br>
             
             <label align="right"><i style="color:grey">*******</i>Upload Photo<i style="color:grey">*******</i></label>
             <input class="text-sm" type ="file" name="myFiles" id="fileToUpload"  onchange = "loadImage()">
             <br>
             <br>
             <div class="col-sm-11">
                      <div class="row">
                        <input type="text" style="text-align: center" class="form-control" name="EmpCode"  value="<?php echo $get_emp_code;?>" placeholder="Enter ID" required>
                        <label style="text-align: center">*****<i class="bg-yellow">Identification Card No</i>*****</label>
                      </div>
                  </div>
                </div>      
               
             <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>First Name</label>
                         <input type="text" class="form-control" value="<?php echo $get_emp_fname;?>" name="EmpFname" required>
                      </div>
                    </div>
                      <div class="col-sm-4">
                      <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" class="form-control" name="EmpMname" value="<?php echo $get_emp_mname;?>" required>
                      </div>
                    </div>
                      <div class="col-sm-4">
                      <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" name="EmpLname" value="<?php echo $get_emp_lname;?>" required>
                      </div>
                      </div>
                    </div>
                    <div class="row">
                       <div class="col-sm-8">
                      <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="EmpAddress" value="<?php echo $get_emp_address;?>" required>
                      </div>
                  </div>
                       <div class="col-sm-4">
                      <div class="form-group">
                        <label>Barangay</label>
                       <select class="form-control custom-select" name="EmpBrgy">
                  <option selected disabled>Please select....</option>
                     <?php while ($get_brgy = $get_barangay_data->fetch(PDO::FETCH_ASSOC)) { ?>  <?php
                    $selected = ($get_emp_brgy  ==  $get_brgy['barangay'])? 'selected':'';?>
                     <option <?=$selected;?> value="<?php echo
    $get_brgy['barangay']; ?>"><?php echo $get_brgy['barangay']; ?></option> <?php } ?>
                </select>
                  </div>
                  </div>
                </div>  

                <div class="row">
                       <div class="col-sm-7">
                      <div class="form-group">
                        <label>City/Municipality</label>
                        <input type="text" class="form-control" value="<?php echo $get_emp_city;?>"name="EmpCity" required>
                      </div>
                  </div>
                       <div class="col-sm-5">
                      <div class="form-group">
                        <label>Province</label>
                        <input type="text" class="form-control" value="<?php echo $get_emp_province;?>"name="EmpProvince" required>
                      </div>
                  </div>
                  </div>   

                  <div class="row">
                     <div class="col-sm-5">
                      <div class="form-group">
                <label>Birth Date<i> (yyyy-mm-dd)</i></label>
                 <div class="input-group date mb-3">
                 <div class="input-group-addon input-group-prepend">
                <span class="input-group-text "><i class="fa fa-calendar"></i></span>  </div>
                <input type="text" id="datepicker" value="<?php echo $get_emp_birth;?>" class="form-control" name="EmpBirth" placeholder="Date">
              </div>
          </div>
        </div>
                      <div class="col-sm-4">
                      <div class="form-group">
                        <label>Age</label>
                        <input type="text" readonly class="form-control" value="<?php echo $get_age;?>" name="EmpBlood" required>
                      </div>
                      </div>

                       <div class="col-sm-3">
                      <div class="form-group">
                        <label>Blood Type</label>
                        <input type="text" class="form-control" value="<?php echo $get_emp_blood;?>" name="EmpBlood" required>
                      </div>
                      </div>
                    </div>    

                    <div class="row">
                       <div class="col-sm-8">
                      <div class="form-group">
                         <label>Civil Status</label>
                <select class="form-control custom-select" name="EmpStatus">
                  <option selected><?php echo $get_emp_status;?></option>
                     <option>Single</option> 
                     <option>Married</option>
                     <option>Widowed</option>
                     <option>Seperated</option> 
                </select>
             </div>  
             </div>                      
                       <div class="col-sm-4">
                      <div class="form-group">
                         <label>Gender</label>
                <select class="form-control custom-select" name="EmpGender" >
                 <option selected><?php echo $get_emp_gender;?></option>
                     <option>Male</option> 
                     <option>Female</option>
                </select>
             </div>  
             </div> 
             </div> 
                    
                    <div class="row">
                       <div class="col-sm-12">
                      <div class="form-group">
                        <label>Skills</label>
                        <input type="text" class="form-control" value="<?php echo $get_emp_skills;?>" name="EmpSkills" required>
                      </div>
                  </div>
                    </div>            
              </div>
              </div>
            </div>
          </div>

                  <div class="container">
            <div class="card-body">
           <i style="font-size:25px"><i style="color:blue" align="center">Current Work Details</i></i>  <div class="jumbotron">
           
             
                  <div class="row">
                    <div class="col-sm-7">
                      <div class="form-group">
                        <label>Department</label>
                        <select class="form-control custom-select" name="EmpDept">
                  <option selected disabled>Select one</option>
                  <?php while ($get_dept = $get_department3_data->fetch(PDO::FETCH_ASSOC)) { ?>
                     <?php
                    $selected = ($get_emp_department  ==  $get_dept['department'])? 'selected':'';?>
                     <option <?=$selected;?> value="<?php echo
    $get_dept['department']; ?>"><?php echo $get_dept['department']; ?></option> <?php } ?>
                </select>
                      </div>
                    </div>

                    <div class="col-sm-5">
                      <div class="form-group">
                        <label>Designation</label>
                        <input type="text" class="form-control" value="<?php echo $get_emp_designation;?>" name="EmpDesignation" required>
                      </div>
                    </div>
                    </div>

                     <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Starting Date</label>
                        <div class="input-group date mb-3" data-provide="datepicker" >
                 <div class="input-group-addon input-group-prepend">
                <span class="input-group-text "><i class="fa fa-calendar"></i></span>  </div>
                <input type="text" id="datepicker" value="<?php echo $get_emp_joingdate;?>" class="form-control" name="EmpJoingdate" placeholder="Date">
              </div>
          </div>
        </div>

                <div class="col-sm-2">
                      <div class="form-group">
                        <label>No. of Years </label>
                        <input type="text" class="form-control" value="<?php echo $get_emp_service;?>" name="EmpNoService" required>
                      </div>
                  </div>
                       <div class="col-sm-6">
                      <div class="form-group">
                        <label>Eligibility</label>
                        <input type="text" class="form-control" value="<?php echo $get_emp_eligibility;?>" name="EmpEligible" required>
                      </div>
                      </div>
                    </div>

                     <div class="row">
                       <div class="col-sm-7">
                      <div class="form-group">
                        <label>Email Address</label>
                        <input type="text" class="form-control" value="<?php echo $get_emp_email;?>" name="EmpEmail" required>
                      </div>
                  </div>
                       <div class="col-sm-5">
                      <div class="form-group">
                        <label>Contact No.</label>
                        <input type="text" class="form-control" value="<?php echo $get_emp_contact_number;?>"name="EmpContactNo" required>
                      </div>
                      </div>
                    </div>

                      </div>
                      </div>
                    </div>




     
         
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                       <a href="add_employee.php" <?php echo $btnNew; ?> class="btn btn-primary" style="padding: 5px 120px; font-size: 20px">New</a>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                       <input type="submit"  name="update" class="btn btn-primary" style="padding: 5px 120px; font-size: 20px" value="Update">
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <a href="employeedetails.php?ID=<?php echo "1"?>" class="btn btn-default btn-block" style="padding: 5px 120px; font-size: 20px">Cancel</a>
                    </div>
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
