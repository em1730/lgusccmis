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
      <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right text-xs">
      <li class="breadcrumb-item"><a href="index">Home</a></li>
      <li class="breadcrumb-item active">Edit</li>
         </ol>
         </div>

       
    </section>
 
<!-- Main content -->
          <div class="col-md-12">
          <div class="card">
           

                 <form method="post" action="" enctype="multipart/form-data">

                   

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
 <input type="text" class="form-control" name="id" value="<?php echo $id_emp;?>" required>
  <input type="text" class="form-control" readOnly=true id = "emp_id" name="id2" value="<?php echo $get_emp_id; ?>">

              <br>
             
             <label align="right"><i style="color:grey">*******</i>Upload Photo<i style="color:grey">*******</i></label>
             <input class="text-sm" type ="file" name="myFiles" id="fileToUpload"  onchange = "loadImage()">
             <br>
             <br>
             <div class="col-sm-11">
                      <div class="row">
                        <input type="text" style="text-align: center" class="form-control" name="code"  value="<?php echo $get_emp_code;?>" placeholder="Enter ID" required>
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
                         <input type="text" class="form-control" value="<?php echo $get_emp_fname;?>" name="firstname" required>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" class="form-control" name="middlename" value="<?php echo $get_emp_mname;?>" required>
                      </div>
                    </div>
                       <div class="col-sm-4">
                      <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" name="lastname" value="<?php echo $get_emp_lname;?>" required>
                      </div>
                      </div>
                    </div>

                        <div class="row">
                       <div class="col-sm-8">
                      <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address" value="<?php echo $get_emp_address;?>" required>
                      </div>
                  </div>
                       <div class="col-sm-4">
                      <div class="form-group">
                        <label>Barangay</label>
                       <select class="form-control custom-select" name="brgy">
                  <option selected disabled>Please select....</option>
                     <?php while ($get_brgy = $get_barangay_data->fetch(PDO::FETCH_ASSOC)) { ?>
                      <option selected><?php echo $get_emp_brgy;?></option>
                     <option value="<?php echo
    $get_brgy['barangay']; ?>"><?php echo $get_brgy['barangay']; ?></option> <?php } ?>
                </select>
                  </div>
                  </div>
                </div>

                    <div class="row">
                       <div class="col-sm-7">
                      <div class="form-group">
                        <label>City/Municipality</label>
                        <input type="text" class="form-control" value="<?php echo $get_emp_city;?>"name="city" required>
                      </div>
                  </div>
                       <div class="col-sm-5">
                      <div class="form-group">
                        <label>Province</label>
                        <input type="text" class="form-control" value="<?php echo $get_emp_province;?>"name="province" required>
                      </div>
                  </div>
                  </div>

                  <div class="row">
                     <div class="col-sm-5">
                      <div class="form-group">
                <label>Birth Date</label>
                 <div class="input-group date mb-3" data-provide="datepicker" id="dateBirth">
                 <div class="input-group-addon input-group-prepend">
                <span class="input-group-text "><i class="fa fa-calendar"></i></span>  </div>
                <input type="text" id="datepicker" value="<?php echo $get_emp_birth;?>" class="form-control" name="dateBirth" placeholder="Date" value="">
              </div>
          </div>
        </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>Age</label>
                        <input type="text" class="form-control" id="age" value="<?php echo $get_emp_age;?>" name="age"  required>
                      </div>
                    </div>
                       <div class="col-sm-5">
                      <div class="form-group">
                        <label>Blood Type</label>
                        <input type="text" class="form-control" value="<?php echo $get_emp_blood;?>" name="blood" required>
                      </div>
                      </div>
                    </div>

                     <div class="row">
                       <div class="col-sm-8">
                      <div class="form-group">
                         <label>Civil Status</label>
                <select class="form-control custom-select" name="status">
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
                <select class="form-control custom-select" name="" >
                 <option selected disabled><?php echo $get_emp_gender;?></option>
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
                        <input type="text" class="form-control" value="<?php echo $get_emp_skills;?>" name="skills" required>
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
                        <select class="form-control custom-select" name="dept">">
                  <option selected><?php echo $get_emp_department;?></option>
                  <?php while ($get_dept = $get_department3_data->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo
    $get_dept['department']; ?>"><?php echo $get_dept['department']; ?></option> <?php } ?>
                </select>
                      </div>
                    </div>

                    <div class="col-sm-5">
                      <div class="form-group">
                        <label>Designation</label>
                        <input type="text" class="form-control" value="<?php echo $get_emp_designation;?>" name="designation" required>
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
                <input type="text" id="datepicker" value="<?php echo $get_emp_joingdate;?>" class="form-control" name="dateStart" placeholder="Date" value="">
              </div>
          </div>
        </div>

                <div class="col-sm-2">
                      <div class="form-group">
                        <label>No. of Years </label>
                        <input type="text" class="form-control" value="<?php echo $get_emp_service;?>" name="years" required>
                      </div>
                  </div>
                       <div class="col-sm-6">
                      <div class="form-group">
                        <label>Eligibility</label>
                        <input type="text" class="form-control" value="<?php echo $get_emp_eligibility;?>" name="eligibility" required>
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
                   
                <hr class="dashed">
 <div style="
  border-left: 2px dashed green;
  height: 310px;
  position: absolute;
  left: 64.5%;
  margin-left: -3px;
  top: 950;"></div>
                      <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label><i>SSS</i></label>
                         <input type="text" class="form-control" value="<?php echo $get_id_sss;?>" name="sss" required>
                      </div>
                      </div>

                        <div class="col-sm-4">
                      <div class="form-group">
                        <label><i>TIN #</i></label>
                         <input type="text" class="form-control" value="<?php echo $get_id_tin;?>" name="tin" required>
                      </div>
                      </div>
 
                      <div class="col-sm-4">
                      <div class="form-group">
                        <label>CTC No.</label>
                         <input type="text" class="form-control" value="<?php echo $get_id_ctc;?>" name="ctc" required>
                      </div>
                      </div>
                    </div>

                    <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label><i>Pag-ibig MID No.</i></label>
                         <input type="text" class="form-control" value="<?php echo $get_id_pagibig;?>" name="pag_ibig" required>
                      </div>
                      </div>

                        <div class="col-sm-4">
                      <div class="form-group">
                        <label><i>ATM SA#</i></label>
                         <input type="text" class="form-control" value="<?php echo $get_id_atm;?>" name="atm" required>
                      </div>
                      </div>

                      <div class="col-sm-4">
                      <div class="form-group">
                        <label>Date issued</label>
                         <div class="input-group date mb-3" data-provide="datepicker" >
                 <div class="input-group-addon input-group-prepend">
                <span class="input-group-text "><i class="fa fa-calendar"></i></span>  </div>
                <input type="text" id="datepicker" value="<?php echo $get_id_atm;?>" class="form-control" name="datectc" placeholder="Date" value="">
              </div>
                      </div>
                      </div>
                    </div>

                      <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label><i>Philhealth</i></label>
                         <input type="text" class="form-control" value="<?php echo $get_id_phil;?>" name="philhealth" required>
                      </div>
                      </div>

                        <div class="col-sm-4">
                      <div class="form-group">
                        <label></label>
                      </div>
                      </div>

                      <div class="col-sm-4">
                      <div class="form-group">
                        <label>Placed issued</label>
                         <input type="text" class="form-control" value="<?php echo $get_id_place;?>" name="ctc_place" required>
                      </div>
                      </div>
                    </div>
 


                     </div>
              </div>
            </div>




              <div class="container">
                <i style="font-size:25px"><i style="color:blue" >Education Details</i></i>  
                <div class="card card-outline card-secondary">
                <div class="card-body">
             <div class="form-group">
                 <label>Educational Attainment</label>
               <div class="col-md-12">
                <select class="form-control custom-select" name="attainment">">
                  <option selected><?php echo $get_edu_att;?></option>
                  <?php while ($get_attainment = $get_att_data->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo
    $get_attainment['level']; ?>"><?php echo $get_attainment['level']; ?></option> <?php } ?>
                </select>
              </div>
            </div>
                      <form role="form">     
                      <div class="row">
                       <div class="col-sm-7">
                      <div class="form-group">
                        <label>Course</label>
                        <input type="text" value="<?php echo $get_edu_course;?>" class="form-control" name="course" >
                      </div>
                  </div>

                  <div class="col-sm-5">
                      <div class="form-group">
                        <label>Award/s</label>
                        <input type="text" value="<?php echo $get_edu_award;?>" class="form-control" name="awards" >
                      </div>
                  </div>
                </div>
         <hr class="dashed">

         <label><i class="h8 font-weight-bold bg-yellow">COLLEGE INFORMATION</i></label>
                <form role="form">     
                 <div class="row">
                    <div class="col-sm-8">
                      <div class="form-group">
                        <label>School/College Graduated</label>
                         <input type="text" class="form-control" value="<?php echo $get_edu_col_sch;?>" name="colschool" >
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Year</label>
                        <input type="text" class="form-control" value="<?php echo $get_edu_col_yr;?>"name="colyear" >
                      </div>
                    </div>
                  </div>
             
    

           <label><i class="h8 font-weight-bold bg-yellow">SECONDARY INFORMATION</i></label>
                  <div class="row">
                    <div class="col-sm-8">
                      <div class="form-group">
                        <label>School/High School Graduated</label>
                         <input type="text" class="form-control" value="<?php echo $get_edu_sec_sch;?>" name="secschool" >
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Year</label>
                        <input type="text" class="form-control" value="<?php echo $get_edu_sec_yr;?>" name="secyear" >
                      </div>
                    </div>
                  </div>



           <label><i class="h8 font-weight-bold bg-yellow">PRIMARY INFORMATION</i></label>

                  <div class="row">
                    <div class="col-sm-8">
                      <div class="form-group">
                        <label>School/Elementary School Graduated</label>
                         <input type="text" class="form-control" value="<?php echo $get_edu_elem_sch;?>"name="elemschool" >
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Year</label>
                        <input type="text" class="form-control" value="<?php echo $get_edu_elem_yr;?>"name="elemyear" >
                      </div>
                    </div>
                  </div>
                </div>
                </div>
                </div>


                <div class="container">
                <i style="font-size:25px"><i style="color:blue" >Work History</i></i>  
                <div class="card card-outline card-secondary">
                <div class="card-body">
                   <div class="row">
                  <div class="col-sm-4">
                  <div class="form-group">
                   <label><i class="h8 mb-0 font-weight-bold bg-green">EMPLOYEER 1</i></label>
                  </div>
                </div>

                 <div class="col-sm-4">
                      <div class="form-group">
                       <label><i class="h8 font-weight-bold bg-green">EMPLOYEER 2</i></label>
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label><i class="h7 font-weight-bold bg-green">EMPLOYEER 3</i></label>
                    </div>
                  </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Employeer</label>
                         <input type="text" class="form-control" value="<?php echo $get_exp_emp1_name;?>" name="nameone">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Employeer</label>
                        <input type="text" class="form-control"  value="<?php echo $get_exp_emp2_name;?>"name="nametwo" >
                      </div>
                    </div>
                     <div class="col-sm-4">
                      <div class="form-group">
                        <label>Employeer</label>
                        <input type="text" class="form-control"  value="<?php echo $get_exp_emp3_name;?>" name="namethree">
                      </div>
                    </div>
                  </div>

                    <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Designation</label>
                         <input type="text" class="form-control"  value="<?php echo $get_exp_emp1_designation;?>" name="designationone" >
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Designation</label>
                        <input type="text" class="form-control"  value="<?php echo $get_exp_emp2_designation;?>" name="designationtwo" >
                      </div>
                    </div>
                     <div class="col-sm-4">
                      <div class="form-group">
                        <label>Designation</label>
                        <input type="text" class="form-control" value="<?php echo $get_exp_emp3_designation;?>" name="designationthree" >
                      </div>
                    </div>
                  </div>

                                     <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Salary</label>
                         <input type="text" class="form-control" value="<?php echo $get_exp_emp1_salary;?>" name="salaryone" >
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Salary</label>
                        <input type="text" class="form-control" value="<?php echo $get_exp_emp2_salary;?>" name="salarytwo" >
                      </div>
                    </div>
                     <div class="col-sm-4">
                      <div class="form-group">
                        <label>Salary</label>
                        <input type="text" class="form-control" value="<?php echo $get_exp_emp3_salary;?>" name="salarythree" >
                      </div>
                    </div>
                  </div>

               <div class="vl"></div>
               <div class="vl1"></div>


                   <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Work Duration</label>
                         <input type="text" class="form-control" value="<?php echo $get_exp_emp1_duration;?>" name="workone" >
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Work Duration</label>
                        <input type="text" class="form-control" value="<?php echo $get_exp_emp2_duration;?>" name="worktwo" >
                      </div>
                    </div>
                     <div class="col-sm-4">
                      <div class="form-group">
                        <label>Work Duration</label>
                        <input type="text" class="form-control" value="<?php echo $get_exp_emp3_duration;?>" name="workthree">
                      </div>
                    </div>
                  </div>


                   
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
                       <input type="submit"  name="update_employee_profile" class="btn btn-primary" style="padding: 5px 120px; font-size: 20px" value="Save">
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
